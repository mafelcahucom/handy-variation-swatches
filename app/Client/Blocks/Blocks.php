<?php
namespace HVSFW\Client\Blocks;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Blocks\VariationFilter\VariationFilter;

defined( 'ABSPATH' ) || exit;

/**
 * Blocks.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Blocks {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Load Available Blocks.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Load Variation Filter Block.
         */
        VariationFilter::get_instance();
    }
}