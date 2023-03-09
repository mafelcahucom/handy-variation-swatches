<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Swatch Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SwatchHelper {

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
     * Return the swatch setting field schema.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_swatch_setting_schema() {
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
            'gap'                     => [
                'type'    => 'size',
                'default' => '10px'
            ]
        ];
    }

    /**
     * Return the visibility state of each setting group field.
     *
     * @since 1.0.0
     * 
     * @param  array  $settings  Containg the current value of the swatch setting.
     * @return array
     */
    public static function get_swatch_setting_group_field_visibility( $settings ) {
        if ( empty( $settings ) ) {
            return;
        }

        $visible = [
            'style'            => 'no',
            'shape'            => 'no',
            'size'             => 'no',
            'dimension'        => 'no',
            'font'             => 'no',
            'text_color'       => 'no',
            'background_color' => 'no',
            'padding'          => 'no',
            'border'           => 'no',
            'border_radius'    => 'no',
            'gap'              => 'no'
        ];

        // Style.
        if ( ! in_array( $settings['type'], [ 'default', 'select', 'assorted' ] ) ) {
            $visible['style'] = 'yes';

            if ( $settings['style'] === 'custom' ) {
                $is_color_image = in_array( $settings['type'], [ 'color', 'image' ] );

                // Shape, Border, Gap.
                $visible['shape']  = 'yes';
                $visible['border'] = 'yes';
                $visible['gap']    = 'yes';

                // Size.
                if ( $is_color_image && $settings['shape'] !== 'custom' ) {
                    $visible['size'] = 'yes';
                }

                // Dimension.
                $visible['dimension'] = 'yes';
                if ( $is_color_image && $settings['shape'] !== 'custom' ) {
                    $visible['dimension'] = 'no';
                }

                // Font, Text Color, Background Color, Padding.
                if ( $settings['type'] === 'button' ) {
                    $visible['font']             = 'yes';
                    $visible['text_color']       = 'yes';
                    $visible['background_color'] = 'yes';
                    $visible['padding']          = 'yes';
                }

                // Border Radius.
                if ( $settings['shape'] === 'custom' ) {
                    $visible['border_radius'] = 'yes';
                }
            }
        }

        return $visible;
    }

    /**
     * Return the validated and sanitized swatch setting value.
     *
     * @since 1.0.0
     *
     * @param  array   $args     Containg the necessary arguments for validating swatch setting.
     * $args = [
     *     'type'    => (string) The swatch type.
     *     'setting' => (array) Containing the setting to be validated.
     * ]
     * @return array
     */
    public static function validate_swatch_setting_value( $args = [] ) {
        if ( ! isset( $args['type'] ) || ! isset( $args['setting'] ) ) {
            return;
        }

        $validated    = []; // Store the validated value.
        $field_schema = self::get_swatch_setting_schema();
        foreach ( $field_schema as $key => $field ) {
            $validated[ $key ] = $field['default'];

            $post_key = $key;
            if ( $args['type'] === 'UNSET' ) {
                $post_key = ( $key === 'type' ? "attribute_type" : "hvsfw_$key" );
            } else {
                $args['setting']['type'] = $args['type'];
            }

            if ( isset( $args['setting'][ $post_key ] ) ) {
                switch ( $field['type'] ) {
                    case 'size':
                        $validated[ $key ] = Helper::validate_size([
                            'value'   => $args['setting'][ $post_key ],
                            'default' => $field['default'] 
                        ]);
                        break;
                    case 'color':
                        $validated[ $key ] = Helper::validate_color([
                            'value'   => $args['setting'][ $post_key ],
                            'default' => $field['default']
                        ]);
                        break;
                    case 'select':
                        $validated[ $key ] = Helper::validate_select([
                            'value'   => $args['setting'][ $post_key ],
                            'default' => $field['default'],
                            'choices' => $field['choices']
                        ]);
                        break;
                }
            }
        }

        // Set the necessary fields.
        $remove          = [];
        $fields_to_save  = [ 'type', 'style' ];
        $has_unnecessary = ( in_array( $validated['type'], [ 'button', 'color', 'image' ] ) && $validated['style'] === 'custom' );
        if ( $has_unnecessary ) {
            // Button.
            if ( $validated['type'] === 'button' ) {
                $remove = [ 'size', 'border_radius' ];
                if ( $validated['shape'] === 'custom' ) {
                    unset( $remove[1] );
                }
            }

            // Color & Image.
            if ( in_array( $validated['type'], [ 'color', 'image' ] ) ) {
                $remove = [
                    'width', 'height', 'font_size', 'font_weight', 'font_color', 'font_hover_color',
                    'background_color', 'background_hover_color', 'padding_top', 'padding_bottom',
                    'padding_left', 'padding_right', 'border_radius'
                ];

                if ( $validated['shape'] === 'custom' ) {
                    unset( $remove[0] );
                    unset( $remove[1] );
                    unset( $remove[12] );
                    $remove[] = 'size';
                }
            }

            $field_keys     = array_keys( $validated );
            $fields_to_save = Helper::array_unset_by_value( $field_keys, $remove );
        }

        // Unset the unnecessary fields.
        foreach ( $validated as $key => $value ) {
            if ( ! in_array( $key, $fields_to_save ) ) {
                unset( $validated[ $key ] );
            }
        }

        // Unset type.
        if ( $args['type'] !== 'UNSET' ) {
            unset( $validated['type'] );
        }

        return $validated;
    }
}