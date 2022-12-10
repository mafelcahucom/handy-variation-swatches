<?php
namespace HVSFW\Client\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Client Icons.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Icon {

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
     * Return the svg icon.
     *
     * @since 1.0.0
     * 
     * @param  string  $type   The type of icon.
     * @param  string  $class  Additional class.
     * @return string
     */
    public static function get( $type, $class = '' ) {
        $output  = '';
        $e_class = esc_attr( $class );
        switch ( $type ) {
            case 'bs-caret-down':
                $output = "<svg class='". $e_class ."' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>";
                break;
        }
        
        return $output;
    }
}