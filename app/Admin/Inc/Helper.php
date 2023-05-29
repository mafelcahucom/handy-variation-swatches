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
}