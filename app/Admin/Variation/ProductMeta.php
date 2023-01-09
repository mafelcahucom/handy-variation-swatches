<?php
namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Product Meta.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ProductMeta {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {

        // Register styles and scripts.
        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

         // Add itemized variation product tab.
        add_filter( 'woocommerce_product_data_tabs', [ $this, 'custom_product_tab' ] );

        // Add itemized variation product panel.
        add_filter( 'woocommerce_product_data_panels', [ $this, 'custom_product_panel' ] );
    }

    /**
     * Checks if the page is in post product edit page.
     *
     * @since 1.0.0
     * 
     * @return boolean
     */
    private function is_correct_page() {
        $current_screen = get_current_screen();
        return ( isset( $current_screen->id ) && $current_screen->id === 'product' );
    }

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'post.php' && ! $this->is_correct_page() ) {
            return;
        }

        wp_register_style( 'hvsfw-product-css', Helper::get_asset_src( 'css/hvsfw-product.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'hvsfw-product-css' );
    }

    /**
     * Register all scripts.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'post.php' && ! $this->is_correct_page() ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        wp_register_script( 'hvsfw-product-js', Helper::get_asset_src( 'js/hvsfw-product.min.js' ), $dependency, '1.0.0', true );

        wp_enqueue_script( 'hvsfw-product-js' );
    }

    /**
     * Add product swatches tab.
     *
     * @since 1.0.0
     * 
     * @param  array  $tabs  Containing all the current registered tabs.
     * @return array
     */
    public function custom_product_tab( $tabs ) {
        $tabs['hvsfw_swatch_tab'] = [
            'label'    => 'Swatches',
            'target'   => 'hvsfw_swatch_panel',
            'class'    => [ 'show_if_variable' ],
            'priority' => 100,
        ];

        return $tabs;
    }

    /**
     * Add product swatches panel
     *
     * @since 1.0.0
     */
    public function custom_product_panel() {
        global $post;

        $product = wc_get_product( $post->ID );
        Helper::log( $product->get_type() );

        echo Helper::render_view( 'variation/meta-box/swatch-panel', [
            'product_id' => $post->ID
        ]);
    }

}