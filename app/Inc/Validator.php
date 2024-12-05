<?php
/**
 * App > Inc > Utility.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * The `Validator` class contains the global field or
 * data validator.
 *
 * @since 1.0.0
 */
final class Validator {

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
     * Validate text value.
     *
     * @sinc 1.0.0
     *
     * @param  array $args Contains the necessary arguments to evaluate text value.
     * $args = [
     *     'value'   => (mixed)   Contains the current value.
     *     'default' => (mixed)   Contains the default value.
     *     'empty'   => (boolean) Contains the flag if the value can be empty.
     * ]
     * @return mixed
     */
    public static function validate_text( $args = array() ) {
        $output = '';
        // phpcs:ignore Universal.Operators.StrictComparisons.LooseNotEqual
        if ( $args['value'] != '' ) {
            $output = sanitize_text_field( $args['value'] );
        } elseif ( ! $args['empty'] ) {
                $output = $args['default'];
        }

        return $output;
    }

    /**
     * Validate select value.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments to evaluate select value.
     * $args = [
     *    'value'   => (mixed) Contains the current value.
     *    'default' => (mixed) Contains the default value.
     *    'choices' => (array) Contains the array of choices value.
     * ]
     * @return mixed
     */
    public static function validate_select( $args = array() ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
            if ( in_array( $args['value'], $args['choices'] ) ) {
                $output = sanitize_text_field( $args['value'] );
            }
        }

        return $output;
    }

    /**
     * Validate color value.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments to evaluate color value.
     * $args = [
     *    'value'   => (string) Contains the current value.
     *    'default' => (string) Contains the default value.
     * ]
     * @return string
     */
    public static function validate_color( $args = array() ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            if ( preg_match( '/^#[a-f0-9]{6}$/i', $args['value'] ) ) {
                $output = sanitize_text_field( $args['value'] );
            }
        }

        return $output;
    }

    /**
     * Validate size value.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments to evaluate size value.
     * $args = [
     *    'value'   => (string) Contains the current value.
     *    'default' => (string) Contains the default value.
     * ]
     * @return string
     */
    public static function validate_size( $args = array() ) {
        $output = $args['default'];
        if ( ! empty( $args['value'] ) ) {
            $valid_keywords = array( 'unset', 'auto', 'max-content', 'min-content', 'fit-content' );
            // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
            if ( in_array( $args['value'], $valid_keywords ) ) {
                $output = sanitize_text_field( $args['value'] );
            } else {
                // Validate the size unit.
                $unit       = '';
                $valid_unit = array( '%', 'px', 'em', 'rem', 'vw', 'vh' );
                foreach ( $valid_unit as $value ) {
                    if ( strpos( $args['value'], $value ) !== false ) {
                        $unit = $value;
                        break;
                    }
                }

                // Get the number only.
                $number = filter_var( $args['value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                if ( ! empty( $number ) || $number === 0 ) {
                    $output = $number . $unit;
                }
            }
        }

        return $output;
    }
}
