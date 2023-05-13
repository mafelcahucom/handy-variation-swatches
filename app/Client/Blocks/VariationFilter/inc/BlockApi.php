<?php
namespace HVSFW\Client\Blocks\VariationFilter\Inc;

use HVSFW\Client\Blocks\Blocks;
use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Security;
use HVSFW\Client\Blocks\VariationFilter\Inc\BlockHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Block API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class BlockApi {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Inherit Security.
     */
    use Security;

    /**
     * Register all ajax action classes.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        add_action( 'wp_ajax_hbvf_get_product_attributes', [ $this, 'get_product_attributes' ] );
    }

    /**
     * Return the available product attributes.
     * 
     * @since 1.0.0
     *
     * @return json
     */
    public function get_product_attributes() {
        if ( ! self::is_security_passed( $_POST ) ) {
			wp_send_json_error([
				'error' => 'SECURITY_ERROR'
			]);
		}

        wp_send_json_success([
            'response'   => 'SUCCESS',
            'attributes' => BlockHelper::get_attributes()
        ]);
    }
}