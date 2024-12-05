<?php
/**
 * App > Client > Blocks > Blocks.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Blocks;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Blocks\VariationFilter\VariationFilter;

defined( 'ABSPATH' ) || exit;

/**
 * The `Blocks` class contains the all related blocks
 * for variation swatches.
 *
 * @since 1.0.0
 */
final class Blocks {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

	/**
     * Load Available Blocks.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Set main settings.
         */
        $settings = get_option( '_hvsfw_main_settings' );

        /**
         * Load Variation Filter Block.
         */
        if ( $settings['gn_vf_enable_block'] == true ) {
            VariationFilter::get_instance();
        }
    }
}
