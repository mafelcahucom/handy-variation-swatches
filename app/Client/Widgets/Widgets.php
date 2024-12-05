<?php
/**
 * App > Client > Widgets > Widgets.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Widgets;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Widgets\VariationFilter\VariationFilter;

defined( 'ABSPATH' ) || exit;

/**
 * The `Widgets` class contains the all related widgets
 * for variation swatches.
 *
 * @since 1.0.0
 */
final class Widgets {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

	/**
     * Load Available Widgets.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Set main settings.
         */
        $settings = get_option( '_hvsfw_main_settings' );

        /**
         * Load Variation Filter Widget.
         */
        if ( $settings['gn_vf_enable_widget'] == true ) {
            VariationFilter::get_instance();
        }
    }
}
