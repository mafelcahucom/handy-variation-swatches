<?php
namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
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

        // Render tooltip swatch setting form data in adding and edit.
        add_action( $this->taxonomy . '_add_form_fields', [ $this, 'add_tooltip_swatch_setting_form' ] );
        add_action( $this->taxonomy . '_edit_form_fields', [ $this, 'edit_tooltip_swatch_setting_form' ] );

        // Saving the term swatch form data.
        add_action( 'created_' . $this->taxonomy, [ $this, 'save_term_swatch_setting' ] );
        add_action( 'edited_' . $this->taxonomy, [ $this, 'save_term_swatch_setting' ] );

        // Saving the tooltip swatch form data.
        add_action( 'created_' . $this->taxonomy, [ $this, 'save_tooltip_swatch_setting' ] );
        add_action( 'edited_' . $this->taxonomy, [ $this, 'save_tooltip_swatch_setting' ] );

        // Adding the swatch type column in term list.
        add_filter( 'manage_edit-'. $this->taxonomy .'_columns', [ $this, 'add_swatch_type_column' ] );

        // Render the swatch component in swatch type column.
        add_action( 'manage_'. $this->taxonomy .'_custom_column', [ $this, 'render_swatch_type_component' ], 10, 3 );
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
     * Return the swatch settings.
     *
     * @since 1.0.0
     * 
     * @return array.
     */
    private function get_settings() {
        $attribute_id = wc_attribute_taxonomy_id_by_name( $this->taxonomy );
        return Utility::get_swatch_settings( $attribute_id );
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
        $settings = $this->get_settings();
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
        $settings = $this->get_settings();
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
     * Render the tooltip swatch setting form in adding attribute terms page.
     *
     * @since 1.0.0
     *
     * @param string  $taxonomy_slug  The taxonomy slug.
     */
    public function add_tooltip_swatch_setting_form( $taxonomy_slug ) {
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], [ 'button', 'color', 'image' ] ) ) {
            return;
        }

        echo Helper::render_view( 'variation/term/tooltip-setting-form-add', [
            'type' => $settings['type']
        ]);
    }

    /**
     * Render the tooltip swatch setting form in editing attribute terms page.
     *
     * @since 1.0.0
     * 
     * @param object  $term  The current term editing.
     */
    public function edit_tooltip_swatch_setting_form( $term ) {
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], [ 'button', 'color', 'image' ] ) ) {
            return;
        }

        echo Helper::render_view( 'variation/term/tooltip-setting-form-edit', [
            'type'    => $settings['type'],
            'term_id' => $term->term_id,
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
        if ( ! isset( $_POST['hvsfw_color_swatch'] ) && ! isset( $_POST['hvsfw_image_swatch'] ) ) {
            return;
        }

        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        // Save color.
        if ( isset( $_POST['hvsfw_color_swatch'] ) ) {
            $colors = $_POST['hvsfw_color_swatch'];
            if ( empty( $colors ) || ! is_array( $colors ) || $settings['type'] !== 'color' ) {
                return;
            }

            foreach ( $colors as $color ) {
                $meta_value[] = Helper::validate_color([
                    'value'   => $color,
                    'default' => '#ffffff'
                ]);
            }
        }
        
        // Saving image.
        if ( isset( $_POST['hvsfw_image_swatch'] ) ) {
            if ( is_array( $_POST['hvsfw_image_swatch'] ) || $settings['type'] !== 'image' ) {
                return;
            }

            $meta_value = sanitize_text_field( $_POST['hvsfw_image_swatch'] );
            $meta_value = ( is_numeric( $meta_value ) ? $meta_value : 0 );

            // Saving image size.
            if ( isset( $_POST['hvsfw_image_size_swatch'] ) ) {
                $image_sizes         = array_column( Helper::get_image_sizes(), 'value' );
                $current_image_size  = sanitize_text_field( $_POST['hvsfw_image_size_swatch'] );
                if ( in_array( $current_image_size, $image_sizes ) ) {
                    update_term_meta( $term_id, '_hvsfw_image_size', $current_image_size );
                }
            }
        }

        update_term_meta( $term_id, '_hvsfw_value', $meta_value );
    }

    /**
     * Saving the tooltip swatch setting during adding and editing term.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     */
    public function save_tooltip_swatch_setting( $term_id ) {
        if ( ! isset( $_POST['hvsfw_tooltip_type'] ) ) {
            return;
        }

        $meta_value['type'] = Helper::validate_select([
            'value'   => $_POST['hvsfw_tooltip_type'],
            'default' => 'none',
            'choices' => [ 'none', 'text', 'html', 'image' ]
        ]);

        $meta_value['content'] = '';
        switch ( $meta_value['type'] ) {
            case 'text':
                if ( isset( $_POST['hvsfw_tooltip_text'] ) ) {
                    $meta_value['content'] = sanitize_text_field( $_POST['hvsfw_tooltip_text'] );
                }
                break;
            case 'html':
                if ( isset( $_POST['hvsfw_tooltip_html'] ) ) {
                    $meta_value['content'] = wp_kses_post( $_POST['hvsfw_tooltip_html'] );
                }
                break;
            case 'image':
                if ( isset( $_POST['hvsfw_tooltip_image'] ) ) {
                    $meta_value['content'] = sanitize_text_field( $_POST['hvsfw_tooltip_image'] );
                }
                break;
        }

        update_term_meta( $term_id, '_hvsfw_tooltip', $meta_value );
    }

    /**
     * Adding the swatch type column in term list.
     *
     * @param array  $columns  Containg the current list of columns.
     *
     * @return array
     */
    public function add_swatch_type_column( $columns ) {
        global $taxnow;
        if ( $taxnow !== $this->taxonomy ) {
            return $columns;
        }

        $settings = $this->get_settings();
        if ( ! in_array( $settings['type'], [ 'color', 'image' ] ) ) {
            return $columns;
        }

        $new_column = [];
        $new_column[ 'hvsfw_' . $settings['type'] ] = ucfirst( $settings['type'] );
      
        return array_merge( array_slice( $columns, 0, 1 ), $new_column, array_slice( $columns, 1 ) );
    }

    /**
     * Render the swatch component in swatch type column.
     *
     * @since 1.0.0
     * 
     * @param  string   $string       The custom column output.
     * @param  string   $column_name  The name of the column.
     * @param  integer  $term_id      The term ID.
     * @return HTMLElement
     */
    public function render_swatch_type_component( $string, $column_name, $term_id ) {
        global $taxnow;
        if ( $taxnow !== $this->taxonomy ) {
            return $string;
        }

        if ( ! in_array( $column_name, [ 'hvsfw_color', 'hvsfw_image' ] ) ) {
            return $string;
        }

        $type = str_replace( 'hvsfw_', '', $column_name );
        echo Helper::render_view( "variation/term/preview/$type-swatch", [
            'term_id' => $term_id
        ]);
    }
}