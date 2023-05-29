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
 * @author Mafel John Cahucom
 */
final class Client {

	/**
	 * Inherit Singleton.
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
        // Check if plugin has error.
        if ( Helper::plugin_has_error() ) {
            return;
        }

        // Check if the plugin is enable in front-end.
        $this->settings = get_option( '_hvsfw_main_settings' );
        if ( $this->settings['gn_enable'] == false ) {
            return;
        }

        if ( ! is_admin() ) {
            // Enqueue styles and scripts.
            add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );
        }

        // Register all classes.
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
     * @since 1..0.0
     */
    public function register_scripts() {
        // Include dependency.
        $client_dependency = [ 'jquery' ];

        // Include wc-add-to-cart-variation in shop page.
        if ( $this->settings['gn_sp_enable'] == true ) {
            $client_dependency[] = 'wc-add-to-cart-variation';
        }

        // Client js.
        wp_register_script( 'hvsfw-client-js', Helper::get_asset_src( 'js/hvsfw-client.min.js' ), $client_dependency, Helper::get_asset_version( 'js/hvsfw-client.min.js' ), true );
        wp_enqueue_script( 'hvsfw-client-js' );

        // Localize variables.
        wp_localize_script( 'hvsfw-client-js', 'hvsfwLocal', [
            'crafter' => 'Y35qwbAlyt+y60cldwAatUDyxikpRb30wBPT9Y1Xymk=',
            'url'     => admin_url( 'admin-ajax.php' ),
            'plugin'  => [
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