<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Field Validation.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class FieldValidation {

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
     * Validated each fields based on the type and rules of the field.
     * It also returns the updated value of all the fields and the total
     * valid and invalid fields.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing all the parameters for validating fields.
     * $args = [
     *     'fields'        => (array) Containing all the new fields.
     *     'current_value' => (array) Containing the fields value from get_option().
     *     'field_rules'   => (array) Containing the set of rules for each fields.
     * ]
     * @return array
     */
    public static function validate( $args = [] ) {
        if ( ! isset( $args['fields'] ) || ! isset( $args['current_value'] ) || ! isset( $args['field_rules'] ) ) {
            return false;
        }

        $fields        = $args['fields'];
        $field_rules   = $args['field_rules'];
        $current_value = $args['current_value'];

        // Holds all the validation results in each field.
        $validation_results = [
            'valid'   => [],
            'invalid' => []
        ];

        // Validating each fields.
        foreach ( $fields as $key => $value ) {
            switch ( $field_rules[ $key ]['type'] ) {
                case 'text':
                    $validation = self::validate_text_field([
                        'value'         => $value,
                        'max'           => $field_rules[ $key ]['max'],
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'textarea':
                    $validation = self::validate_textarea_field([
                        'value'         => $value
                    ]);
                    break;
                case 'number':
                    $validation = self::validate_number_field([
                        'value'         => $value,
                        'current_value' => $current_value[ $key ]
                    ]);
                    $value = absint( $value );
                    break;
                case 'size':
                    $validation = self::validate_size_field([
                        'value'         => $value,
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'select':
                    $validation = self::validate_select_field([
                        'value'         => $value,
                        'choices'       => $field_rules[ $key ]['choices'],
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'switch':
                    $validation = self::validate_switch_field([
                        'value'         => $value,
                        'current_value' => $current_value[ $key ]
                    ]);
                    $value = absint( $value );
                    break;
                case 'color':
                    $validation = self::validate_color_picker_field([
                        'value'         => $value,
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'icon':
                    $validation = self::validate_icon_picker_field([
                        'value'         => $value,
                        'icons'         => $field_rules[ $key ]['icons'],
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'image':
                    $validation = self::validate_image_picker_field([
                        'value'         => $value,
                        'choices'       => $field_rules[ $key ]['choices'],
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
                case 'loader':
                    $validation = self::validate_loader_picker_field([
                        'value'         => $value,
                        'choices'       => $field_rules[ $key ]['choices'],
                        'current_value' => $current_value[ $key ]
                    ]);
                    break;
            }

            // Mapping the validation results.
            $validation['field'] = $key;
            if ( $validation['success'] === true ) {
                array_push( $validation_results['valid'], $validation );

                // Update the value of $current_value based on key index.
                $current_value[ $key ] = $value;
            } else {
                 array_push( $validation_results['invalid'], $validation );
            }
        }

        return [
            'validation'    => $validation_results,
            'updated_value' => $current_value
        ];
    }

    /**
     * Validate the value of text field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate text field.
     * $args = [
     *     'value'         => (string) The value of text field.
     *     'max'           => (int)    The maximum character length.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_text_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( strlen( $args['value'] ) <= $args['max'] ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Total characters must not exceed in '. $args['max'] .'.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of textarea field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate textarea field.
     * $args = [
     *     'value'         => (string) The value of textarea field.
     * ]
     * @return array
     */
    public static function validate_textarea_field( $args = [] ) {
        return [
            'success' => true,
            'value'   => $args['value']
        ];
    }


    /**
     * Validate the value of number field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate number field.
     * $args = [
     *     'value'         => (int) The value of number field.
     *     'current_value' => (int) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_number_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( $args['value'] !== '' && $args['value'] !== null ) {
            $number = filter_var( $args['value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            if ( is_numeric( $number ) ) {
                $output = [
                    'success' => true,
                    'value'   => round( $number )
                ];
            } else {
                $output['error'] = 'Invalid value. Please enter the appropriate value.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of switch field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate switch field.
     * $args = [
     *     'value'         => (boolean) The value of switch field.
     *     'current_value' => (boolean) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_switch_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'Invalid value. Please enter the appropriate value.'
        ];

        if ( in_array( $args['value'], ['0', '1'] ) ) {
            $output = [
                'success' => true,
                'value'   => $args['value']
            ];
        }
        return $output;
    }

    /**
     * Validate the value of select field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate select field.
     * $args = [
     *     'value'         => (int|string) The value of select field.
     *     'choices'       => (array)  Containing the choices in select field.
     *     'current_value' => (int|string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_select_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( in_array( $args['value'], $args['choices'] ) ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Invalid value. Please enter the appropriate value.';
            }
        }
        return $output;
    }
    
    /**
     * Validate the value of icon picker field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate icon picker field.
     * $args = [
     *     'value'         => (string) The value of icon picker field.
     *     'icons'         => (array)  Containing the list of icons in icon picker field.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_icon_picker_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( in_array( $args['value'], $args['icons'] ) ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Invalid icon. Please select the appropriate icon.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of image picker field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate image picker field.
     * $args = [
     *     'value'         => (string) The value of image picker field.
     *     'choices'       => (array)  Containing the list of images in image picker field.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_image_picker_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( in_array( $args['value'], $args['choices'] ) ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Invalid image. Please select the appropriate image.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of loader picker field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evalualoader picker field.
     * $args = [
     *     'value'         => (string) The value loader picker field.
     *     'choices'       => (array)  Containing the list of loaders choices.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_loader_picker_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( in_array( $args['value'], $args['choices'] ) ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Invalid loader. Please select the appropriate loader.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of color picker field.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate color picker field.
     * $args = [
     *     'value'         => (string) The value of color picker field.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_color_picker_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            if ( preg_match( '/^rgba\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3}),\s*(\d*(?:\.\d+)?)\)$/', $args['value'] ) == true ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                $output['error'] = 'Invalid color format. Please enter the appropriate color format.';
            }
        }
        return $output;
    }

    /**
     * Validate the value of text field in size(px) format.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the parameter need to evaluate text field size.
     * $args = [
     *     'value'         => (string) The value of text field size.
     *     'current_value' => (string) The current value from _hvsfw_main_settings.
     * ]
     * @return array
     */
    public static function validate_size_field( $args = [] ) {
        $output = [
            'success' => false,
            'value'   => $args['current_value'],
            'error'   => 'This field is required.'
        ];

        if ( ! empty( $args['value'] ) ) {
            $valid_keywords = [ 'unset', 'auto', 'max-content', 'min-content', 'fit-content' ];
            if ( in_array( $args['value'], $valid_keywords ) ) {
                $output = [
                    'success' => true,
                    'value'   => $args['value']
                ];
            } else {
                // Validate the size unit.
                $unit       = '';
                $valid_unit = [ '%', 'px', 'em', 'rem', 'vw', 'vh' ];
                foreach ( $valid_unit as $value ) {
                    if ( strpos( $args['value'], $value ) !== false ) {
                        $unit = $value;
                        break;
                    }
                }

                // Get the number only.
                $number = filter_var( $args['value'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                if ( $number !== '' || $number === 0 ) {
                    $output = [
                        'success' => true,
                        'value'   => $number . $unit
                    ];
                } else {
                    $output['error'] = 'Invalid value. Please enter the appropriate value.';
                }
            }
        }
        return $output;
    }
}