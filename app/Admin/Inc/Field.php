<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Client\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Field.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Field {

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
     * Return the text field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating text field.
     * $args = [
     *     'name'        => (string) Contains the name of the text field.
     *     'group'       => (string) Contains the name of the group this text field.
     *     'value'       => (string) Contains the default value of the text field.
     *     'label'       => (string) Contains the label of the text field.
     *     'description' => (string) Contains the description of the text field.
     *     'placeholder' => (string) Contains the placeholder of the text field.
     * ]
     * @return HTMLElement
     */
    public static function get_text_field( $args = [] ) {
        return Helper::render_view( 'field/text-field', $args );
    }

    /**
     * Return the textarea field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating textarea field.
     * $args = [
     *     'name'        => (string) Contains the name of the textarea field.
     *     'group'       => (string) Contains the name of the group this textarea field.
     *     'value'       => (string) Contains the default value of the textarea field.
     *     'label'       => (string) Contains the label of the textarea field.
     *     'description' => (string) Contains the description of the textarea field.
     *     'placeholder' => (string) Contains the placeholder of the textarea field.
     * ]
     * @return HTMLElement
     */
    public static function get_textarea_field( $args = [] ) {
        return Helper::render_view( 'field/textarea-field', $args );
    }

    /**
     * Return the number field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating number field.
     * $args = [
     *     'name'        => (string)  Contains the name of the number field.
     *     'group'       => (string)  Contains the name of the group this number field.
     *     'value'       => (integer) Contains the default value of the number field.
     *     'label'       => (string)  Contains the label of the number field.
     *     'description' => (string)  Contains the description of the number field.
     *     'placeholder' => (string)  Contains the placeholder of the number field.
     * ]
     * @return HTMLElement
     */
    public static function get_number_field( $args = [] ) {
        return Helper::render_view( 'field/number-field', $args );
    }

    /**
     * Return the select field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating select field.
     * $args = [
     *     'name'        => (string) Contains the name of the select field.
     *     'group'       => (string) Contains the name of the group this select field.
     *     'value'       => (string) Contains the default value of the select field.
     *     'label'       => (string) Contains the label of the select field.
     *     'options'     => (array)  Contains the set of options to be selected.
     *     'description' => (string) Contains the description of the select field.
     *     'placeholder' => (string) Contains the placeholder of the select field.
     * ]
     * @return HTMLElement
     **/
    public static function get_select_field( $args = [] ) {
        return Helper::render_view( 'field/select-field', $args );
    }

    /** 
     * Return the switch field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating switch field.
     * $args = [
     *     'name'        => (string)  Contains the name of the switch field.
     *     'group'       => (string)  Contains the name of the group this switch field.
     *     'value'       => (boolean) Contains the default value of the switch field.
     *     'label'       => (string)  Contains the label of the switch field.
     *     'description' => (string)  Contains the description of the switch field.
     *     'placeholder' => (string)  Contains the placeholder of the switch field.
     *     'choices'     => (array)   Contains the choices label aliases on : On | off : Off.
     * ]
     * @return HTMLElement
    **/
    public static function get_switch_field( $args = [] ) {
        return Helper::render_view( 'field/switch-field', $args );
    }

    /**
     * Return the color picker field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating color picker field.
     * $args = [
     *     'name'        => (string) Contains the name of the color-picker field.
     *     'group'       => (string) Contains the name of the group this color-picker field.
     *     'value'       => (string) Contains the default value of the color-picker field.
     *     'label'       => (string) Contains the label of the color-picker field.
     *     'description' => (string) Contains the description of the color-picker field.
     * ]
     * @return HTMLElement
    **/
    public static function get_color_picker_field( $args = [] ) {
        $color        = ( isset( $args['value'] ) ? $args['value'] : 'rgba(0,0,0,1)' );
        $args['hexa'] = Helper::convert_rgba_to_hexa( $color );
        return Helper::render_view( 'field/color-picker-field', $args );
    }

    /**
     * Return the svg icon picker field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating icon picker field.
     * $args = [
     *     'name'        => (string) Contains the name of the icon field.
     *     'group'       => (string) Contains the name of the group this icon field.
     *     'value'       => (string) Contains the default value of the icon field.
     *     'label'       => (string) Contains the label of the icon field.
     *     'description' => (string) Contains the description of the icon field.
     *     'icons'       => (array)  Contains the icon list [ name, svg ].
     * ]
     * @return HTMLElement
     **/
    public static function get_icon_picker_field( $args = [] ) {
        if ( ! isset( $args['icons'] ) ) {
            return;
        }

        if ( isset( $args['value'] ) && ! empty( $args['value'] ) ) {
            if ( ( $key = array_search( $args['value'], $args['icons'] ) ) !== false ) {
                unset( $args['icons'][ $key ] );
                array_unshift( $args['icons'], $args['value'] );
            }
        }

        $icons = [];
        foreach ( $args['icons'] as $icon ) {
            $svg = Icon::get( $icon,'hd-svg' );
            if ( ! empty( $svg ) ) {
                array_push( $icons, [
                    'svg'  => $svg,
                    'name' => $icon
                ]);
            }
        }

        $args['icons'] = $icons;
        return Helper::render_view( 'field/icon-picker-field', $args );
    }

    /**
     * Return the loader picker field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating iamge picker field.
     * $args = [
     *     'name'        => (string) Contains the name of the loader picker field.
     *     'group'       => (string) Contains the name of the group this loader picker field.
     *     'value'       => (string) Contains the default value of the loader picker field.
     *     'label'       => (string) Contains the label of the loader picker field.
     *     'description' => (string) Contains the description of the loader picker field.
     *     'choices'     => (array)  Contains the name of the loaders.
     *]
     * @return HTMLElement
     **/
    public static function get_loader_picker_field( $args = [] ) {
        if ( isset( $args['value'] ) && ! empty( $args['value'] ) ) {
            if ( ( $key = array_search( $args['value'], $args['choices'] ) ) !== false ) {
                unset( $args['choices'][ $key ] );
                array_unshift( $args['choices'], $args['value'] );
            }
        }

        return Helper::render_view( 'field/loader-picker-field', $args );
    }

    /**
     * Return the note field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains the necessary parameters for creating note field.
     * $args = [
     *     'type'    => (string)  Contains the type of note field |message|alert.
     *     'title'   => (string)  Contains the title of the note field.
     *     'content' => (string)  Contains the content that will be displayed in note field.
     *     'icon'    => (boolean) Contains the flag whether to show icon in note field, default false.
     * ]
     * @return HTMLElement
    **/
    public static function get_note_field( $args = [] ) {
        return Helper::render_view( 'field/note-field', $args );
    }
}