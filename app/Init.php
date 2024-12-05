<?php
/**
 * App > Init.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Admin;
use HVSFW\Client\Client;

defined( 'ABSPATH' ) || exit;

/**
 * The `Init` class will register or instantiate all available
 * services or classes of the plugin.
 *
 * @since 1.0.0
 */
final class Init {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
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
         *
         * @since 1.0.0
         */
        if ( is_admin() ) {
            Admin::get_instance();
        }

        /**
         * Instantiate Client.
         *
         * @since 1.0.0
         */
        Client::get_instance();
    }
}
