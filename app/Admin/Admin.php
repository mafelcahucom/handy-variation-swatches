<?php
namespace HVSFW\Admin;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Tab\Setting\SettingTab;
use HVSFW\Admin\Tab\ImporterExporter\ImporterExporterTab;
use HVSFW\Admin\Variation\AttributeMeta;
use HVSFW\Admin\Variation\TermMeta;
use HVSFW\Admin\Variation\ProductMeta;

defined( 'ABSPATH' ) || exit;

/**
 * Admin.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Admin {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Holds all the tabs.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $tabs = [];

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Load all classes.
        self::register_classes();

        // Load admin dashboard.
        add_action( 'admin_menu', [ $this, 'menu' ] );

        if ( Helper::is_correct_page() ) {
            // Register styles and scripts.
            add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

            // Hide all the notices.
            add_action( 'admin_head', [ $this, 'hide_all_notices' ] );
        }
    }

    /**
     * Admin Dashboard Menu.
     *
     * @since 1.0.0
     */
    public function menu() {
        if ( Helper::is_menu_exists( 'handy' ) === false ) {
            add_menu_page( 
                'Handy', 
                'Handy', 
                'manage_options', 
                'handy', 
                '', 
                Helper::get_asset_src( 'images/icon.svg' ), 
                null 
            );

            add_submenu_page( 
                'handy', 
                'Handy', 
                'Handy', 
                'manage_options', 
                'handy', 
                [ $this, 'render_menu_dashboard' ] 
            );
        }

        add_submenu_page( 
            'handy', 
            'Variation Swatches', 
            'Variation Swatches', 
            'manage_options', 
            'hvsfw', 
            [ $this, 'render_submenu_dashboard' ] 
        );
    }

    /**
     * Render the main menu dashboard.
     *
     * @since 1.0.0
     */
    public function render_menu_dashboard() {
        echo "<h1>Menu Dashboard</h1>";
    }

    /**
     * Render the submenu dashboard.
     * 
     * @since 1.0.0
     */
    public function render_submenu_dashboard() {
        // Check if the plugin has error.
        if ( Helper::plugin_has_error() ) {
            echo Helper::render_view( 'component/error-notice' );
            return;
        }

        // Check if the current page is invalid.
        if ( ! Helper::is_correct_page() ) {
            return;
        }

        // Render the tab content based on current tab slug.
        if ( isset( $_GET['tab'] ) ) {
            switch ( $_GET['tab'] ) {
                case 'setting':
                    SettingTab::render_tab();
                    break;
                case 'import-export':
                    ImporterExporterTab::render_tab();
                    break;
            }
        } else {
            SettingTab::render_tab();
        }
    }


    /**
     * Returns all the class services.
     *
     * @return array  List of classes
     */
    private static function get_classes() {
        return [
            SettingTab::class,
            ImporterExporterTab::class,
            AttributeMeta::class,
            TermMeta::class,
            ProductMeta::class
        ];
    }

    /**
     * Loop through the services classes and instantiate each class.
     *
     * @since 1.0.0
     */
    public static function register_classes() {
        foreach ( self::get_classes() as $class ) {
            // For instantiating.
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
     * Register all styles.
     *
     * @since 1.0.0
     */
    public function register_styles() {
        wp_register_style( 'lexend-deca', Helper::get_asset_src( 'fonts/lexend-deca/lexend-deca.css' ), [], '1.0.0', 'all' );
        wp_enqueue_style( 'lexend-deca' );

        wp_register_style( 'pickr', Helper::get_asset_src( 'pickr/pickr.min.css' ), [], '1.0.0', 'all' );
        wp_enqueue_style( 'pickr' );

        wp_register_style( 'hvsfw-admin', Helper::get_asset_src( 'css/hvsfw-admin.min.css' ), [], '1.0.0', 'all' );
        wp_enqueue_style( 'hvsfw-admin' );
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     */
    public function register_scripts() {
        wp_register_script( 'pickr', Helper::get_asset_src( 'pickr/pickr.min.js' ), [], '1.0.0', true );
        wp_enqueue_script( 'pickr' );

        wp_register_script( 'hvsfw-admin', Helper::get_asset_src( 'js/hvsfw-admin.min.js' ), [], '1.0.0', true );
        wp_enqueue_script( 'hvsfw-admin' );

        // Localize variables.
        wp_localize_script( 'hvsfw-admin', 'hvsfwLocal', [
            'crafter' => 'Y35qwbAlyt+y60cldwAatUDyxikpRb30wBPT9Y1Xymk=',
            'url'     => admin_url( 'admin-ajax.php' ),
            'tab'     => [
                'setting' => [
                    'nonce' => [
                        'saveSettings' => wp_create_nonce( 'hvsfw_save_settings' )
                    ]
                ],
                'importerExporter' => [
                    'nonce' => [
                        'exportSettings' => wp_create_nonce( 'hvsfw_export_settings' ),
                        'importSettings' => wp_create_nonce( 'hvsfw_import_settings' )
                    ]
                ]
            ]
        ]);
    }

    /**
     * Hides all the admin notices.
     *
     * @since 1.0.0
     */
    public function hide_all_notices() {
        remove_all_actions( 'admin_notices' );
    }
}