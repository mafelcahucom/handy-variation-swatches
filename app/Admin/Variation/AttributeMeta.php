<?php
/**
 * App > Admin > Variation > Attribute Meta.
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
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\SwatchHelper;

defined( 'ABSPATH' ) || exit;

/**
 * The `AttributeMeta` class contains the all swatch
 * attribute meta data.
 *
 * @since 1.0.0
 */
final class AttributeMeta {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Register styles and scripts.
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );

        /**
         * Render attribute type selector.
         */
        add_filter( 'product_attributes_type_selector', array( $this, 'attribute_type_selector_field' ), 10, 1 );

        /**
         * Render attribute swatch form in adding and edit.
         */
        add_action( 'woocommerce_after_add_attribute_fields', array( $this, 'attribute_swatch_setting_form' ) );
        add_action( 'woocommerce_after_edit_attribute_fields', array( $this, 'attribute_swatch_setting_form' ) );

        /**
         * Saving the attribute swatch form data.
         */
        add_action( 'woocommerce_attribute_added', array( $this, 'save_attribute_swatch_setting' ) );
        add_action( 'woocommerce_attribute_updated', array( $this, 'save_attribute_swatch_setting' ) );

        /**
         * Deleting the attribute swatch form data.
         */
        add_action( 'woocommerce_attribute_deleted', array( $this, 'delete_attribute_swatch_setting' ) );
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
        if ( $hook_suffix !== 'product_page_product_attributes' ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );

        $asset        = include HVSFW_PLUGIN_PATH . 'public/admin/styles/hvsfw-attribute.asset.php';
        $asset['src'] = Helper::get_public_src( 'styles/hvsfw-attribute.css' );
        wp_register_style( 'hvsfw-attribute', $asset['src'], $asset['dependencies'], $asset['version'], 'all' );
        wp_enqueue_style( 'hvsfw-attribute' );
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
        if ( $hook_suffix !== 'product_page_product_attributes' ) {
            return;
        }

        $asset                 = include HVSFW_PLUGIN_PATH . 'public/admin/scripts/hvsfw-attribute.asset.php';
        $asset['src']          = Helper::get_public_src( 'scripts/hvsfw-attribute.js' );
        $asset['dependencies'] = array( 'jquery', 'wp-color-picker' );
        wp_register_script( 'hvsfw-attribute', $asset['src'], $asset['dependencies'], $asset['version'], true );
        wp_enqueue_script( 'hvsfw-attribute' );
    }

    /**
     * Render the attribute type selector field.
     *
     * @since 1.0.0
     *
     * @param  array $types Contains the current attribute types.
     * @return array
     */
    public function attribute_type_selector_field( $types ) {
        $screen = get_current_screen();
        if ( isset( $screen->id ) && $screen->id === 'product_page_product_attributes' ) {
            $types = array(
                'select' => 'Select',
                'button' => 'Button',
                'color'  => 'Color',
                'image'  => 'Image',
            );
        }

        return $types;
    }

    /**
     * Render the product attribute swatch setting form in
     * adding and edit attribute page.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function attribute_swatch_setting_form() {
        $id      = isset( $_GET['edit'] ) ? absint( $_GET['edit'] ) : 0;
        $setting = ( $id !== 0 ? get_option( "_hvsfw_swatch_attribute_setting_$id" ) : array() );

        $default = array();
        foreach ( SwatchHelper::get_swatch_setting_schema() as $key => $field ) {
            $default[ $key ] = $field['default'];
        }

        $form_type = ( $id === 0 ? 'add' : 'edit' );
        echo Helper::render_view( "variation/attribute/swatch-setting-form-$form_type", array(
            'setting' => $setting,
            'default' => $default,
        ));
    }

    /**
     * Saving the attribute swatch setting during adding
     * and editing attribute.
     *
     * @since 1.0.0
     *
     * @param  integer $id Contains the added attribute ID.
     * @return void
     */
    public function save_attribute_swatch_setting( $id ) {
        // Validate the swatch setting value.
        $validated = SwatchHelper::validate_swatch_setting_value(array(
            'type'    => 'UNSET',
            'setting' => $_POST,
        ));

        // Delete term metas of this attribute if type has changed.
        $current_setting = Utility::get_swatch_settings( $id );
        if ( ! empty( $current_setting ) ) {
            $is_changed     = ( $current_setting['type'] !== $validated['type'] );
            $in_color_image = in_array( $current_setting['type'], array( 'color', 'image' ), true );
            if ( $is_changed && $in_color_image ) {
                $this->delete_term_meta_associate_by_attribute( $id );
            }
        }

        // Saving swatch attribute settings in wp_options.
        update_option( "_hvsfw_swatch_attribute_setting_$id", $validated );
    }

    /**
     * Deleting the attribute swatch setting during deleting attribute.
     *
     * @since 1.0.0
     *
     * @param  integer $id Contains the added attribute ID.
     * @return void
     */
    public function delete_attribute_swatch_setting( $id ) {
        delete_option( "_hvsfw_swatch_attribute_setting_$id" );
    }

    /**
     * Delete all the term metas that are associate with attrbute.
     *
     * @since 1.0.0
     *
     * @param  integer $attribute_id Contains the target attribute id.
     * @return void
     */
    private function delete_term_meta_associate_by_attribute( $attribute_id ) {
        if ( empty( $attribute_id ) ) {
            return;
        }

        $taxonomy = wc_attribute_taxonomy_name_by_id( $attribute_id );
        $terms    = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ));

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                delete_term_meta( $term->term_id, '_hvsfw_value' );
            }
        }
    }
}
