<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Plugins.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Plugins {

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
     * List of handy woocommerce plugin collections.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function collections() {
        return [
            'handy-add-to-cart' => [
                'name'   => 'Handy Add To Cart For WooCommerce',
                'slug'   => 'handy-add-to-cart',
                'file'   => 'handy-add-to-cart.php',
                'prefix' => 'hafw'
            ],
            'handy-sliding-cart' => [
                'name'   => 'Handy Sliding Cart For WooCommerce',
                'slug'   => 'handy-sliding-cart',
                'file'   => 'handy-sliding-cart.php',
                'prefix' => 'hsfw'
            ],
            'handy-quick-view' => [
                'name'   => 'Handy Quick View For WooCommerce',
                'slug'   => 'handy-quick-view',
                'file'   => 'handy-quick-view.php',
                'prefix' => 'hqfw'
            ],
            'handy-added-to-cart-toaster-notifier' => [
                'name'   => 'Handy Added To Cart Toaster Notifier For WooCommerce',
                'slug'   => 'handy-added-to-cart-toaster-notifier',
                'file'   => 'handy-added-to-cart-toaster-notifier.php',
                'prefix' => 'hatfw'
            ],
            'handy-added-to-cart-popup-notifier' => [
                'name'   => 'Handy Added To Cart Popup Notifier For WooCommerce',
                'slug'   => 'handy-added-to-cart-popup-notifier',
                'file'   => 'handy-added-to-cart-popup-notifier.php',
                'prefix' => 'hapfw'
            ],
            'handy-compare-products' => [
                'name'   => 'Handy Compare Products For WooCommerce',
                'slug'   => 'handy-compare-products',
                'file'   => 'handy-compare-products.php',
                'prefix' => 'hcpfw'
            ],
            'handy-itemized-product-variation' => [
                'name'   => 'Handy Itemized Product Variation For WooCommerce',
                'slug'   => 'handy-itemized-product-variation',
                'file'   => 'handy-itemized-product-variation.php',
                'prefix' => 'hivfw'
            ],
            'handy-product-variation-table' => [
                'name'   => 'Handy Product Variation Table For WooCommerce',
                'slug'   => 'handy-product-variation-table',
                'file'   => 'handy-product-variation-table.php',
                'prefix' => 'hvtfw'
            ],
            'handy-variation-swatches' => [
                'name'   => 'Handy Variation Swatches For WooCommerce',
                'slug'   => 'handy-variation-swatches',
                'file'   => 'handy-variation-swatches.php',
                'prefix' => 'hvsfw'
            ]
        ];
    }

    /**
     * Return all the collections with plugin status.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_collections_status() {
        $collections = [];
        foreach ( self::collections() as $key => $value ) {
            array_push( $collections, [
                'slug'   => $key,
                'status' => self::is_active( $key )
            ] );
        }

        return $collections;
    }

    /**
     * Return the full path of collection plugin "path/file".
     *
     * @since 1.0.0
     * 
     * @param  string  $collection_slug  The slug (index) of the plugins in collections.
     * @return string
     */
    public static function get_path( $collection_slug ) {
        $collections = self::collections();
        if ( ! array_key_exists( $collection_slug, $collections ) ) {
            return;
        }

        $slug = $collections[ $collection_slug ]['slug'];
        $file = $collections[ $collection_slug ]['file'];
        $path = $slug .'/'. $file;

        return $path;
    }

    /**
     * Check if a certain plugin is active and enabled based on the collection slug.
     *
     * @since 1.0.0
     * 
     * @param  string  $collection_slug  The slug of the plugins in collections.
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
        if ( ! in_array( $collection_path, $active_plugins ) ) {
            return false;
        }

        // Check if the plugin is enabled in the main settings.
        $collections     = self::collections();
        $plugin_prefix   = $collections[ $collection_slug ]['prefix'];
        $plugin_settings = get_option( '_'. $plugin_prefix .'_main_settings' );
        if ( ! empty( $plugin_settings ) && $plugin_settings['gn_enable'] ) {
            return true;
        }

        return false;
    }
}