<?php
/**
 * Plugin Name:          Handy Variation Swatches For WooCommerce
 * Description:          Handy Variation Swatches is a powerful WooCommerce plugin that replaces dull dropdowns with vibrant color swatches, stylish buttons, and image-based options making product selection clearer, faster, and more visually engaging for your customers.
 * Author:               Mafel John Cahucom
 * Author URI:           https://www.facebook.com/mafeljohn.cahucom
 * Version:              1.0.0
 * Text Domain:          handy-variation-swatches
 * Domain Path:          /languages
 * Requires at least:    5.8
 * WC requires at least: 5.0.0
 * License:              GPLv2 or later
 */

defined( 'ABSPATH' ) || exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

if ( ! defined( 'HVSFW_PLUGIN_VERSION' ) ) {
    define( 'HVSFW_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'HVSFW_PLUGIN_BASENAME' ) ) {
    define( 'HVSFW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'HVSFW_PLUGIN_URL' ) ) {
    define( 'HVSFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'HVSFW_PLUGIN_PATH' ) ) {
    define( 'HVSFW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( class_exists( 'HVSFW\\Inc\\Installer' ) ) {
    register_activation_hook( __FILE__, array( 'HVSFW\\Inc\\Installer', 'activate' ) );

    register_deactivation_hook( __FILE__, array( 'HVSFW\\Inc\\Installer', 'deactivate' ) );
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
    if ( class_exists( 'HVSFW\\Init' ) ) {
        HVSFW\Init::get_instance();
    }
} else {
    add_action( 'admin_notices', function() {
        printf(
            '<div class="notice notice-error is-dismissible"><p>%s</p></div>',
            __( 'Handy Variation Swatches for WooCommerce requires WooCommerce Plugin to be activated. Please install WooCommerce to continue.', 'handy-variation-swatches' )
        );
    });
}
