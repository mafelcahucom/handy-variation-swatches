<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
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
 * Client.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Client {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
	 */
	use Singleton;

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
            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        }

        self::register_classes();
    }

    /**
     * Returns all the class services.
     *
     * @return array  List of classes
     */
    private static function get_classes() {
        return [
            Filters::class,
            Actions::class,
            Style::class,
            Swatch::class,
            Widgets::class,
            Blocks::class
        ];
    }

    /**
     * Loop through the services classes and instantiate each class.
     *
     * @since 1.0.0
     */
    private static function register_classes() {
        foreach ( self::get_classes() as $class ) {
            if ( method_exists( $class, 'get_instance' ) ) {
                self::instantiate( $class );
            }
        }
    }

    /**
     * Instantiate the given service class.
     *
     * @since 1.0.0
     *
     * @param  class  $class  Containing a class from self::get_classes().
     * @return class
     */
    private static function instantiate( $class ) {
        $class::get_instance();
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     */
    public function register_scripts() {
        // Include wc-add-to-cart-variation in shop page.
        $dependency = [ 'jquery' ];
        if ( $this->settings['gn_sp_enable'] == true ) {
            $dependency[] = 'wc-add-to-cart-variation';
        }

        $source  = Helper::get_asset_src( 'js/hvsfw-client.min.js' );
        $version = Helper::get_asset_version( 'js/hvsfw-client.min.js' );
        wp_register_script( 'hvsfw-client', $source, $dependency, $version, true );
        wp_enqueue_script( 'hvsfw-client' );

        wp_localize_script( 'hvsfw-client', 'hvsfwLocal', [
            'api'    => 'HNJOELMAFUCOHACM',
            'url'    => admin_url( 'admin-ajax.php' ),
            'plugin' => [
                'isHAFWActive'  => Plugins::is_active( 'handy-add-to-cart' ),
                'isHATFWActive' => Plugins::is_active( 'handy-added-to-cart-toaster-notifier' ),
                'isHAPFWActive' => Plugins::is_active( 'handy-added-to-cart-popup-notifier' )
            ],
            'setting' => [
                'notice' => [
                    'duration'   => $this->settings['gn_nc_duration'],
                    'isEnabled'  => $this->settings['gn_nc_enable_notice'],
                    'isAutoHide' => $this->settings['gn_nc_auto_hide']
                ]
            ],
            'nonce'   => [
                'variationAddToCart' => wp_create_nonce( 'hvsfw_variation_add_to_cart' )
            ]
        ]);
    }
}