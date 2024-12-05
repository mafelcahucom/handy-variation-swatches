<?php
/**
 * App > Client > Widgets > Variation Filter > Inc > Local Helper.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Widgets\VariationFilter\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;

defined( 'ABSPATH' ) || exit;

/**
 * The `LocalHelper` class contains the localized
 * helper methods solely for variation filter.
 *
 * @since 1.0.0
 */
final class LocalHelper {

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
     * Return field's schema.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_fields_schema() {
        return array(
            'general' => array(
                'show_count'   => array(
                    'type'    => 'select',
                    'default' => 'yes',
                    'choices' => array( 'yes', 'no' ),
                ),
                'display_type' => array(
                    'type'    => 'select',
                    'default' => 'swatch',
                    'choices' => array( 'swatch', 'select', 'list' ),
                ),
                'query_type'   => array(
                    'type'    => 'select',
                    'default' => 'or',
                    'choices' => array( 'or', 'and' ),
                ),
            ),
            'title' => array(
                'text'          => array(
                    'type'    => 'text',
                    'default' => 'Filter by',
                    'empty'   => true,
                ),
                'font_size'     => array(
                    'type'    => 'size',
                    'default' => '22px',
                ),
                'font_weight'   => array(
                    'type'    => 'select',
                    'default' => '500',
                    'choices' => self::get_font_weights(),
                ),
                'line_height'   => array(
                    'type'    => 'size',
                    'default' => '26px',
                ),
                'margin_bottom' => array(
                    'type'    => 'size',
                    'default' => '20px',
                ),
                'color'         => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
            ),
            'list' => array(
                'font_size'     => array(
                    'type'    => 'size',
                    'default' => '16px',
                ),
                'font_weight'   => array(
                    'type'    => 'select',
                    'default' => '400',
                    'choices' => self::get_font_weights(),
                ),
                'line_height'   => array(
                    'type'    => 'size',
                    'default' => '20px',
                ),
                'margin_bottom' => array(
                    'type'    => 'size',
                    'default' => '5px',
                ),
                'color'         => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'color_active'  => array(
                    'type'    => 'color',
                    'default' => '#0071F2',
                ),
            ),
            'select' => array(
                'width'            => array(
                    'type'    => 'size',
                    'default' => '100%',
                ),
                'height'           => array(
                    'type'    => 'size',
                    'default' => '30px',
                ),
                'font_size'        => array(
                    'type'    => 'size',
                    'default' => '14px',
                ),
                'font_weight'      => array(
                    'type'    => 'select',
                    'default' => '400',
                    'choices' => self::get_font_weights(),
                ),
                'padding_top'      => array(
                    'type'    => 'size',
                    'default' => '0px',
                ),
                'padding_right'    => array(
                    'type'    => 'size',
                    'default' => '24px',
                ),
                'padding_bottom'   => array(
                    'type'    => 'size',
                    'default' => '0px',
                ),
                'padding_left'     => array(
                    'type'    => 'size',
                    'default' => '8px',
                ),
                'color'            => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'background_color' => array(
                    'type'    => 'color',
                    'default' => '#ffffff',
                ),
                'border_width'     => array(
                    'type'    => 'size',
                    'default' => '1px',
                ),
                'border_style'     => array(
                    'type'    => 'select',
                    'default' => 'solid',
                    'choices' => self::get_border_styles(),
                ),
                'border_color'     => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
            ),
            'button' => array(
                'shape'                   => array(
                    'type'    => 'select',
                    'default' => 'square',
                    'choices' => array( 'square', 'circle', 'custom' ),
                ),
                'width'                   => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'height'                  => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'font_size'               => array(
                    'type'    => 'size',
                    'default' => '14px',
                ),
                'font_weight'             => array(
                    'type'    => 'select',
                    'default' => '400',
                    'choices' => self::get_font_weights(),
                ),
                'padding_top'             => array(
                    'type'    => 'size',
                    'default' => '5px',
                ),
                'padding_right'             => array(
                    'type'    => 'size',
                    'default' => '5px',
                ),
                'padding_bottom'           => array(
                    'type'    => 'size',
                    'default' => '5px',
                ),
                'padding_left'          => array(
                    'type'    => 'size',
                    'default' => '5px',
                ),
                'text_color'              => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'text_color_active'       => array(
                    'type'    => 'color',
                    'default' => '#0071F2',
                ),
                'background_color'        => array(
                    'type'    => 'color',
                    'default' => '#ffffff',
                ),
                'background_color_active' => array(
                    'type'    => 'color',
                    'default' => '#ffffff',
                ),
                'border_width'            => array(
                    'type'    => 'size',
                    'default' => '1px',
                ),
                'border_style'            => array(
                    'type'    => 'select',
                    'default' => 'solid',
                    'choices' => self::get_border_styles(),
                ),
                'border_color'            => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'border_color_active'     => array(
                    'type'    => 'color',
                    'default' => '#0071F2',
                ),
                'border_radius'           => array(
                    'type'    => 'size',
                    'default' => '0px',
                ),
                'gap'                     => array(
                    'type'    => 'size',
                    'default' => '10px',
                ),
            ),
            'color' => array(
                'shape'               => array(
                    'type'    => 'select',
                    'default' => 'square',
                    'choices' => array( 'square', 'circle', 'custom' ),
                ),
                'size'                => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'width'               => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'height'              => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'border_width'        => array(
                    'type'    => 'size',
                    'default' => '1px',
                ),
                'border_style'        => array(
                    'type'    => 'select',
                    'default' => 'solid',
                    'choices' => self::get_border_styles(),
                ),
                'border_color'        => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'border_color_active' => array(
                    'type'    => 'color',
                    'default' => '#0071F2',
                ),
                'border_radius'       => array(
                    'type'    => 'size',
                    'default' => '0px',
                ),
                'gap'                 => array(
                    'type'    => 'size',
                    'default' => '10px',
                ),
            ),
            'image' => array(
                'shape'               => array(
                    'type'    => 'select',
                    'default' => 'square',
                    'choices' => array( 'square', 'circle', 'custom' ),
                ),
                'size'                => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'width'               => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'height'              => array(
                    'type'    => 'size',
                    'default' => '40px',
                ),
                'border_width'        => array(
                    'type'    => 'size',
                    'default' => '1px',
                ),
                'border_style'        => array(
                    'type'    => 'select',
                    'default' => 'solid',
                    'choices' => self::get_border_styles(),
                ),
                'border_color'        => array(
                    'type'    => 'color',
                    'default' => '#000000',
                ),
                'border_color_active' => array(
                    'type'    => 'color',
                    'default' => '#0071F2',
                ),
                'border_radius'       => array(
                    'type'    => 'size',
                    'default' => '0px',
                ),
                'gap'                 => array(
                    'type'    => 'size',
                    'default' => '10px',
                ),
            ),
        );
    }

    /**
     * Return the font weight list.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_font_weights() {
        return array(
            '100',
            '200',
            '300',
            '400',
            '500',
            '600',
            '700',
            '800',
            '900',
        );
    }

    /**
     * Return the border style list.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_border_styles() {
        return array(
            'dotted',
            'dashed',
            'solid',
            'double',
            'groove',
            'ridge',
            'inset',
            'outset',
            'none',
            'hidden',
        );
    }

    /**
     * Return the final display type based on block display_type and
	 * product attribute_type.
     *
     * @since 1.0.0
     *
     * @param  array $instance Contains the widget instance.
     * @return string
     */
    public static function get_display_type( $instance ) {
        if ( empty( $instance ) ) {
            return '';
        }

        if ( ! isset( $instance['general']['attribute'] ) || empty( $instance['general']['attribute'] ) ) {
            return '';
        }

        $attribute = Utility::get_attribute( $instance['general']['attribute'] );
        if ( empty( $attribute ) ) {
            return '';
        }

        if ( ! isset( $instance['general']['display_type'] ) || empty( $instance['general']['display_type'] ) ) {
            return '';
        }

        $display_type = $instance['general']['display_type'];
        if ( $display_type !== 'swatch' ) {
            return $display_type;
        }

        if ( in_array( $attribute['attribute_type'], array( 'button', 'color', 'image' ), true ) ) {
            return $attribute['attribute_type'];
        }

        return 'select';
    }

    /**
     * Return the general setting show count in boolean format.
     *
     * @since 1.0.0
     *
     * @param  array $instance Contains the widget instance.
     * @return boolean
     */
    public static function get_show_count( $instance ) {
        if ( empty( $instance ) ) {
            return true;
        }

        if ( ! isset( $instance['general']['show_count'] ) || empty( $instance['general']['show_count'] ) ) {
            return true;
        }

        return ( $instance['general']['show_count'] === 'yes' ? true : false );
    }

    /**
     * Return the general setting query_type.
     *
     * @since 1.0.0
     *
     * @param  array $instance Contains the widget instance.
     * @return string
     */
    public static function get_query_type( $instance ) {
        if ( empty( $instance ) ) {
            return 'or';
        }

        if ( ! isset( $instance['general']['query_type'] ) || empty( $instance['general']['query_type'] ) ) {
            return 'or';
        }

        return $instance['general']['query_type'];
    }

    /**
     * Retunr the list of available product attribute choices.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_attribute_choices() {
        return wp_list_pluck( Utility::get_available_attributes(), 'attribute_name' );
    }

    /**
     * Returns the base url of variation filter dist folder.
     *
     * @since 1.0.0
     *
     * @param  string $file Contains the target filename.
     * @return string
     */
    public static function get_asset_src( $file ) {
        return HVSFW_PLUGIN_URL . 'app/Client/Widgets/VariationFilter/assets/dist/' . $file;
    }
}
