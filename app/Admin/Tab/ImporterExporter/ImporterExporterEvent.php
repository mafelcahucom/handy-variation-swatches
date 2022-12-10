<?php
namespace HVSFW\Admin\Tab\ImporterExporter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Security;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\FieldValidation;
use HVSFW\Admin\Tab\Setting\SettingApi;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Importer & Exporter Event.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ImporterExporterEvent {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Inherit Security.
     */
    use Security;

    /**
     * Register ajax events.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Export Setting.
        add_action( 'wp_ajax_hvsfw_export_settings', [ $this, 'export_settings' ] );

        // Import Setting.
        add_action( 'wp_ajax_hvsfw_import_settings', [ $this, 'import_settings' ] );
    }

    /**
     * Download the encrypted settings.
     *
     * @since 1.0.0
     *
     * @return json
     */
    public function export_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        // Get settings.
        $settings = get_option( '_hvsfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = SettingApi::get_fields_default_values();
        }

        $encoded_settings = json_encode( $settings );
        $encrypted        = Helper::get_encrypted( $encoded_settings );

        wp_send_json_success([
            'response' => 'SETTINGS_EXPORTED',
            'settings' => $encrypted
        ]);
    }

    /**
     * Import the encrypted settings.
     *
     * @since 1.0.0
     * 
     * @return json
     */
    public function import_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'settings' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        // Decrypt settings.
        $decrypted_settings = Helper::get_decrypted( $_POST['settings'] );
        if ( $decrypted_settings === false ) {
            wp_send_json_error([
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => 'Failed to decrypt settings.'
            ]);
        }

        // Decoded settings.
        $decoded_settings = json_decode( stripslashes( sanitize_text_field( $decrypted_settings ) ), true );
        if ( $decrypted_settings === null || json_last_error() !== JSON_ERROR_NONE ) {
            wp_send_json_error([
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => 'Failed to decode settings.',
            ]);
        }

        // Check if settings has missing keys.
        $has_missing_keys = SettingApi::has_missing_fields( $decoded_settings );
        if ( $has_missing_keys === true ) {
            wp_send_json_error([
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => 'Settings has missing keys.'
            ]);
        }

        // Validate settings.
        $validation = FieldValidation::validate([
            'fields'        => $decoded_settings,
            'current_value' => $decoded_settings,
            'field_rules'   => SettingApi::get_field_rules()
        ]);

        if ( count( $validation['validation']['invalid'] ) > 0 ) {
            wp_send_json_error([
                'error'  => 'CORRUPTED_SETTING_FILE',
                'detail' => 'Settings failed in validation.'
            ]);
        }

        // Update the settings in wp_options.
        update_option( '_hvsfw_main_settings', $decoded_settings );
        wp_send_json_success([
            'response' => 'SUCCESSFULLY IMPORTED'
        ]);
    }
}