<?php
/**
 * App > Client > Actions.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Actions` class contains all the action hooks that
 * will be loaded in the client side or front-end.
 *
 * @since 1.0.0
 */
final class Actions {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

	/**
     * Execute Actions.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Perform variation filter.
         */
        add_action( 'woocommerce_product_query', array( $this, 'variation_filter_product_query' ) );
    }

    /**
     * Perform the variation filter or modify the woocommerce main product query.
     *
     * @since 1.0.0
     *
     * @param  object $query Contains the current query parameters of woocommerce_product_query.
     * @return void
     */
    public function variation_filter_product_query( $query ) {
        if ( ! empty( $_GET ) ) {
            $filters = array();
            foreach ( $_GET as $key => $value ) {
                if ( strpos( $key, 'filter_attr' ) !== false ) {
                    $name = str_replace( 'filter_attr_', '', $key );
                    if ( ! empty( $name ) && $value !== '' ) {
                        $taxonomy   = 'pa_' . $name;
                        $terms      = explode( ',', $value );
                        $operator   = 'IN';
                        $query_type = 'query_type_attr_' . $name;
                        if ( isset( $_GET[ $query_type ] ) ) {
                            if ( in_array( $_GET[ $query_type ], array( 'and', 'or' ), true ) ) {
                                $operator = ( $_GET[ $query_type ] === 'or' ? 'IN' : 'AND' );
                            }
                        }

                        array_push( $filters, array(
                            'field'    => 'slug',
                            'taxonomy' => $taxonomy,
                            'terms'    => $terms,
                            'operator' => $operator,
                        ));
                    }
                }
            }

            if ( ! empty( $filters ) ) {
                $query->set( 'tax_query', array(
                    array(
                        'relation' => 'AND',
                        $filters,
                    ),
                ));
            }
        }
    }
}
