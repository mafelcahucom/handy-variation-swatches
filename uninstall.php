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
         * Delete option _hivfw_main_settings.
         *
         * @since 1.0.0
         */
        delete_option( '_hvsfw_main_settings' );

        /**
         * Delete option _hivfw_plugin_version.
         *
         * @since 1.0.0
         */
        delete_option( '_hvsfw_plugin_version' );
    }
    hvsfw_uninstall();
}