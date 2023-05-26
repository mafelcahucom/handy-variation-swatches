<?php
namespace HVSFW\Client\Widgets\VariationFilter\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Local Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class LocalHelper {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Return the font weight list.
     * 
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_font_weights() {
        return [
            '100', '200', '300', 
            '400', '500', '600', 
            '700', '800', '900'
        ];
    }

    /**
     * Return the border style list.
     * 
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_border_styles() {
        return [
            'dotted', 'dashed', 'solid', 'double', 'groove',
            'ridge', 'inset', 'outset', 'none', 'hidden'
        ];
    }
}