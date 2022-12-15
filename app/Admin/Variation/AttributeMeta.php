<?php
namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Attribute Meta.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class AttributeMeta {

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

        // Render attribute type selector.
        add_filter( 'product_attributes_type_selector', [ $this, 'attribute_type_selector_field' ], 10, 1 );
        
        // Render attribute swatch form in adding and edit.
        add_action( 'woocommerce_after_add_attribute_fields', [ $this, 'attribute_swatch_setting_form' ] );
        add_action( 'woocommerce_after_edit_attribute_fields', [ $this, 'attribute_swatch_setting_form' ] );

        // Saving the attribute swatch form data.
        add_action( 'woocommerce_attribute_added', [ $this, 'save_attribute_swatch_setting' ] );
        add_action( 'woocommerce_attribute_updated', [ $this, 'save_attribute_swatch_setting' ] );

        // Deleting the attribute swatch form data.
        add_action( 'woocommerce_attribute_deleted', [ $this, 'delete_attribute_swatch_setting' ] );
    }

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
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
     * @param string  $hook_suffix  Hook suffix for the current admin page.
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
     * Return the swatch setting field schema.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    private function get_swatch_setting_field_schema() {
        return [
            'type'                    => [
                'type'    => 'select',
                'default' => 'select',
                'choices' => [ 'select', 'button', 'color', 'image' ]
            ],
            'style'                   => [
                'type'    => 'select',
                'default' => 'default',
                'choices' => [ 'default', 'custom' ]
            ],
            'shape'                   => [
                'type'    => 'select',
                'default' => 'square',
                'choices' => [ 'square', 'circle', 'custom' ]
            ],
            'size'                    => [
                'type'    => 'size',
                'default' => '40px',
            ],
            'width'                   => [
                'type'    => 'size',
                'default' => '40px',
            ],
            'height'                  => [
                'type'    => 'size',
                'default' => '40px',
            ],
            'font_size'               => [
                'type'    => 'size',
                'default' => '14px',
            ],
            'font_weight'             => [
                'type'    => 'select',
                'default' => '500',
                'choices' => Helper::get_font_weight_choices( 'value' )
            ],
            'font_color'              => [
                'type'    => 'color',
                'default' => '#000000'
            ],
            'font_hover_color'        => [
                'type'    => 'color',
                'default' => '#0071f2'
            ],
            'background_color'        => [
                'type'    => 'color',
                'default' => '#ffffff'
            ],
            'background_hover_color'  => [
                'type'    => 'color',
                'default' => '#ffffff'
            ],
            'padding_top'             => [
                'type'    => 'size',
                'default' => '5px',
            ],
            'padding_bottom'          => [
                'type'    => 'size',
                'default' => '5px',
            ],
            'padding_left'            => [
                'type'    => 'size',
                'default' => '5px',
            ],
            'padding_right'           => [
                'type'    => 'size',
                'default' => '5px',
            ],
            'border_style'            => [
                'type'    => 'select',
                'default' => 'solid',
                'choices' => Helper::get_border_style_choices( 'value' )
            ],
            'border_width'            => [
                'type'    => 'size',
                'default' => '1px',
            ],
            'border_color'            => [
                'type'    => 'color',
                'default' => '#000000'
            ],
            'border_hover_color'      => [
                'type'    => 'color',
                'default' => '#0071f2'
            ],
            'border_radius'           => [
                'type'    => 'size',
                'default' => '0px',
            ],
        ];
    }

    /**
     * Update or add a new attribute id in _hvsfw_swatch_attribute_ids
     * in the wp_options table.
     *
     * @since 1.0.0
     * 
     * @param  integer  $id  The attribute id to be inserted.
     */
    private function update_option_attribute_id( $id ) {
        if ( empty( $id ) ) {
            return;
        }

        $ids = get_option( '_hvsfw_swatch_attribute_ids' );
        $ids = ( ! empty( $ids ) ? $ids : [] );

        if ( ! in_array( $id, $ids ) ) {
            $ids[] = $id;
            update_option( '_hvsfw_swatch_attribute_ids', $ids );
        }
    }

    /**
     * Delete a certain attribute id in _hvsfw_swatch_attribute_ids
     * in the wp_options table.
     *
     * @since 1.0.0
     * 
     * @param  integer  $id  The attribute id to be deleted.
     */
    private function delete_option_attribute_id( $id ) {
        if ( empty( $id ) ) {
            return;
        }

        $ids = get_option( '_hvsfw_swatch_attribute_ids' );
        $ids = ( ! empty( $ids ) ? $ids : [] );

        if ( ! empty( $ids ) ) {
            $unsetted_ids = Helper::array_unset_by_value( $ids, [ $id ] );
            update_option( '_hvsfw_swatch_attribute_ids', $unsetted_ids );
        }
    }

    /**
     * Render the attribute type selector field.
     *
     * @since 1.0.0
     *
     * @param  array  $types  Containing the current attribute types.
     * 
     * @return array
     */
    public function attribute_type_selector_field( $types ) {
        $screen = get_current_screen();
        if ( isset( $screen->id ) && $screen->id === 'product_page_product_attributes' ) {
            $types = [
                'select' => 'Select',
                'button' => 'Button',
                'color'  => 'Color',
                'image'  => 'Image'
            ];
        }

        return $types;
    }

    /**
     * Render the product attribute swatch setting form in adding and edit attribute page.
     *
     * @since 1.0.0
     */
    public function attribute_swatch_setting_form() {
        $id      = isset( $_GET['edit'] ) ? absint( $_GET['edit'] ) : 0;
        $setting = ( $id !== 0 ? get_option( "_hvsfw_swatch_attribute_setting_$id" ) : [] );

        $default = [];
        foreach ( $this->get_swatch_setting_field_schema() as $key => $field ) {
            $default[ $key ] = $field['default'];
        }

        $form_type = ( $id === 0 ? 'add' : 'edit' );
        echo Helper::render_view( "variation/attribute/swatch-setting-form-$form_type", [
            'setting' => $setting,
            'default' => $default
        ]);
    }

    /**
     * Saving the attribute swatch setting during adding and editing attribute.
     *
     * @since 1.0.0
     * 
     * @param  integer  $id  Added attribute ID.
     */
    public function save_attribute_swatch_setting( $id ) {
        // Validating the fields value from $_POST.
        $validated_value = [];
        $field_schema    = $this->get_swatch_setting_field_schema();
        foreach ( $field_schema as $key => $field ) {
            $validated_value[ $key ] = $field['default'];
                       
            $post_key = ( $key === 'type' ? "attribute_type" : "hvsfw_$key" );
            if ( isset( $_POST[ $post_key ] ) ) {
                switch ( $field['type'] ) {
                    case 'size':
                        $validated_value[ $key ] = Helper::validate_size([
                            'value'   => $_POST[ $post_key ],
                            'default' => $field['default'] 
                        ]);
                        break;
                    case 'color':
                        $validated_value[ $key ] = Helper::validate_color([
                            'value'   => $_POST[ $post_key ],
                            'default' => $field['default']
                        ]);
                        break;
                    case 'select':
                        $validated_value[ $key ] = Helper::validate_select([
                            'value'   => $_POST[ $post_key ],
                            'default' => $field['default'],
                            'choices' => $field['choices']
                        ]);
                        break;
                }
            }
        }

        // Setting the necessary fields.
        $fields_to_save = [ 'type', 'style' ];
        if ( $validated_value['style'] === 'custom' ) {
            // Swatch button.
            if ( $validated_value['type'] === 'button' ) {
                $remove = [ 'size', 'border_radius' ];
                if ( $validated_value['shape'] === 'custom' ) {
                    unset( $remove[1] );
                }
            }

            // Swatch color and image.
            if ( in_array( $validated_value['type'], [ 'color', 'image' ] ) ) {
                $remove = [
                    'width', 'height', 'font_size', 'font_weight', 'font_color', 'font_hover_color',
                    'background_color', 'background_hover_color', 'padding_top', 'padding_bottom',
                    'padding_left', 'padding_right', 'border_radius'
                ];

                if ( $validated_value['shape'] === 'custom' ) {
                    unset( $remove[0] );
                    unset( $remove[1] );
                    unset( $remove[12] );
                    $remove[] = 'size';
                }
            }

            $field_keys     = array_keys( $validated_value );
            $fields_to_save = Helper::array_unset_by_value( $field_keys, $remove );
        }

        // Unsetting the unnecessary fields.
        foreach ( $validated_value as $key => $value ) {
            if ( ! in_array( $key, $fields_to_save ) ) {
                unset( $validated_value[ $key ] );
            }
        }

        // Delete term metas of this attribute if type has changed.
        $current_setting = Helper::get_swatch_settings( $id );
        if ( ! empty( $current_setting ) ) {
            $is_changed     = ( $current_setting['type'] !== $validated_value['type'] );
            $in_color_image = in_array( $current_setting['type'], [ 'color', 'image' ] );
            if ( $is_changed && $in_color_image ) {
                $this->delete_term_meta_associate_by_attribute( $id );
            }
        }

        // Saving swatch attribute settings in wp_options.
        update_option( "_hvsfw_swatch_attribute_setting_$id", $validated_value );

        // Adding the newly added attribute id to attribute ids in wp_options.
        $this->update_option_attribute_id( $id );
    }

    /**
     * Deleting the attribute swatch setting during deleting attribute.
     *
     * @since 1.0.0
     * 
     * @param  integer  $id  Added attribute ID.
     */
    public function delete_attribute_swatch_setting( $id ) {
        delete_option( "_hvsfw_swatch_attribute_setting_$id" );

        $this->delete_option_attribute_id( $id );
    }

    /**
     * Delete all the term metas that are associate with attrbute.
     *
     * @since 1.0.0
     *
     * @param  integer  $attribute_id  The target attribute id.
     */
    private function delete_term_meta_associate_by_attribute( $attribute_id ) {
        if ( empty( $attribute_id ) ) {
            return;
        }

        $taxonomy = wc_attribute_taxonomy_name_by_id( $attribute_id );
        $terms    = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false
        ]);

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                delete_term_meta( $term->term_id, '_hvsfw_value' );
            }
        }
    }
}