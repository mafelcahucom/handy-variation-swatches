<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Helper {

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
     * Return boolean whether the plugin has a missing
     * options "_hvsfw_plugin_version" or "_hvsfw_main_settings";
     *
     * @since 1.0.0
     * 
     * @return 1.0.0
     */
    public static function plugin_has_error() {
        return ( empty( get_option( '_hvsfw_plugin_version' ) ) || empty( get_option( '_hvsfw_main_settings' ) ) );
    }

    /**
     * Return the url root of the plugin.
     *
     * @since 1.0.0
     * 
     * @return string
     */
    public static function get_root_url() {
        return admin_url( 'admin.php?page=hvsfw' );
    }

    /**
     * Returns the base url of admin dist folder.
     *
     * @since 1.0.0
     * 
     * @param string  $file  Target filename.
     * @return string
     */
    public static function get_asset_src( $file ) {
        return HVSFW_PLUGIN_URL . 'assets/admin/dist/' . $file;
    }

    /**
     * Render admin view.
     *
     * @since 1.0.0
     * 
     * @param  string  $file  Target filename.
     * @param  array   $args  Additional arguments.
     * @return HTMLElement
     */
    public static function render_view( $filename, $args = [] ) {
        $file = HVSFW_PLUGIN_PATH . 'app/Views/admin/'. $filename .'.php';
        if ( ! file_exists( $file ) ) {
            return;
        }

        ob_start();
        require $file;
        return ob_get_clean();
    }


    /**
     * Returns the svg icon.
     *
     * @since 1.0.0
     * 
     * @param  string  $type       The type of icon.
     * @param  string  $classname  Additional classname.
     * @return string
     */
    public static function get_icon( $type, $classname = '' ) {
        return Icon::get( $type, $classname );
    }

    /**
     * Checks if the current page have $_GET['page'] = 'hvsfw'.
     *
     * @since 1.0.0
     * 
     * @return boolean
     */
    public static function is_correct_page() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] == 'hvsfw' );
    }

    /**
     * Checks if a certain admin menu is already exists.
     * Note only call this method inside "admin_menu" action.
     *
     * @since 1.0.0
     * 
     * @param  string  $menu_name  The slug of the menu.
     * @return boolean
     */
    public static function is_menu_exists( $menu_slug = '' ) {
        global $menu;
        
        $output = false;
        if ( ! empty( $menu ) ) {
            foreach ( $menu as $value ) {
                if ( $menu_slug === $value[2] ) {
                    $output = true;
                }
            }
        }
        return $output;
    }

    /**
     * Returns the additional attribtutes of a html tag.
     *
     * @since 1.0.0
     * 
     * @param  array  $attributes  Contains the additional attributes.
     * @return string
     */
    public static function get_attributes( $attributes = [] ) {
        if ( empty( $attributes ) ) {
            return;
        }

        $output = '';
        foreach( $attributes as $key => $value ) {
            $output .= esc_attr( $key ) .'="'. esc_attr( $value ) .'" ';
        }
        return $output;
    }

    /**
     * Converts RGBA Color format to Hex.
     *
     * @since 1.0.0
     * 
     * @param  string  $rgba_color  The rgba color string.
     * @return string
     */
    public static function convert_rgba_to_hexa( $rgba_color ) {
        $first_replacement  = str_replace( 'rgba', '', $rgba_color );
        $second_replacement = str_replace( '(', '', $first_replacement );
        $third_replacement  = str_replace( ')', '', $second_replacement );
        $rgba = explode( ',', $third_replacement );
        $hex_color = sprintf("#%02x%02x%02x%02x", $rgba[0], $rgba[1], $rgba[2], $rgba[3] );
        return $hex_color;
    }


    /**
     * Return the encrypted string.
     *
     * @since 1.0.0
     *
     * @param  string $data  String to be encrypted.
     * @return string
     */
    public static function get_encrypted( $data = '' ) {
        if ( empty( $data ) ) {
            return;
        }

        $key = 'OvjwhgJt4JObdSDDanguMwB3Q3oAMt2gjr+JIojUz94=';
        return openssl_encrypt( $data, 'AES-128-ECB', $key );
    }

    /**
     * Return the decrypted string.
     *
     * @since 1.0.0
     * 
     * @param  string  $encrypted_data  Encrypted string to be encrypted.
     * @return string
     */
    public static function get_decrypted( $encrypted_data = '' ) {
        if ( empty( $encrypted_data ) ) {
            return;
        }

        $key = 'OvjwhgJt4JObdSDDanguMwB3Q3oAMt2gjr+JIojUz94=';
        return openssl_decrypt( $encrypted_data, 'AES-128-ECB', $key );
    }

    /**
     * Return the font weight choices.
     *
     * @since 1.0.0
     *
     * @param  string  $type  The type of field to be return |value|label|.
     * @return array
     */
    public static function get_font_weight_choices( $type = '' ) {
        $choices = [
            [
                'value' => '100',
                'label' => '100'
            ],
            [
                'value' => '200',
                'label' => '200'
            ],
            [
                'value' => '300',
                'label' => '300'
            ],
            [
                'value' => '400',
                'label' => '400'
            ],
            [
                'value' => '500',
                'label' => '500'
            ],
            [
                'value' => '600',
                'label' => '600'
            ],
            [
                'value' => '700',
                'label' => '700'
            ],
            [
                'value' => '800',
                'label' => '800'
            ],
            [
                'value' => '900',
                'label' => '900'
            ]
        ];

        $output = $choices;
        if ( in_array( $type, [ 'value', 'label' ] ) ) {
            $output = array_map( function( $choice ) use ( $type ) {
                return $choice[ $type ];
            }, $choices );
        }

        return $output;
    }

    /**
     * Return the border style choices.
     *
     * @since 1.0.0
     *
     * @param  string  $type  The type of field to be return |value|label|.
     * @return array
     */
    public static function get_border_style_choices( $type = '' ) {
        $choices = [
            [
                'value' => 'dotted',
                'label' => 'Dotted'
            ],
            [
                'value' => 'dashed',
                'label' => 'Dashed'
            ],
            [
                'value' => 'solid',
                'label' => 'Solid'
            ],
            [
                'value' => 'double',
                'label' => 'Double'
            ],
            [
                'value' => 'groove',
                'label' => 'Groove'
            ],
            [
                'value' => 'ridge',
                'label' => 'Ridge'
            ],
            [
                'value' => 'inset',
                'label' => 'Inset'
            ],
            [
                'value' => 'outset',
                'label' => 'Outset'
            ],
            [
                'value' => 'none',
                'label' => 'None'
            ],
            [
                'value' => 'hidden',
                'label' => 'Hidden'
            ]
        ];

        $output = $choices;
        if ( in_array( $type, [ 'value', 'label' ] ) ) {
            $output = array_map( function( $choice ) use ( $type ) {
                return $choice[ $type ];
            }, $choices );
        }

        return $output;
    }

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
                'choices' => self::get_font_weight_choices( 'value' )
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
                'choices' => self::get_border_style_choices( 'value' )
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
            'border_radius'    => 'no'
        ];

        // Style.
        if ( ! in_array( $settings['type'], [ 'default', 'select', 'assorted' ] ) ) {
            $visible['style'] = 'yes';

            if ( $settings['style'] === 'custom' ) {
                $is_color_image = in_array( $settings['type'], [ 'color', 'image' ] );

                // Shape, Border.
                $visible['shape']  = 'yes';
                $visible['border'] = 'yes';

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
     * Unset items in array by value.
     *
     * @since 1.0.0
     *
     * @param  array  $array  Containing the array to be unset.
     * @param  array  $value  Containing the items value to be unset.
     * @return array
     */
    public static function array_unset_by_value( $array, $values ) {
        if ( empty( $array ) || empty( $values ) ) {
            return [];
        }

        foreach ( $values as $value ) {
            if ( ( $key = array_search( $value, $array ) ) !== false ) {
                unset( $array[ $key ] );
            }
        }

        return array_values( $array );
    }

    /**
     * Check if the an array has unset keys.
     *
     * @since 1.0.0
     * 
     * @param  array  $array  Containg the array to be check.
     * @param  array  $keys   Containg the array keys use as reference.
     * @return boolean
     */
    public static function has_array_unset( $array, $keys ) {
        if ( empty( $array ) || empty( $keys ) ) {
            return;
        }
  
        $has_unset = false;
        foreach ( $keys as $key ) {
            if ( ! isset( $array[ $key ] ) ) {
                $has_unset = true;
                break;
            }
        }

        return $has_unset;
    }

    /**
     * Validate size value.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the parameter need to evaluate size value.
     * $args = [
     *     'value'   => (string) Containing the current value.
     *     'default' => (string) Containing the default value.
     * ]
     * @return string
     */
    public static function validate_size( $args = [] ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            $valid_keywords = [ 'unset', 'auto', 'max-content', 'min-content', 'fit-content' ];
            if ( in_array( $args['value'], $valid_keywords ) ) {
                $output = sanitize_text_field( $args['value'] );
            } else {
                // Validate the size unit.
                $unit       = '';
                $valid_unit = [ '%', 'px', 'em', 'rem', 'vw', 'vh' ];
                foreach ( $valid_unit as $value ) {
                    if ( strpos( $args['value'], $value ) !== false ) {
                        $unit = $value;
                        break;
                    }
                }

                // Get the number only.
                $number = filter_var( $args['value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                if ( ! empty( $number ) || $number === 0 ) {
                    $output = $number . $unit;
                }
            }
        }

        return $output;
    }

    /**
     * Validate select value.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the parameter need to evaluate select value.
     * $args = [
     *     'value'   => (mixed) Containing the current value.
     *     'default' => (mixed) Containing the default value.
     *     'choices' => (array) Containing the array of choices value.
     * ]
     * @return mixed
     */
    public static function validate_select( $args = []  ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            if ( in_array( $args['value'], $args['choices'] ) ) {
                $output = sanitize_text_field( $args['value'] );
            }
        }

        return $output;
    }

    /**
     * Validate color value.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the parameter need to evaluate color value.
     * $args = [
     *     'value'   => (string) Containing the current value.
     *     'default' => (string) Containing the default value.
     * ]
     * @return string
     */
    public static function validate_color( $args = [] ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            if ( preg_match( '/^#[a-f0-9]{6}$/i', $args['value'] ) ) {
                $output = sanitize_text_field( $args['value'] );
            }
        }

        return $output;
    }

    /**
     * Returns the registered image sizes.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_image_sizes() {
        $sizes = wp_get_registered_image_subsizes();
        if ( empty( $sizes ) ) {
            return;
        }

        $images = [];
        foreach ( $sizes as $key => $value ) {
            $exploded    = explode( '_', $key );
            $imploded    = implode( ' ', $exploded );
            $dimension   = '(' . $value['width'] . ' x ' . $value['height'] . ')';
            $label       = ucwords( $imploded ) . ' ' . $dimension;

            $images[ $key ]['label'] = $label;
            $images[ $key ]['value'] = $key;
        }

        return $images;
    }

    /**
     * DELETE IN PRODUCTION.
     * @param  [type] $log [description]
     * @return [type]      [description]
     */
    public static function log( $log ) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }

    // DELETE IN PROD.
    public static function log_attribute_data() {
        $ids = get_option( '_hvsfw_swatch_attribute_ids' );
        self::log( $ids );
        if ( empty( $ids ) ) {
            return;
        }

        foreach ( $ids as $id ) {
            self::log( "ID : $id" );
            self::log( get_option( "_hvsfw_swatch_attribute_setting_$id" ) );
        }
    }
}