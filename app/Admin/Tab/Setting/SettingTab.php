<?php
namespace HVSFW\Admin\Tab\Setting;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Tab\Setting\SettingEvent;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingTab {

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
        // Instantiate all settings events.
        SettingEvent::get_instance();
    }

    /**
     * Render the setting tab.
     *
     * @since 1.0.0
     */
    public static function render_tab() {
        echo Helper::render_view( 'tab/setting', [
            'page_title' => 'Setting'
        ]);
    }
}