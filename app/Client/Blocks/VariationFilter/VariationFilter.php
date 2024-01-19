<?php
namespace HVSFW\Client\Blocks\VariationFilter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Blocks\VariationFilter\Inc\BlockEvents;

defined( 'ABSPATH' ) || exit;

/**
 * Register Variation Filter Block.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
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

		// Register Block.
		add_action( 'init', [ $this, 'register_block' ] );

		// Register Block Events.
		BlockEvents::get_instance();
    }

	/**
	 * Registers the block using the metadata loaded from the `block.json` file.
 	 * Behind the scenes, it registers also all assets so they can be enqueued
 	 * through the block editor in the corresponding context.

	 * @since 1.0.0
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
	 */
	public function localize_data() {
		wp_localize_script( 'create-block-variation-filter-editor-script', 'hvsfwVfData', [
			'url'   => admin_url( 'admin-ajax.php' ),
			'nonce' => [
				'getProductAttributes' => wp_create_nonce( 'hvsfw_vf_get_product_attributes' )
			]
		]);
	}
}