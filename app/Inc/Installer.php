<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Installer.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Installer {

    /**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Plugin Activation.
     *
     * @since 1.0.0
     */
	public static function activate() {
        flush_rewrite_rules();
        self::set_option_main_settings();

        // Set plugin version.
        update_option( '_hvsfw_plugin_version', HVSFW_PLUGIN_VERSION );
    }

    /**
     * Plugin Deactivation.
     *
     * @since 1.0.0
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Sets the default value of option _hvsfw_main_settings.
     *
     * @since 1.0.0
     */
    public static function set_option_main_settings() {
        if ( get_option( '_hvsfw_main_settings' ) ) {
            return;
        }

        $settings = [

            // gn.
            'gn_enable'                     => 1,

            // ad_stg.
            'ad_stg_additional_css'         => ''
        ];

        // Insert settings in wp_options table.
        update_option( '_hvsfw_main_settings', $settings );
    }
}