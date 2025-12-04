<?php
/**
 * App > Inc > Plugins.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Plugins` class contains all the handy plugins
 * short introduction and plugin state.
 *
 * @since 1.0.0
 */
final class Plugins {

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
     * List of handy woocommerce plugin collections.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function collections() {
        return array(
            'handy-customizer' => array(
                'prefix'      => 'Handy',
                'slug'        => 'handy-customizer',
                'file'        => 'handy-customizer.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Customizer Framework',
                'description' => 'Handy Customizer Framework is a tool for WordPress Theme Developer to develop theme using WordPress Customizer API while writing clean and minimal code.',
            ),
            'handy-variation-swatches' => array(
                'prefix'      => 'hvsfw',
                'slug'        => 'handy-variation-swatches',
                'file'        => 'handy-variation-swatches.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Variation Swatches',
                'description' => 'Handy Variation Swatches is a powerful WooCommerce plugin that replaces dull dropdowns with vibrant color swatches, stylish buttons, and image-based options making product selection clearer, faster, and more visually engaging for your customers.',
            ),
            'handy-wishlist' => array(
                'prefix'      => 'hwfw',
                'slug'        => 'handy-wishlist',
                'file'        => 'handy-wishlist.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Wishlist',
                'description' => 'Handy Wishlist is a lightweight WooCommerce plugin that lets customers save and manage their favorite products. It enhances the shopping experience, boosts engagement, and encourages repeat purchases by making wishlists easy to revisit and share.',
            ),
            'handy-compare-products' => array(
                'prefix'      => 'hcpfw',
                'slug'        => 'handy-compare-products',
                'file'        => 'handy-compare-products.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Compare Products',
                'description' => 'Handy Compare Products is a powerful WooCommerce plugin that helps customers make confident purchase decisions by giving them a clean, interactive comparison interface to visually compare multiple products side by side.',
            ),
            'handy-quick-view' => array(
                'prefix'      => 'hqfw',
                'slug'        => 'handy-quick-view',
                'file'        => 'handy-quick-view.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Quick View',
                'description' => 'Handy Quick View is a powerful WooCommerce plugin that lets customers preview product details instantly through a custom-designed modal for reducing clicks, speeding up browsing, and creating a smoother, more engaging shopping experience.',
            ),
            'handy-add-to-cart' => array(
                'prefix'      => 'hafw',
                'slug'        => 'handy-add-to-cart',
                'file'        => 'handy-add-to-cart.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Add To Cart',
                'description' => 'Handy Add To Cart is a powerful WooCommerce plugin that lets store owners create fully customizable Add To Cart buttons, allowing customers to add products instantly without reloading the page streamlining shopping and boosting conversions.',
            ),
            'handy-product-variation-table' => array(
                'prefix'      => 'hvtfw',
                'slug'        => 'handy-product-variation-table',
                'file'        => 'handy-product-variation-table.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Product Variation Table',
                'description' => 'Handy Product Variation Table is a powerful WooCommerce plugin that displays all product variations in a clean, organized table making it easy for customers to view, compare, and select the exact options they want, boosting engagement and conversions.',
            ),
            'handy-itemized-product-variation' => array(
                'prefix'      => 'hivfw',
                'slug'        => 'handy-itemized-product-variation',
                'file'        => 'handy-itemized-product-variation.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Itemized Product Variation',
                'description' => 'Handy Itemized Product Variation for WooCommerce transforms the default dropdowns into interactive radio buttons and dropdowns, giving customers a clearer, faster, and more detailed way to select product variations, enhancing the shopping experience and boosting conversions.',
            ),
            'handy-sliding-cart' => array(
                'prefix'      => 'hsfw',
                'slug'        => 'handy-sliding-cart',
                'file'        => 'handy-sliding-cart.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Sliding Cart',
                'description' => 'Handy Sliding Cart is a powerful WooCommerce plugin that lets store owners create a sleek, interactive sidebar cart, enhancing the shopping experience, improving cart visibility, and driving higher sales conversions.',
            ),
            'handy-added-to-cart-toaster-notifier' => array(
                'prefix'      => 'hatfw',
                'slug'        => 'handy-added-to-cart-toaster-notifier',
                'file'        => 'handy-added-to-cart-toaster-notifier.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Added To Cart Toaster Notifier',
                'description' => 'Handy Added To Cart Toaster Notifier is a WooCommerce plugin that lets store owners display sleek, real-time toaster popups, instantly notifying customers when a product is added to the cart enhancing clarity, engagement, and purchase confidence.',
            ),
            'handy-added-to-cart-popup-notifier' => array(
                'prefix'      => 'hapfw',
                'slug'        => 'handy-added-to-cart-popup-notifier',
                'file'        => 'handy-added-to-cart-popup-notifier.php',
                'website'     => '',
                'download'    => '',
                'name'        => 'Added To Cart Popup Notifier',
                'description' => 'Handy Added To Cart Popup Notifier is a WooCommerce plugin that lets store owners display engaging modal popups after a product is added to the cart informing customers and suggesting related products to boost sales and cross-sells.',
            ),
        );
    }

    /**
     * Return the all collections with plugin status.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_collections_status() {
        $collections = array();
        foreach ( self::collections() as $key => $value ) {
            array_push( $collections, array(
                'slug'   => $key,
                'status' => self::is_active( $key ),
            ) );
        }

        return $collections;
    }

    /**
     * Return the full path of collection plugin "path/file".
     *
     * @since 1.0.0
     *
     * @param  string $collection_slug Contains the slug (index) of the plugins in collections.
     * @return string
     */
    public static function get_path( $collection_slug ) {
        $collections = self::collections();
        if ( ! array_key_exists( $collection_slug, $collections ) ) {
            return;
        }

        $slug = $collections[ $collection_slug ]['slug'];
        $file = $collections[ $collection_slug ]['file'];
        $path = $slug . '/' . $file;

        return $path;
    }

    /**
     * Check if a certain plugin is installed or exists in the plugin direction based on the plugin slug.
     *
     * @since 1.0.0
     *
     * @param  string $plugin_slug Contains the slug of the plugin.
     * @return boolean
     */
    public static function is_installed( $plugin_slug ) {
        if ( empty( $plugin_slug ) ) {
            return false;
        }

        $folder = $plugin_slug . '/' . $plugin_slug . '.php';
        return ( array_key_exists( $folder, get_plugins() ) );
    }

    /**
     * Check if a certain plugin is active and enabled based on the collection slug.
     *
     * @since 1.0.0
     *
     * @param  string $collection_slug Contains the slug of the plugins in collections.
     * @return boolean
     */
    public static function is_active( $collection_slug ) {
        if ( empty( $collection_slug ) ) {
            return false;
        }

        $collection_path = self::get_path( $collection_slug );
        if ( ! $collection_path ) {
            return false;
        }

        // Check if the plugin is active.
        $active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
        if ( ! in_array( $collection_path, $active_plugins, true ) ) {
            return false;
        }

        // Check if the plugin is enabled in the main settings.
        $collections     = self::collections();
        $plugin_prefix   = $collections[ $collection_slug ]['prefix'];
        $plugin_settings = get_option( '_' . $plugin_prefix . '_main_settings' );
        if ( ! empty( $plugin_settings ) && $plugin_settings['gn_enable'] ) {
            return true;
        }

        return false;
    }
}
