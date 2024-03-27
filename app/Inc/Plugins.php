<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Plugins.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
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
        return [
            'handy-customizer' => [
                'prefix'      => 'Handy',
                'slug'        => 'handy-customizer',
                'file'        => 'handy-customizer.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Customizer Framework', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Customizer Framework is a tool for WordPress Theme Developer to develop theme using WordPress Customizer API while writing clean and minimal code.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-add-to-cart' => [
                'prefix'      => 'hafw',
                'slug'        => 'handy-add-to-cart',
                'file'        => 'handy-add-to-cart.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Add To Cart For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Add To Cart is a very helpful WooCommerce plugin that enables store owners to create a personalized Add To Cart button that lets customers add product to their cart without having to reload the entire site.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-variation-swatches' => [
                'prefix'      => 'hvsfw',
                'slug'        => 'handy-variation-swatches',
                'file'        => 'handy-variation-swatches.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Variation Swatches For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Variation Swatches is a very helpful WooCommerce plugin that will let the store owners to replace the default dropdown variation with more detailed and engaging variation (button, color, and image) swatches.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-wishlist' => [
                'prefix'      => 'hwfw',
                'slug'        => 'handy-wishlist',
                'file'        => 'handy-wishlist.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Wishlist For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Wishlist is a very helpful and lightweight WooCommerce plugin that enables customers to bookmark and organize their favorite products that they want to simply buy later or keep a careful check on.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-quick-view' => [
                'prefix'      => 'hqfw',
                'slug'        => 'handy-quick-view',
                'file'        => 'handy-quick-view.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Quick View For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Quick View is a very helpful WooCommerce plugin that enables store owners to design a custom Quick View modal that enables customers to get a quick look at a product without visiting the product page.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-compare-products' => [
                'prefix'      => 'hcpfw',
                'slug'        => 'handy-compare-products',
                'file'        => 'handy-compare-products.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Compare Products For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Compare Products is a very helpful WooCommerce plugin that will help your customers make purchase decisions by providing them with a comparison interface that lets customers visualize the comparison of multiple products.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-sliding-cart' => [
                'prefix'      => 'hsfw',
                'slug'        => 'handy-sliding-cart',
                'file'        => 'handy-sliding-cart.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Sliding Cart For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Sliding Cart is a very helpful WooCommerce plugin that enables store owners to design a sidebar cart that will improve the customer’s shopping experience, cart visualization, and boosts sales conversions.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-itemized-product-variation' => [
                'prefix'      => 'hivfw',
                'slug'        => 'handy-itemized-product-variation',
                'file'        => 'handy-itemized-product-variation.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Itemized Product Variation For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Itemized Product Variation For WooCommerce will let you change the default select option in selecting variation in to itemized (radio button and dropdown component) in order for the users to select the variation in more detailed and easier experience.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-product-variation-table' => [
                'prefix'      => 'hvtfw',
                'slug'        => 'handy-product-variation-table',
                'file'        => 'handy-product-variation-table.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Product Variation Table For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Product Variation Table is a very helpful and lightweight WooCommerce plugin that will let you add a list of the product’s variations in the form of table, in order to help customers to view or select the product’s variations.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-added-to-cart-popup-notifier' => [
                'prefix'      => 'hapfw',
                'slug'        => 'handy-added-to-cart-popup-notifier',
                'file'        => 'handy-added-to-cart-popup-notifier.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Added To Cart Popup Notifier For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Added To Cart Popup Notifier is a very helpful WooCommerce plugin that enables store owners to design a modal popup that will inform and suggest products to customers after a product has been successfully added to the cart.', HVSFW_PLUGIN_DOMAIN )
            ],
            'handy-added-to-cart-toaster-notifier' => [
                'prefix'      => 'hatfw',
                'slug'        => 'handy-added-to-cart-toaster-notifier',
                'file'        => 'handy-added-to-cart-toaster-notifier.php',
                'website'     => '',
                'download'    => '',
                'name'        => __( 'Handy Added To Cart Toaster Notifier For WooCommerce', HVSFW_PLUGIN_DOMAIN ),
                'description' => __( 'Handy Added To Cart Toaster Notifier is a very helpful WooCommerce plugin that enables store owners to design a toaster popup notifier that will inform customers after the product has been successfully added to the cart.', HVSFW_PLUGIN_DOMAIN )
            ],
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
     * @param  string  $collection_slug  Contains the slug (index) of the plugins in collections.
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
     * Check if a certain plugin is installed or exists in the plugin direction based on the plugin slug.
     * 
     * @since 1.0.0
     *
     * @param  string  $plugin_slug  Contains the slug of the plugin.
     * @return boolean
     */
    public static function is_installed( $plugin_slug ) {
        if ( empty( $plugin_slug ) ) {
            return false;
        }

        $folder = $plugin_slug .'/'. $plugin_slug . '.php';
        return ( array_key_exists( $folder, get_plugins() ) );
    }

    /**
     * Check if a certain plugin is active and enabled based on the collection slug.
     *
     * @since 1.0.0
     * 
     * @param  string  $collection_slug  Contains the slug of the plugins in collections.
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