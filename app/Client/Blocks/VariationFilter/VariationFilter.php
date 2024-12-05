<?php
/**
 * App > Client > Blocks > Variation Filter > Variation Filter.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Blocks\VariationFilter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Blocks\VariationFilter\Inc\BlockEvents;

defined( 'ABSPATH' ) || exit;

/**
 * The `VariationFilter` class contains the main variation
 * filter class.
 *
 * @since 1.0.0
 */
final class VariationFilter {

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
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		/**
		 * Register block.
		 */
		add_action( 'init', array( $this, 'register_block' ) );

		/**
		 * Register block events.
		 */
		BlockEvents::get_instance();
    }

	/**
	 * Registers the block using the metadata loaded from the `block.json` file.
 	 * Behind the scenes, it registers also all assets so they can be enqueued
 	 * through the block editor in the corresponding context.

	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_block() {
		if ( function_exists( 'register_block_type' ) ) {
			register_block_type( __DIR__ . '/build' );

			// Localize script data.
			$this->localize_data();
		}
	}

	/**
	 * Localize data in the editor.js.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function localize_data() {
		wp_localize_script( 'create-block-variation-filter-editor-script', 'hvsfwVfData', array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => array(
				'getProductAttributes' => wp_create_nonce( 'hvsfw_vf_get_product_attributes' ),
			),
		));
	}
}
