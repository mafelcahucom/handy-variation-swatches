<?php
/**
 * App > Admin > Inc > Helper.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * The `Helper` class contains all the helper methods
 * solely for admin side or back-end.
 *
 * @since 1.0.0
 */
final class Helper {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
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
     * @return boolean
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
     * Return the base url of admin public asset folder.
     *
     * @since 1.0.0
     *
     * @param  string $file_path Contains the relative path with filename.
     * @return string
     */
    public static function get_public_src( $file_path = '' ) {
        return HVSFW_PLUGIN_URL . 'public/admin/' . $file_path;
    }

    /**
     * Return the base url of admin resources asset folder.
     *
     * @since 1.0.0
     *
     * @param  string $file_path Contains the relative path with filename.
     * @return string
     */
    public static function get_resource_src( $file_path = '' ) {
        return HVSFW_PLUGIN_URL . 'resources/admin/' . $file_path;
    }

    /**
     * Render admin view.
     *
     * @since 1.0.0
     *
     * @param  string $filename Contains the target filename.
     * @param  array  $args     Contains the additional arguments.
     * @return string
     */
    public static function render_view( $filename, $args = array() ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed
        $file = HVSFW_PLUGIN_PATH . 'app/Views/admin/' . $filename . '.php';
        if ( ! file_exists( $file ) ) {
            return;
        }

        ob_start();
        require $file;
        return ob_get_clean();
    }

    /**
     * Return the svg icon.
     *
     * @since 1.0.0
     *
     * @param  string $type      Contains the type of icon.
     * @param  string $classname Contains the additional classname.
     * @return string
     */
    public static function get_icon( $type, $classname = '' ) {
        return Icon::get( $type, $classname );
    }

    /**
     * Checks if the current page is the right parent menu.
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public static function is_correct_menu() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'handy-tools' );
    }

    /**
     * Checks if the current page is the right submenu.
     *
     * @since 1.0.0
     *
     * @return boolean
     */
    public static function is_correct_submenu() {
        return ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'hvsfw' );
    }

    /**
     * Checks if a certain admin menu is already exists. Note only call this
     * method inside "admin_menu" action.
     *
     * @since 1.0.0
     *
     * @param  string $menu_slug Contains the slug of the menu.
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
     * Return the formatted attributes.
     *
     * @since 1.0.0
     *
     * @param  array $attrs Contains the attributes to be formated.
     * @return string
     */
    public static function get_attributes( $attrs = array() ) {
        $attribute = '';
        if ( ! empty( $attrs ) ) {
            foreach ( $attrs as $key => $value ) {
                $attribute .= sprintf(
                    ' %s="%s"',
                    esc_attr( $key ),
                    esc_attr( $value )
                );
            }
        }

        return $attribute;
    }

    /**
     * Converts RGBA Color format to Hex.
     *
     * @since 1.0.0
     *
     * @param  string $rgba_color Contains the rgba color string.
     * @return string
     */
    public static function convert_rgba_to_hexa( $rgba_color ) {
        $first_replacement  = str_replace( 'rgba', '', $rgba_color );
        $second_replacement = str_replace( '(', '', $first_replacement );
        $third_replacement  = str_replace( ')', '', $second_replacement );
        $rgba               = explode( ',', $third_replacement );
        $hex_color          = sprintf( '#%02x%02x%02x%02x', $rgba[0], $rgba[1], $rgba[2], $rgba[3] );

        return $hex_color;
    }

    /**
     * Return the encrypted string.
     *
     * @since 1.0.0
     *
     * @param  string $data Contains the string to be encrypted.
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
     * @param  string $encrypted_data Contains the encrypted string to be encrypted.
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
     * @param  string $type Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_font_weight_choices( $type = '' ) {
        $choices = array(
            array(
                'value' => '100',
                'label' => '100',
            ),
            array(
                'value' => '200',
                'label' => '200',
            ),
            array(
                'value' => '300',
                'label' => '300',
            ),
            array(
                'value' => '400',
                'label' => '400',
            ),
            array(
                'value' => '500',
                'label' => '500',
            ),
            array(
                'value' => '600',
                'label' => '600',
            ),
            array(
                'value' => '700',
                'label' => '700',
            ),
            array(
                'value' => '800',
                'label' => '800',
            ),
            array(
                'value' => '900',
                'label' => '900',
            ),
        );

        $output = $choices;
        if ( in_array( $type, array( 'value', 'label' ), true ) ) {
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
     * @param  string $type Contains the type of field to be return |value|label|.
     * @return array
     */
    public static function get_border_style_choices( $type = '' ) {
        $choices = array(
            array(
                'value' => 'dotted',
                'label' => __( 'Dotted', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'dashed',
                'label' => __( 'Dashed', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'solid',
                'label' => __( 'Solid', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'double',
                'label' => __( 'Double', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'groove',
                'label' => __( 'Groove', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'ridge',
                'label' => __( 'Ridge', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'inset',
                'label' => __( 'Inset', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'outset',
                'label' => __( 'Outset', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'none',
                'label' => __( 'None', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'hidden',
                'label' => __( 'Hidden', 'handy-variation-swatches' ),
            ),
        );

        $output = $choices;
        if ( in_array( $type, array( 'value', 'label' ), true ) ) {
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
     * @param  array $data   Contains the array to be unset.
     * @param  array $values Contains the items value to be unset.
     * @return array
     */
    public static function array_unset_by_value( $data, $values ) {
        if ( empty( $data ) || empty( $values ) ) {
            return array();
        }

        foreach ( $values as $value ) {
            // phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.Found, Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure, WordPress.PHP.StrictInArray.MissingTrueStrict
            if ( ( $key = array_search( $value, $data ) ) !== false ) {
                unset( $data[ $key ] );
            }
        }

        return array_values( $data );
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

        $images = array();
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
