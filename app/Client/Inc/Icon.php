<?php
/**
 * App > Client > Inc > Icon.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Icon` class contains a set of SVG icons that
 * can be used in client side or front-end
 *
 * @since 1.0.0
 */
final class Icon {

    /**
     * Inherit Singleton.
     *
     * @since 1.0.0
     */
    use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Return the svg icon.
     *
     * @since 1.0.0
     *
     * @param  string $name       Contains the name of icon to be retrieved.
     * @param  string $classnames Contains the additional classnames.
     * @return string
     */
    public static function get( $name, $classnames = '' ) {
        $classnames = esc_attr( $classnames );
        return match ( $name ) {
            'bs-caret-down' => sprintf(
                '<svg class="%s" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>',
                $classnames
            ),
            'close-filled' => sprintf(
                '<svg class="%s" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z"/></svg>',
                $classnames
            )
        };
    }
}
