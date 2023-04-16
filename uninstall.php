<?php
/**
 * Uninstall.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */

/**
 * Delete all the options and post meta used by itemized product variation.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hvsfw_uninstall' ) ) {
    function hvsfw_uninstall() {
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
        $attribute_ids = get_option( '_hvsfw_swatch_attribute_ids' );
        if ( ! empty( $attribute_ids ) ) {
            foreach ( $attribute_ids as $attribute_id ) {
                delete_option( "_hvsfw_swatch_attribute_setting_$attribute_id" );
            }
        }

        /**
         * Deleting option _hvsfw_swatch_attribute_ids.
         *
         * @since 1.0.0
         */
        delete_option( '_hvsfw_swatch_attribute_ids' );


        /**
         * ############
         * MAKE A QUERY WHERE TO DELETE ALL TERM META BY KEYWORD.
         * ############
         */
    }
    hvsfw_uninstall();
}