<?php
/**
 * App > Inc > Installer.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Api\SettingApi;

defined( 'ABSPATH' ) || exit;

/**
 * The `Installer` class contains helper methods for
 * setting plugin's status, version and settings.
 *
 * @since 1.0.0
 */
final class Installer {

    /**
     * Inherit Singleton.
     *
     * @since 1.0.0
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
     *
     * @return void
     */
	public static function activate() {
        flush_rewrite_rules();

        self::set_option_main_settings();
        self::set_plugin_version();
    }

    /**
     * Plugin Deactivation.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Sets the value or version of the plugin in options.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function set_plugin_version() {
        update_option( '_hvsfw_plugin_version', HVSFW_PLUGIN_VERSION );
    }

    /**
     * Sets the default value of option _hvsfw_main_settings.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function set_option_main_settings() {
        if ( empty( get_option( '_hvsfw_main_settings' ) ) ) {
            update_option( '_hvsfw_main_settings', SettingApi::get_settings( 'fields' ) );
        }
    }
}
