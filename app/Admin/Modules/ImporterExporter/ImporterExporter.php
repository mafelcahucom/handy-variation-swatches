<?php
/**
 * App > Admin > Modules > Importer Exporter > Importer Exporter.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Admin\Modules\ImporterExporter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Instantiator;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Modules\ImporterExporter\Events;

defined( 'ABSPATH' ) || exit;

/**
 * The `ImporterExporter` class modules contains the
 * all services of admin importer exporter page.
 *
 * @since 1.0.0
 */
final class ImporterExporter {

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
     * Instantiate.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        /**
         * Intantiate or load services.
         */
        self::instantiate(array(
            Events::class,
        ));
    }

    /**
     * Render the importer & exporter tab content.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function render_tab_content() {
        echo Helper::render_view( 'tab/importer-exporter' );
    }
}
