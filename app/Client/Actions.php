<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Actions.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Actions {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Execute Actions.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Perform variation filter.
        add_action( 'woocommerce_product_query', [ $this, 'variation_filter_product_query' ] );
    }

    /**
     * Perform the variation filter or modify the woocommerce main product query.
     * 
     * @since 1.0.0
     *
     * @param object  $query  The current query parameters of woocommerce_product_query.
     */
    public function variation_filter_product_query( $query ) {
        if ( ! empty( $_GET ) ) {
            $filters = [];
            foreach ( $_GET as $key => $value ) {
                if ( strpos( $key, 'filter_attr' ) !== false ) {
                    $name = str_replace( 'filter_attr_', '', $key );
                    if ( ! empty( $name ) && $value !== '' ) {
                        $taxonomy   = 'pa_'. $name;
                        $terms      = explode( ',', $value );
                        $operator   = 'IN';
                        $query_type = 'query_type_attr_'. $name;
                        if ( isset( $_GET[ $query_type ] ) ) {
                            if ( in_array( $_GET[ $query_type ], [ 'and', 'or' ] ) ) {
                                $operator = ( $_GET[ $query_type ] === 'or' ? 'IN' : 'AND' );
                            }
                        }

                        array_push( $filters, [
                            'field'    => 'slug',
                            'taxonomy' => $taxonomy,
                            'terms'    => $terms,
                            'operator' => $operator
                        ]);
                    }
                }
            }

            if ( ! empty( $filters ) ) {
                $query->set( 'tax_query', [
                    [
                        'relation' => 'AND',
                        $filters
                    ]
                ]);
            }
        }
    }
}