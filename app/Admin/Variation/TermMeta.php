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
        $this->taxonomy = ( isset( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : false );
        if ( ! $this->taxonomy ) {
            return;
        }

        // Register styles and scripts.
        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

        // Render term swatch setting form data in adding and edit.
        add_action( $this->taxonomy . '_add_form_fields', [ $this, 'add_term_swatch_setting_form' ] );
        add_action( $this->taxonomy . '_edit_form_fields', [ $this, 'edit_term_swatch_setting_form' ], 10 );

       // Saving the term swatch form data.
        add_action( 'created_' . $this->taxonomy, [ $this, 'save_term_swatch_setting' ] );
        add_action( 'edited_' . $this->taxonomy, [ $this, 'save_term_swatch_setting' ] );

    }

    /**
     * Checks if the page is in product taxonomy edit page.
     *
     * @since 1.0.0
     * 
     * @return boolean
     */
    private function is_correct_page() {
        return ( isset( $_GET['taxonomy'] ) && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'product' );
    }

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( ! in_array( $hook_suffix, [ 'edit-tags.php', 'term.php' ] ) || ! $this->is_correct_page() ) {
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
        if ( ! in_array( $hook_suffix, [ 'edit-tags.php', 'term.php' ] ) || ! $this->is_correct_page() ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

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

        $filename = $settings['type'] . '-setting-form-add';
        echo Helper::render_view( "variation/term/$filename" );
    }

    /**
     * Render the term swatch setting form in editing attribute terms page.
     *
     * @since 1.0.0
     * 
     * @param object  $term  The current term editing.
     */
    public function edit_term_swatch_setting_form( $term ) {
        $attribute_id = Helper::get_attribute_taxonomy_id( $this->taxonomy );
        $settings     = Helper::get_swatch_settings( $attribute_id );
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], [ 'color', 'image' ] ) ) {
            return;
        }

        $filename = $settings['type'] . '-setting-form-edit';
        echo Helper::render_view( "variation/term/$filename", [
            'term_id' => $term->term_id
        ]);
    }

    /**
     * Saving the term swatch setting during adding and editing term.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     */
    public function save_term_swatch_setting( $term_id ) {
        if ( ! isset( $_POST['hvsfw_colors'] ) && ! isset( $_POST['hvsfw_image'] ) ) {
            return;
        }

        $meta = [];

        // Save color.
        if ( isset( $_POST['hvsfw_colors'] ) ) {
            $colors = $_POST['hvsfw_colors'];
            if ( empty( $colors ) || ! is_array( $colors ) ) {
                return;
            }

            $meta['key'] = '_hvsfw_colors';
            foreach ( $colors as $color ) {
                $meta['value'][] = Helper::validate_color([
                    'value'   => $color,
                    'default' => '#ffffff'
                ]);
            }
        }
        
        // Saving image.
        if ( isset( $_POST['hvsfw_image'] ) ) {
            $meta['key']   = '_hvsfw_image';
            $meta['value'] = sanitize_text_field( $_POST['hvsfw_image'] );
        }

        update_term_meta( $term_id, $meta['key'], $meta['value'] );
    }
}