<?php
namespace HVSFW\Client\Blocks\VariationFilter\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;

defined( 'ABSPATH' ) || exit;

/**
 * Block Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class BlockHelper {

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
	 * Return the registered attributes in wp_woocommerce_attribute_taxonomies.
	 *
	 * @since 1.0.0
	 * 
	 * @return array
	 */
	public static function get_attributes() {
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
							$meta_data = Utility::get_swatch_color( $term->term_id );
						}

						if ( $attribute['attribute_type'] === 'image' ) {
							$image_id 	= Utility::get_swatch_image( $term->term_id );
							$image_size = Utility::get_swatch_image_size( $term->term_id );
							$meta_data 	= Utility::get_swatch_image_by_attachment_id( $image_id, $image_size );
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
	 * Return a certain attribute by attribute name.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $attribute_name The name of target attribute.
	 * @return array
	 */
	public static function get_attribute( $attribute_name ) {
		$attribute = [];
		if ( empty( $attribute_name ) ) {
			return $attribute;
		}

		$attributes = self::get_attributes();
		if ( ! empty( $attributes ) ) {
			$attribute = array_values( array_filter( $attributes, function( $attribute ) use ( $attribute_name ) {
				return $attribute['attribute_name'] === $attribute_name;
			}));
		}

		return ( ! empty( $attribute ) ? $attribute[0] : [] );
	}

	/**
     * Return the minified version of internal css.
     *
     * @since 1.0.0
     * 
     * @param  string  $css  The internal css to be minify.
     * @return string
     */
	public static function css( $css ) {
        $css = preg_replace( '/\s+/', ' ', $css );
        $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
        $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        return trim( $css );
    }

	/**
	 * DELETE THIS IN PRODUCTION.
	 *
	 * @param [type] $log
	 * @return void
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