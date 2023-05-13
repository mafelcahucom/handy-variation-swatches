<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Filters.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Filters {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the settings.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $settings;

	/**
     * Execute Filters.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Set the value of settings property.
        $this->settings = get_option( '_hvsfw_main_settings' );

        // Deffer main javascript.
        if ( $this->settings['ad_opt_enable_defer'] ) {
            add_filter( 'script_loader_tag', [ $this, 'deffer_main_js' ], 10, 2 );
        }
    }

    /**
     * Deffer the main javascript in front-end.
     *
     * @since 1.0.0
     * 
     * @param  string $tag    The <script> tag for the enqueued script.
     * @param  string $handle The script's registered handle.
     * @return array
     */
    public function deffer_main_js( $tag, $handle ) {
        if ( $handle === 'hvsfw-client-js' ) {
            return str_replace( ' src', ' defer="defer" src', $tag );
        }

        return $tag;
    }
}