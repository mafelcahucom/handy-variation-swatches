<?php
/**
 * Plugin Name:          Handy Variation Swatches For WooCommerce
 * Description:          Handy Variation Swatches For WooCommerce will let you replace the default dropdown variation into more detailed and engaging variation (button, color and image) swatches.
 * Author:               Mafel John Cahucom
 * Author URI:           https://www.facebook.com/mafeljohn.cahucom
 * Version:              1.0.0
 * Text Domain:          handy-variation-swatches
 * Domain Path:          /languages
 * Requires at least:    5.8
 * WC requires at least: 5.0.0
 * License:              GPLv2 or later
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the autoloader.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

// Define plugin domain.
if ( ! defined( 'HVSFW_PLUGIN_DOMAIN' ) ) {
    define( 'HVSFW_PLUGIN_DOMAIN', 'handy-variation-swatches' );
}

// Define plugin version.
if ( ! defined( 'HVSFW_PLUGIN_VERSION' ) ) {
    define( 'HVSFW_PLUGIN_VERSION', '1.0.0' );
}

// Define plugin basename.
if ( ! defined( 'HVSFW_PLUGIN_BASENAME' ) ) {
    define( 'HVSFW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

// Define plugin url.
if ( ! defined( 'HVSFW_PLUGIN_URL' ) ) {
    define( 'HVSFW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Define plugin path.
if ( ! defined( 'HVSFW_PLUGIN_PATH' ) ) {
    define( 'HVSFW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

// Installer.
if ( class_exists( 'HVSFW\\Inc\\Installer' ) ) {
    // Plugin Activation.
    register_activation_hook( __FILE__, [ 'HVSFW\\Inc\\Installer', 'activate' ] );

    // Plugin Deactivation.
    register_deactivation_hook( __FILE__, [ 'HVSFW\\Inc\\Installer', 'deactivate' ] );
}

// Check if WooCommerce Plugin is installed.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // Initialize Plugin.
    if ( class_exists( 'HVSFW\\Init' ) ) {
        HVSFW\Init::get_instance();
    }
} else {
    add_action( 'admin_notices', function() {
        $output = '';
        $output .= '<div class="notice notice-error is-dismissible">';
        $output .= '<p>Handy Variation Swatches for WooCommerce requires WooCommerce Plugin to be activated. Please install WooCommerce to continue.</p>';
        $output .= '</div>';
        echo $output;
    });
}