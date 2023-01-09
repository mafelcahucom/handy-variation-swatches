<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Global Utility.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Utility {

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
     * Returns the base url of client dist folder.
     *
     * @since 1.0.0
     * 
     * @param string  $file  Target filename.
     * @return string
     */
    public static function get_client_asset_src( $file ) {
        return HVSFW_PLUGIN_URL . 'assets/client/dist/' . $file;
    }

    /**
     * Return the product placeholder image source.
     *
     * @since 1.0.0
     * 
     * @param  string  $size  Registered image sizes.
     * @return string
     */
    public static function get_product_thumbnail_placeholer_src( $size = 'full' ) {
        $source = wc_placeholder_img_src( $size );
        if ( empty( $source ) ) {
            $source = self::get_client_asset_src( 'images/thumbnail-placeholder.webp' );
        }

        return $source;
    }

    /**
     * Return the product swatch value from _hvsfw_value post meta by product id.
     *
     * @since 1.0.0
     *
     * @param integer  $product_id  The target product id.
     * 
     * @return array
     */
    public static function get_product_swatch_value( $product_id ) {
        if ( empty( $product_id ) ) {
            return []; 
        }

        $value = get_post_meta( $product_id, '_hvsfw_value' );
        return ( ! empty( $value ) && is_array( $value ) ? $value : [] );
    }

    /**
     * Return the swatch settings from _hvsfw_swatch_attribute_setting 
     * option by attribute id and field name.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attribute_id  The attribute id.
     * @param  string   $field         The field to be return.
     * @return mixed
     */
    public static function get_swatch_settings( $attribute_id, $field = '' ) {
        if ( empty( $attribute_id ) ) {
            return;
        }

        $settings = get_option( "_hvsfw_swatch_attribute_setting_$attribute_id" );
        if ( $field !== '' && ! empty( $settings ) ) {
            return ( isset( $settings[ $field ] ) ? $settings[ $field ] : null );
        }

        return $settings;
    }

    /**
     * Return the tooltip swatch value by term id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     * @return 
     */
    public static function get_swatch_tooltip( $term_id ) {
        $default = [
            'type'    => 'none',
            'content' => ''
        ];

        if ( empty( $term_id ) ) {
            return $default;
        }

        $tooltip = get_term_meta( $term_id, '_hvsfw_tooltip', true );
        return ( ! empty( $tooltip ) && is_array( $tooltip ) ? $tooltip : $default );
    }

    /**
     * Return the color swatch value by term id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     * @return array
     */
    public static function get_swatch_color( $term_id ) {
        $default = [ '#ffffff' ];
        if ( empty( $term_id ) ) {
            return $default;
        }

        $colors = get_term_meta( $term_id, '_hvsfw_value', true );
        return ( ! empty( $colors ) && is_array( $colors ) ? $colors : $default );
    }

    /**
     * Return the image swatch value by term id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     * @return integer
     */
    public static function get_swatch_image( $term_id ) {
        if ( empty( $term_id ) ) {
            return 0;
        }

        $image = get_term_meta( $term_id, '_hvsfw_value', true );
        return ( ! empty( $image ) && ! is_array( $image ) ? $image : 0 );
    }

    /**
     * Return the image swatch size value by term id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     * @return string
     */
    public static function get_swatch_image_size( $term_id ) {
        $default = 'thumbnail';
        if ( empty( $term_id ) ) {
            return $default;
        }

        $size = get_term_meta( $term_id, '_hvsfw_image_size', true );
        return ( ! empty( $size ) ? $size : $default );
    }

    /**
     * Return the swatch image source and details by attachment id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attachment_id  The attachment id.
     * @param  string   $size           The attachment image size.
     * @return array
     */
    public static function get_swatch_image_by_attachment_id( $attachment_id, $size = 'full' ) {
        $image = [
            'src'   => self::get_product_thumbnail_placeholer_src(),
            'alt'   => 'WooCommerce Placeholder',
            'title' => 'WooCommerce Placeholder'
        ];

        if ( empty( $attachment_id ) ) {
            return $image;
        }

        $source = wp_get_attachment_image_src( $attachment_id, $size );
        if ( empty( $source ) ) {
            return $image;
        }

        $alt   = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
        $title = get_the_title( $attachment_id );

        return [
            'src'   => $source[0],
            'alt'   => $alt,
            'title' => $title
        ];
    }

    /**
     * Return the swatch image source and details by term id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $term_id  The target term id.
     * @param  string   $size     The attachment image size.
     * @return array
     */
    public static function get_swatch_image_by_term_id( $term_id, $size = 'full' ) {
        $image = [
            'src'   => self::get_product_thumbnail_placeholer_src(),
            'alt'   => 'WooCommerce Placeholder',
            'title' => 'WooCommerce Placeholder'
        ];

        $attachment_id = get_term_meta( $term_id, '_hvsfw_value', true );
        if ( empty( $attachment_id ) ) {
            return $image;
        }

        return self::get_swatch_image_by_attachment_id( $attachment_id, $size );
    }

    /**
     * Return the linear gradient color or stripe color.
     *
     * @since 1.0.0
     * 
     * @param  array   $colors  Containing the list of colors.
     * @param  string  $angle   The total angle or rotation of the background.
     * @return string
     */
    public static function get_linear_color( $colors, $angle = '-45deg' ) {
        if ( empty( $colors ) || ! is_array( $colors ) ) {
            return '#ffffff';
        }

        $value  = "$angle, ";
        $count  = count( $colors );
        $length = ( 100 / $count );

        foreach ( $colors as $key => $color ) {
            $key   = ( $key + 1 );
            $end   = ( $length * $key );
            $start = ( $end - $length );

            $value .= "$color $start%, $color $end% ";
            $value .= ( $key < $count ? ',' : '' );
        }

        return "repeating-linear-gradient( $value )";
    }

    /**
     * Return the filtered product attributes used in variation.
     *
     * @since 1.0.0
     *
     * @param  object  $product  The product object.
     * @return array
     */
    public static function get_attributes( $product ) {
        if ( empty( $product ) || $product->get_type() !== 'variable' ) {
            return;
        }

        $attributes = array_filter( $product->get_attributes(), function( $attribute ) {
            return ( $attribute->get_visible() && $attribute->get_variation() );
        });

        return $attributes;
    }

    /**
     * Return the attribute type by attribute id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attribute_id  The ID of the attribute.
     * @return string
     */
    public static function get_attribute_type_by_id( $attribute_id ) {
        if ( empty( $attribute_id ) ) {
            return;
        }

        global $wpdb;
        $table  = $wpdb->prefix . 'woocommerce_attribute_taxonomies';
        $result = $wpdb->get_var( $wpdb->prepare(
            "
            SELECT
                attribute_type
            FROM
                $table
            WHERE
                attribute_id = %d
            ",
            $attribute_id
        ));

        return ( $result !== null ? $result : '' );
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

}