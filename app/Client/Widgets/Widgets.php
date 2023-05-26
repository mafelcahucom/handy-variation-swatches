<?php
namespace HVSFW\Client\Widgets;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Widgets\VariationFilter\VariationFilter;

defined( 'ABSPATH' ) || exit;

/**
 * Widgets.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Widgets {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Load Available Widgets.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Load Variation Filter Widget.
         */
        VariationFilter::get_instance();
    }
}