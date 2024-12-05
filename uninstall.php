<?php
/**
 * Uninstall.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

/**
 * Delete all the data in database associated with variation swatches.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hvsfw_uninstall' ) ) {

    function hvsfw_uninstall() {
        global $wpdb;

        /**
         * Delete option _hvsfw_main_settings.
         *
         * @since 1.0.0
         */
        delete_option( '_hvsfw_main_settings' );

        /**
         * Delete option _hvsfw_plugin_version.
         *
         * @since 1.0.0
         */
        delete_option( '_hvsfw_plugin_version' );

        /**
         * Deleting option _hvsfw_swatch_attribute_setting_.
         *
         * @since 1.0.0
         */
        $option_table = $wpdb->prefix . 'options';
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.SlowDBQuery.slow_db_query_meta_key, WordPress.DB.PreparedSQLPlaceholders.LikeWildcardsInQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
        $wpdb->query( $wpdb->prepare( "DELETE FROM $option_table WHERE option_name LIKE '%_hvsfw_swatch_attribute_setting_%'" ) );

        /**
         * Deleting post meta _hvsfw_swatches.
         *
         * @since 1.0.0
         */
        $post_meta_table = $wpdb->prefix . 'postmeta';
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        $wpdb->delete( $post_meta_table, array( 'meta_key' => '_hvsfw_swatches' ) );

        /**
         * Deleting term meta _hvsfw_value, _hvsfw_tooltip, _hvsfw_colors,
         * _hvsfw_image, _hvsfw_image_size.
         *
         * @since 1.0.0
         */
        $term_meta_table = $wpdb->prefix . 'termmeta';
        // phpcs:disable WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching, WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        $wpdb->delete( $term_meta_table, array( 'meta_key' => '_hvsfw_value' ) );
        $wpdb->delete( $term_meta_table, array( 'meta_key' => '_hvsfw_tooltip' ) );
        $wpdb->delete( $term_meta_table, array( 'meta_key' => '_hvsfw_colors' ) );
        $wpdb->delete( $term_meta_table, array( 'meta_key' => '_hvsfw_image' ) );
        $wpdb->delete( $term_meta_table, array( 'meta_key' => '_hvsfw_image_size' ) );
        // phpcs:enable
    }

    hvsfw_uninstall();
}
