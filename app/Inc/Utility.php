<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Global Utility.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Utility {

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
     * Logs data in debug.txt.
     * 
     * @since 1.0.0
     *
     * @param mixed  $log  Contains the data to be log.
     */
    public static function log( $log ) {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }

    /**
     * Returns the base url of client dist folder.
     *
     * @since 1.0.0
     * 
     * @param  string  $file  Contains the target filename.
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
     * @param  string  $size  Contains the registered image sizes.
     * @return string
     */
    public static function get_product_thumbnail_placeholder_src( $size = 'full' ) {
        $source = wc_placeholder_img_src( $size );
        if ( empty( $source ) ) {
            $source = self::get_client_asset_src( 'images/thumbnail-placeholder.webp' );
        }

        return $source;
    }

    /**
     * Return the product swatches from _hvsfw_swatches post meta by product id.
     *
     * @since 1.0.0
     *
     * @param integer  $product_id  Contains the target product id.
     * @return array
     */
    public static function get_product_swatches( $product_id ) {
        if ( empty( $product_id ) ) {
            return []; 
        }

        $value = get_post_meta( $product_id, '_hvsfw_swatches', true );
        return ( ! empty( $value ) && is_array( $value ) ? $value : [] );
    }

    /**
     * Return the swatch settings from _hvsfw_swatch_attribute_setting 
     * option by attribute id and field name.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attribute_id  Contains the attribute id.
     * @param  string   $field         Contains the field to be return.
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
     * @param  integer  $term_id  Contains the target term id.
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
     * @param  integer  $term_id  Contains the target term id.
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
     * @param  integer  $term_id  Contains the target term id.
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
     * @param  integer  $term_id  Contains the target term id.
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
     * @param  integer  $attachment_id  Contains the attachment id.
     * @param  string   $size           Contains the attachment image size.
     * @return array
     */
    public static function get_swatch_image_by_attachment_id( $attachment_id, $size = 'full' ) {
        $image = [
            'src'   => self::get_product_thumbnail_placeholder_src(),
            'alt'   => __( 'WooCommerce Placeholder', HVSFW_PLUGIN_DOMAIN ),
            'title' => __( 'WooCommerce Placeholder', HVSFW_PLUGIN_DOMAIN )
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
     * @param  integer  $term_id  Contains the target term id.
     * @param  string   $size     Contains the attachment image size.
     * @return array
     */
    public static function get_swatch_image_by_term_id( $term_id, $size = 'full' ) {
        $image = [
            'src'   => self::get_product_thumbnail_placeholder_src(),
            'alt'   => __( 'WooCommerce Placeholder', HVSFW_PLUGIN_DOMAIN ),
            'title' => __( 'WooCommerce Placeholder', HVSFW_PLUGIN_DOMAIN )
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
     * @param  array   $colors  Contains the the list of colors.
     * @param  string  $angle   Contains the total angle or rotation of the background.
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
     * @param  object  $product  Contains the product object.
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
     * Return the product attribute type by attribute id.
     *
     * @since 1.0.0
     * 
     * @param  integer  $attribute_id  Contains the ID of the attribute.
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
	 * Return the registered attributes in wp_woocommerce_attribute_taxonomies.
	 *
	 * @since 1.0.0
	 * 
	 * @return array
	 */
	public static function get_available_attributes() {
		global $wpdb;
		$table  	= $wpdb->prefix . 'woocommerce_attribute_taxonomies';
		$attributes = $wpdb->get_results( "SELECT * FROM $table", 'ARRAY_A' );

		if ( count( $attributes ) > 0 ) {
			foreach ( $attributes as $key => $attribute ) {
				$taxonomy_name				 = 'pa_' . $attribute['attribute_name'];
				$attributes[ $key ]['terms'] = get_terms( $taxonomy_name, [
					'hide_empty' => 1
				]);

				if ( count( $attributes[ $key ]['terms'] ) > 0 ) {
					foreach ( $attributes[ $key ]['terms'] as $sub_key => $term ) {
						$meta_data = null;
						if ( $attribute['attribute_type'] === 'color' ) {
							$meta_data = self::get_swatch_color( $term->term_id );
						}

						if ( $attribute['attribute_type'] === 'image' ) {
							$image_id 	= self::get_swatch_image( $term->term_id );
							$image_size = self::get_swatch_image_size( $term->term_id );
							$meta_data 	= self::get_swatch_image_by_attachment_id( $image_id, $image_size );
						}
						
						$attributes[ $key ]['terms'][ $sub_key ]->meta = $meta_data;
					}
				}
			}

			$attributes = array_filter( $attributes, function( $attribute ) {
				return ! empty( $attribute['terms'] );
			});
		}
		
		return ( $attributes !== null ? $attributes : [] );
	}

	/**
	 * Return a certain attribute by attribute name from get_available_attributes().
	 * 
	 * @since 1.0.0
	 *
	 * @param  string  $attribute_name  Contains the name of target attribute.
	 * @return array
	 */
	public static function get_attribute( $attribute_name ) {
		$attribute = [];
		if ( empty( $attribute_name ) ) {
			return $attribute;
		}

		$attributes = self::get_available_attributes();
		if ( ! empty( $attributes ) ) {
			$attribute = array_values( array_filter( $attributes, function( $attribute ) use ( $attribute_name ) {
				return $attribute['attribute_name'] === $attribute_name;
			}));
		}

		return ( ! empty( $attribute ) ? $attribute[0] : [] );
	}

    /**
     * Return a converted slug string.
     *
     * @since 1.0.0
     * 
     * @param  string  $string  Contains the string to be converted to slug.
     * @return string
     */
    public static function get_converted_slug( $string ) {
        if ( empty( $string ) ) {
            return;
        }

        return strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $string ) ) );
    }

    /**
     * Check if the an array has unset keys.
     *
     * @since 1.0.0
     * 
     * @param  array  $array  Contains the array to be check.
     * @param  array  $keys   Contains the array keys use as reference.
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
}