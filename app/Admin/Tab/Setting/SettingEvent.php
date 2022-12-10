<?php
namespace HVSFW\Admin\Tab\Setting;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Security;
use HVSFW\Admin\Inc\FieldValidation;
use HVSFW\Admin\Tab\Setting\SettingApi;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting Event.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingEvent {

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
        // Save Settings.
        add_action( 'wp_ajax_hvsfw_save_settings', [ $this, 'save_settings' ] );
    }

    /**
     * Save all fields in settings tab in wp_option.
     *
     * @since 1.0.0
     * 
     * @return json
     */
    public function save_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'fields' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        // Decode & sanitize $_POST['fileds'].
        $fields = json_decode( stripslashes( sanitize_text_field( $_POST['fields'] ) ), true );
        if ( empty( $fields ) || ! is_array( $fields ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        // Get settings field rules.
        $field_rules = SettingApi::get_field_rules();

        // Remove the element who dont exists in settings field rules.
        foreach ( $fields as $key => $value ) {
            if ( ! array_key_exists( $key, $field_rules ) ) {
                unset( $fields[ $key ] );
            }
        }

        // Check again if the $field is empty.
        if ( empty( $fields ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        // Get the current settings value.
        $current_settings_value = get_option( '_hvsfw_main_settings' );
        if ( empty( $current_settings_value ) ) {
            // Get the default values of fields if _hvsfw_main_settings is empty.
            $current_settings_value = SettingApi::get_fields_default_values();
        }

        // Validate all fields.
        $validation = FieldValidation::validate([
            'fields'        => $fields,
            'current_value' => $current_settings_value,
            'field_rules'   => $field_rules
        ]);

        // Update option field _hvsfw_main_settings.
        if ( count( $validation['validation']['valid'] ) > 0 ) {
            update_option( '_hvsfw_main_settings', $validation['updated_value'] );
        }
        
        wp_send_json_success([
            'response'   => 'SUCCESSFULLY_SAVED',
            'validation' => $validation['validation']
        ]);
    }
}