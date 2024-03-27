<?php
namespace HVSFW\Admin\Modules\ImporterExporter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Modules\ImporterExporter\Events;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Modules > Importer & Exporter.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class ImporterExporter {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Instantiate.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Register all classes.
        self::register_classes();
    }

    /**
     * Returns all the class services.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    private static function get_classes() {
        return [
            Events::class,
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
     * Render the importer & exporter tab content.
     *
     * @since 1.0.0
     */
    public static function render_tab_content() {
        echo Helper::render_view( 'tab/importer-exporter' );
    }
}