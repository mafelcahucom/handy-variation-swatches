<?php
namespace HVSFW\Admin;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Attribute.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Attribute {

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

        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );
    
        add_action( 'woocommerce_after_add_attribute_fields', [ $this, 'attribute_swatch_setting_form' ] );
        add_action( 'woocommerce_after_edit_attribute_fields', [ $this, 'attribute_swatch_setting_form' ] );

        add_action( 'woocommerce_attribute_added', [ $this, 'saving' ] );
        add_action( 'woocommerce_attribute_updated', [ $this, 'saving' ] );

        add_action( 'woocommerce_attribute_deleted', [ $this, 'delete' ] );

    }

    /**
     * Register all styles.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'product_page_product_attributes' ) {
            return;
        }

        wp_register_style( 'hvsfw-attribute-css', Helper::get_asset_src( 'css/hvsfw-attribute.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'hvsfw-attribute-css' );
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'product_page_product_attributes' ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];

        wp_register_script( 'hvsfw-attribute-js', Helper::get_asset_src( 'js/hvsfw-attribute.min.js' ), $dependency, '1.0.0', true );

        wp_enqueue_script( 'hvsfw-attribute-js' );
    }

    /**
     * Render the product attribute swatch setting form in the admin > product > attribute.
     *
     * @since 1.0.0
     */
    public function attribute_swatch_setting_form() {
        $id      = isset( $_GET['edit'] ) ? absint( $_GET['edit'] ) : 0;
        $value   = ( $id !== 0 ? get_option( "_hvsfw_attribute_$id" ) : [] );
        $default = [
            'type'                   => 'button',
            'style'                  => 'default',
            'shape'                  => 'square',
            'size'                   => 40,
            'width'                  => 40,
            'height'                 => 40,
            'font_size'              => 14,
            'font_weight'            => '600',
            'font_color'             => 'rgba(0,0,0,1)',
            'font_hover_color'       => 'rgba(0,113,242,1)',
            'background_color'       => 'rgba(255,255,255)',
            'background_hover_color' => 'rgba(255,255,255)',
            'padding_top'            => 5,
            'padding_bottom'         => 5,
            'padding_left'           => 5,
            'padding_right'          => 5,
            'border_style'           => 'solid',
            'border_width'           => 1,
            'border_color'           => 'rgba(0,0,0,1)',
            'border_hover_color'     => 'rgba(0,113,242,1)',
            'border_radius'          => 0,
        ];

        $form_type = ( $id === 0 ? 'add' : 'edit' );
        echo Helper::render_view( "attribute/swatch-setting-form-$form_type", [
            'value'   => $value,
            'default' => $default
        ]);
    }

    public function saving( $id ) {
        if ( ! is_admin() ) {
            return;
        }

        Helper::log( $id );
        Helper::log( $_POST );
    }

    public function delete( $id ) {
        Helper::log( 'DELETING' );
        Helper::log( $id );
    }
}