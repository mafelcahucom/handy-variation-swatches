<?php
/**
 * App > Admin > Admin.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Admin;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Instantiator;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Modules\Setting\Setting;
use HVSFW\Admin\Modules\ImporterExporter\ImporterExporter;
use HVSFW\Admin\Variation\AttributeMeta;
use HVSFW\Admin\Variation\TermMeta;
use HVSFW\Admin\Variation\ProductMeta;

defined( 'ABSPATH' ) || exit;

/**
 * The `Admin` class contains all the services and
 * settings that needs to be loaded in the admin
 * side or back-end.
 *
 * @since 1.0.0
 */
final class Admin {

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
     * Holds all the tabs.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $tabs = array();

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Intantiate or load services.
         */
        self::instantiate(array(
            Setting::class,
            ImporterExporter::class,
            AttributeMeta::class,
            TermMeta::class,
            ProductMeta::class,
        ));

        /**
         * Load admin dashboard.
         */
        add_action( 'admin_menu', array( $this, 'menu' ) );

        if ( Helper::is_correct_menu() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'register_menu_styles' ) );
        }

        if ( Helper::is_correct_submenu() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'register_submenu_styles' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'register_submenu_scripts' ) );

            add_action( 'admin_head', array( $this, 'hide_all_notices' ) );
        }
    }

    /**
     * Admin Dashboard Menu.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function menu() {
        if ( Helper::is_menu_exists( 'handy-tools' ) === false ) {
            add_menu_page(
                'Handy Tools',
                'Handy Tools',
                'manage_options',
                'handy-tools',
                '',
                Helper::get_resource_src( 'images/icon.svg' ),
                null
            );

            add_submenu_page(
                'handy-tools',
                'Handy Tools',
                'Handy Tools',
                'manage_options',
                'handy-tools',
                array( $this, 'render_menu_dashboard' )
            );
        }

        add_submenu_page(
            'handy-tools',
            'Variation Swatches',
            'Variation Swatches',
            'manage_options',
            'hvsfw',
            array( $this, 'render_submenu_dashboard' )
        );
    }

    /**
     * Render the main menu dashboard.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function render_menu_dashboard() {
        echo Helper::render_view( 'home' );
    }

    /**
     * Render the submenu dashboard.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function render_submenu_dashboard() {
        if ( Helper::plugin_has_error() ) {
            echo Helper::render_view( 'component/error-notice' );
            return;
        }

        if ( Helper::is_correct_submenu() ) {
            if ( isset( $_GET['tab'] ) ) {
                switch ( $_GET['tab'] ) {
                    case 'setting':
                        Setting::render_tab_content();
                        break;
                    case 'import-export':
                        ImporterExporter::render_tab_content();
                        break;
                }
            } else {
                Setting::render_tab_content();
            }
        }
    }

    /**
     * Register all parent menu styles.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_menu_styles() {
        wp_register_style( 'lexend-deca', Helper::get_resource_src( 'fonts/lexend-deca/lexend-deca.css' ), array(), '1.0.0', 'all' );
        wp_enqueue_style( 'lexend-deca' );

        $asset        = include HVSFW_PLUGIN_PATH . 'public/admin/styles/hvsfw-home.asset.php';
        $asset['src'] = Helper::get_public_src( 'styles/hvsfw-home.css' );
        wp_register_style( 'hvsfw-home', $asset['src'], $asset['dependencies'], $asset['version'], 'all' );
        wp_enqueue_style( 'hvsfw-home' );
    }

    /**
     * Register all submenu styles.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_submenu_styles() {
        wp_register_style( 'lexend-deca', Helper::get_resource_src( 'fonts/lexend-deca/lexend-deca.css' ), array(), '1.0.0', 'all' );
        wp_enqueue_style( 'lexend-deca' );

        wp_register_style( 'pickr', Helper::get_resource_src( 'pickr/pickr.min.css' ), array(), '1.0.0', 'all' );
        wp_enqueue_style( 'pickr' );

        $asset        = include HVSFW_PLUGIN_PATH . 'public/admin/styles/hvsfw-admin.asset.php';
        $asset['src'] = Helper::get_public_src( 'styles/hvsfw-admin.css' );
        wp_register_style( 'hvsfw-admin', $asset['src'], $asset['dependencies'], $asset['version'], 'all' );
        wp_enqueue_style( 'hvsfw-admin' );
    }

    /**
     * Register all submenu scripts.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_submenu_scripts() {
        wp_register_script( 'pickr', Helper::get_resource_src( 'pickr/pickr.min.js' ), array(), '1.0.0', true );
        wp_enqueue_script( 'pickr' );

        $asset        = include HVSFW_PLUGIN_PATH . 'public/admin/scripts/hvsfw-admin.asset.php';
        $asset['src'] = Helper::get_public_src( 'scripts/hvsfw-admin.js' );
        wp_register_script( 'hvsfw-admin', $asset['src'], $asset['dependencies'], $asset['version'], true );
        wp_enqueue_script( 'hvsfw-admin' );

        wp_localize_script( 'hvsfw-admin', 'hvsfwLocal', array(
            'api'    => 'HNJOELMAFUCOHACM',
            'url'    => admin_url( 'admin-ajax.php' ),
            'module' => array(
                'setting' => array(
                    'nonce' => array(
                        'saveSettings' => wp_create_nonce( 'hvsfw_save_settings' ),
                    ),
                ),
                'importerExporter' => array(
                    'nonce' => array(
                        'exportSettings' => wp_create_nonce( 'hvsfw_export_settings' ),
                        'importSettings' => wp_create_nonce( 'hvsfw_import_settings' ),
                    ),
                ),
            ),
        ));
    }

    /**
     * Hides all the admin notices.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function hide_all_notices() {
        remove_all_actions( 'admin_notices' );
    }
}
