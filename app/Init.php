<?php
namespace HVSFW;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Admin;
use HVSFW\Client\Client;

defined( 'ABSPATH' ) || exit;

/**
 * Initialize.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Init {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        
        /**
         * Instantiate Admin.
         */
        if ( is_admin() ) {
            Admin::get_instance();
        } 

        /**
         * Instantiate Client.
         */
        Client::get_instance();
    }
}