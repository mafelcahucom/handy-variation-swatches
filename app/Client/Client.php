<?php
/**
 * App > Client > Client.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Instantiator;
use HVSFW\Inc\Plugins;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Filters;
use HVSFW\Client\Actions;
use HVSFW\Client\Style;
use HVSFW\Client\Swatch;
use HVSFW\Client\Widgets\Widgets;
use HVSFW\Client\Blocks\Blocks;

defined( 'ABSPATH' ) || exit;

/**
 * The `Client` class contains all the services and
 * settings that needs to be loaded in the client
 * side or front-end.
 *
 * @since 1.0.0
 */
final class Client {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Inherit Instantiator.
     *
     * @since 1.0.0
     */
    use Instantiator;

    /**
     * Holds the settings.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $settings;

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        if ( Helper::plugin_has_error() ) {
            return;
        }

        $this->settings = get_option( '_hvsfw_main_settings' );
        if ( $this->settings['gn_enable'] == false ) {
            return;
        }

        if ( ! is_admin() ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        }

        /**
         * Instantiate or load services.
         */
        self::instantiate(array(
            Filters::class,
            Actions::class,
            Style::class,
            Swatch::class,
            Widgets::class,
            Blocks::class,
        ));
    }

    /**
     * Register defined scripts asset.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_scripts() {
        $asset                 = include HVSFW_PLUGIN_PATH . 'public/client/scripts/hvsfw-client.asset.php';
        $asset['src']          = Helper::get_public_src( 'scripts/hvsfw-client.js' );
        $asset['dependencies'] = array( 'jquery' );
        if ( $this->settings['gn_sp_enable'] == true ) {
            array_push( $asset['dependencies'], 'wc-add-to-cart-variation' );
        }

        wp_register_script( 'hvsfw-client', $asset['src'], $asset['dependencies'], $asset['version'], true );
        wp_enqueue_script( 'hvsfw-client' );

        wp_localize_script( 'hvsfw-client', 'hvsfwLocal', array(
            'api'    => 'HNJOELMAFUCOHACM',
            'url'    => admin_url( 'admin-ajax.php' ),
            'plugin' => array(
                'isHAFWActive'  => Plugins::is_active( 'handy-add-to-cart' ),
                'isHATFWActive' => Plugins::is_active( 'handy-added-to-cart-toaster-notifier' ),
                'isHAPFWActive' => Plugins::is_active( 'handy-added-to-cart-popup-notifier' ),
            ),
            'setting' => array(
                'notice' => array(
                    'duration'   => $this->settings['gn_nc_duration'],
                    'isEnabled'  => $this->settings['gn_nc_enable_notice'],
                    'isAutoHide' => $this->settings['gn_nc_auto_hide'],
                ),
            ),
            'nonce'   => array(
                'variationAddToCart' => wp_create_nonce( 'hvsfw_variation_add_to_cart' ),
            ),
        ));
    }
}
