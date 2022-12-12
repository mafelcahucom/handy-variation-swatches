<?php
namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Term Meta.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class TermMeta {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the current taxonomy.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $taxonomy;

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Set the taxonomy property.
        $this->taxonomy = ( isset( $_GET['taxonomy'] ) ? $_GET['taxonomy'] : false );
        if ( ! $this->taxonomy ) {
            return;
        }

        // Register styles and scripts.
        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

        add_action( $this->taxonomy . '_add_form_fields', [ $this, 'add_term_swatch_setting_form' ] );
        add_action( $this->taxonomy . '_edit_form_fields', [ $this, 'edit_term_swatch_setting_form' ], 10 );

    }

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'edit-tags.php' ) {
            return;
        }

        wp_register_style( 'hvsfw-term-css', Helper::get_asset_src( 'css/hvsfw-term.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'hvsfw-term-css' );
    }

    /**
     * Register all scripts.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'edit-tags.php' ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];

        wp_register_script( 'hvsfw-term-js', Helper::get_asset_src( 'js/hvsfw-term.min.js' ), $dependency, '1.0.0', true );
        wp_enqueue_script( 'hvsfw-term-js' );
    }

    /**
     * Render the term swatch setting form in adding attribute terms page.
     *
     * @since 1.0.0
     *
     * @param string  $taxonomy_slug  The taxonomy slug.
     */
    public function add_term_swatch_setting_form( $taxonomy_slug ) {
        $attribute_id = Helper::get_attribute_taxonomy_id( $this->taxonomy );
        $settings     = Helper::get_swatch_settings( $attribute_id );
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], [ 'color', 'image' ] ) ) {
            return;
        }

        $type = $settings['type'];
        echo Helper::render_view( "variation/term/$type-setting-form-add" );
    }

    /**
     * Render the term swatch setting form in editing attribute terms page.
     *
     * @since 1.0.0
     * 
     * @param object  $term  The current term editing.
     */
    public function edit_term_swatch_setting_form( $term ) {
        Helper::log( $term );
    }
}