<?php
namespace HVSFW\Admin\Tab\ImporterExporter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Tab\ImporterExporter\ImporterExporterEvent;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ImporterExporterTab {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Register events.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Instantiate all importer & exporter events.
        ImporterExporterEvent::get_instance();
    }

    /**
     * Render the setting tab.
     *
     * @since 1.0.0
     */
    public static function render_tab() {
        echo Helper::render_view( 'tab/importer-exporter', [
            'page_title' => 'Importer & Exporter'
        ]);
    }
}