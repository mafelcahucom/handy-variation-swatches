<?php
/**
 * App > Admin > Variation > Term Meta.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Inc\Validator;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * The `TermMeta` class contains the all swatch
 * term meta data.
 *
 * @since 1.0.0
 */
final class TermMeta {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
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
        $this->taxonomy = ( isset( $_REQUEST['taxonomy'] ) ? $_REQUEST['taxonomy'] : false );
        if ( ! $this->taxonomy ) {
            return;
        }

        /**
         * Register styles and scripts.
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );

        /**
         * Render term swatch setting form data in adding and edit.
         */
        add_action( $this->taxonomy . '_add_form_fields', array( $this, 'add_term_swatch_setting_form' ) );
        add_action( $this->taxonomy . '_edit_form_fields', array( $this, 'edit_term_swatch_setting_form' ), 10 );

        /**
         * Render tooltip swatch setting form data in adding and edit.
         */
        add_action( $this->taxonomy . '_add_form_fields', array( $this, 'add_tooltip_swatch_setting_form' ) );
        add_action( $this->taxonomy . '_edit_form_fields', array( $this, 'edit_tooltip_swatch_setting_form' ) );

        /**
         * Saving the term swatch form data.
         */
        add_action( 'created_' . $this->taxonomy, array( $this, 'save_term_swatch_setting' ) );
        add_action( 'edited_' . $this->taxonomy, array( $this, 'save_term_swatch_setting' ) );

        /**
         * Saving the tooltip swatch form data.
         */
        add_action( 'created_' . $this->taxonomy, array( $this, 'save_tooltip_swatch_setting' ) );
        add_action( 'edited_' . $this->taxonomy, array( $this, 'save_tooltip_swatch_setting' ) );

        /**
         * Adding the swatch type column in term list.
         */
        add_filter( 'manage_edit-' . $this->taxonomy . '_columns', array( $this, 'add_swatch_type_column' ) );

        /**
         * Render the swatch component in swatch type column.
         */
        add_action( 'manage_' . $this->taxonomy . '_custom_column', array( $this, 'render_swatch_type_component' ), 10, 3 );
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
     * @since 1.0.0
     *
     * @param  string $hook_suffix Contains the hook suffix for the current admin page.
     * @return void
     */
    public function register_styles( $hook_suffix ) {
        if ( ! in_array( $hook_suffix, array( 'edit-tags.php', 'term.php' ), true ) || ! $this->is_correct_page() ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );

        $asset        = include HVSFW_PLUGIN_PATH . 'public/admin/styles/hvsfw-term.asset.php';
        $asset['src'] = Helper::get_public_src( 'styles/hvsfw-term.css' );
        wp_register_style( 'hvsfw-term', $asset['src'], $asset['dependencies'], $asset['version'], 'all' );
        wp_enqueue_style( 'hvsfw-term' );
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     *
     * @param  string $hook_suffix Contains the hook suffix for the current admin page.
     * @return void
     */
    public function register_scripts( $hook_suffix ) {
        if ( ! in_array( $hook_suffix, array( 'edit-tags.php', 'term.php' ), true ) || ! $this->is_correct_page() ) {
            return;
        }

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        $asset                 = include HVSFW_PLUGIN_PATH . 'public/admin/scripts/hvsfw-term.asset.php';
        $asset['src']          = Helper::get_public_src( 'scripts/hvsfw-term.js' );
        $asset['dependencies'] = array( 'jquery', 'wp-color-picker' );
        wp_register_script( 'hvsfw-term', $asset['src'], $asset['dependencies'], $asset['version'], true );
        wp_enqueue_script( 'hvsfw-term' );
    }

    /**
     * Render the term swatch setting form in adding attribute terms page.
     *
     * @since 1.0.0
     *
     * @param  string $taxonomy_slug Contains the taxonomy slug.
     * @return void
     */
    public function add_term_swatch_setting_form( $taxonomy_slug ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], array( 'color', 'image' ), true ) ) {
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
     * @param  object $term Contains the current term editing.
     * @return void
     */
    public function edit_term_swatch_setting_form( $term ) {
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], array( 'color', 'image' ), true ) ) {
            return;
        }

        $filename = $settings['type'] . '-setting-form-edit';
        echo Helper::render_view( "variation/term/$filename", array(
            'term_id' => $term->term_id,
        ));
    }

    /**
     * Render the tooltip swatch setting form in adding attribute terms page.
     *
     * @since 1.0.0
     *
     * @param  string $taxonomy_slug Contains the taxonomy slug.
     * @return void
     */
    public function add_tooltip_swatch_setting_form( $taxonomy_slug ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], array( 'button', 'color', 'image' ), true ) ) {
            return;
        }

        echo Helper::render_view( 'variation/term/tooltip-setting-form-add', array(
            'type' => $settings['type'],
        ));
    }

    /**
     * Render the tooltip swatch setting form in editing attribute terms page.
     *
     * @since 1.0.0
     *
     * @param  object $term Contains the current term editing.
     * @return void
     */
    public function edit_tooltip_swatch_setting_form( $term ) {
        $settings = $this->get_settings();
        if ( empty( $settings ) ) {
            return;
        }

        if ( ! in_array( $settings['type'], array( 'button', 'color', 'image' ), true ) ) {
            return;
        }

        echo Helper::render_view( 'variation/term/tooltip-setting-form-edit', array(
            'type'    => $settings['type'],
            'term_id' => $term->term_id,
        ));
    }

    /**
     * Saving the term swatch setting during adding and editing term.
     *
     * @since 1.0.0
     *
     * @param  integer $term_id Contains the target term id.
     * @return void
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
                $meta_value[] = Validator::validate_color(array(
                    'value'   => $color,
                    'default' => '#ffffff',
                ));
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
                // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
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
     * @param  integer $term_id Contains the target term id.
     * @return void
     */
    public function save_tooltip_swatch_setting( $term_id ) {
        if ( ! isset( $_POST['hvsfw_tooltip_type'] ) ) {
            return;
        }

        $meta_value['type'] = Validator::validate_select(array(
            'value'   => $_POST['hvsfw_tooltip_type'],
            'default' => 'none',
            'choices' => array( 'none', 'text', 'html', 'image' ),
        ));

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
     * @param  array $columns the current list of columns.
     * @return array
     */
    public function add_swatch_type_column( $columns ) {
        global $taxnow;
        if ( $taxnow !== $this->taxonomy ) {
            return $columns;
        }

        $settings = $this->get_settings();
        if ( ! in_array( $settings['type'], array( 'color', 'image' ), true ) ) {
            return $columns;
        }

        $new_column = array();
        $new_column[ 'hvsfw_' . $settings['type'] ] = ucfirst( $settings['type'] );

        return array_merge( array_slice( $columns, 0, 1 ), $new_column, array_slice( $columns, 1 ) );
    }

    /**
     * Render the swatch component in swatch type column.
     *
     * @since 1.0.0
     *
     * @param  string  $text        Contains the custom column output.
     * @param  string  $column_name Contains the name of the column.
     * @param  integer $term_id     Contains the term ID.
     * @return string
     */
    public function render_swatch_type_component( $text, $column_name, $term_id ) {
        global $taxnow;
        if ( $taxnow !== $this->taxonomy ) {
            return $text;
        }

        if ( ! in_array( $column_name, array( 'hvsfw_color', 'hvsfw_image' ), true ) ) {
            return $text;
        }

        $type = str_replace( 'hvsfw_', '', $column_name );
        echo Helper::render_view( "variation/term/preview/$type-swatch", array(
            'term_id' => $term_id,
        ));
    }
}
