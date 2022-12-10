<?php
namespace HVSFW\Admin\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Client\Inc\Icon;

defined( 'ABSPATH' ) || exit;

/**
 * Admin Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Field {

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
     * Return the text field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating text field.
     * $args = [
     *     'name'        => (string) The name of the text field.
     *     'group'       => (string) The name of the group this text field.
     *     'value'       => (string) The default value of the text field.
     *     'label'       => (string) The label of the text field.
     *     'description' => (string) The description of the text field.
     *     'placeholder' => (string) The placeholder of the text field.
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
     * @param  array  $args  Contains all data for creating textarea field.
     * $args = [
     *     'name'        => (string) The name of the textarea field.
     *     'group'       => (string) The name of the group this textarea field.
     *     'value'       => (string) The default value of the textarea field.
     *     'label'       => (string) The label of the textarea field.
     *     'description' => (string) The description of the textarea field.
     *     'placeholder' => (string) The placeholder of the textarea field.
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
     * @param  array  $args  Contains all data for creating number field.
     * $args = [
     *     'name'        => (string) The name of the number field.
     *     'group'       => (string) The name of the group this number field.
     *     'value'       => (int)    The default value of the number field.
     *     'label'       => (string) The label of the number field.
     *     'description' => (string) The description of the number field.
     *     'placeholder' => (string) The placeholder of the number field.
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
     * @param  array  $args  Contains all data for creating select field.
     * $args = [
     *     'name'        => (string) The name of the select field.
     *     'group'       => (string) The name of the group this select field.
     *     'value'       => (string) The default value of the select field.
     *     'label'       => (string) The label of the select field.
     *     'options'     => (array)  Set of options to be selected.
     *     'description' => (string) The description of the select field.
     *     'placeholder' => (string) The placeholder of the select field.
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
     * @param  array  $args  Contains all data for creating switch field.
     * $args = [
     *     'name'        => (string) The name of the switch field.
     *     'group'       => (string) The name of the group this switch field.
     *     'value'       => (boolean) The default value of the switch field.
     *     'label'       => (string) The label of the switch field.
     *     'description' => (string) The description of the switch field.
     *     'placeholder' => (string) The placeholder of the switch field.
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
     * @param  array  $args  Contains all data for creating color picker field.
     * $args = [
     *     'name'        => (string) The name of the color-picker field.
     *     'group'       => (string) The name of the group this color-picker field.
     *     'value'       => (string) The default value of the color-picker field.
     *     'label'       => (string) The label of the color-picker field.
     *     'description' => (string) The description of the color-picker field.
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
     * @param  array  $args  Contains all data for creating icon picker field.
     * $args = [
     *     'name'        => (string) The name of the icon field.
     *     'group'       => (string) The name of the group this icon field.
     *     'value'       => (string) The default value of the icon field.
     *     'label'       => (string) The label of the icon field.
     *     'description' => (string) The description of the icon field.
     *     'icons'       => (array)  Contains the icon list [ name, svg ].
     * ]
     * @return HTMLElement
     **/
    public static function get_icon_picker_field( $args = [] ) {
        if ( ! isset( $args['icons'] ) ) {
            return;
        }

        $icons = [];
        foreach ( $args['icons'] as $key => $icon ) {
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
     * Return the image picker field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating image picker field.
     * $args = [
     *     'name'        => (string) The name of the image picker field.
     *     'group'       => (string) The name of the group this image picker field.
     *     'value'       => (string) The default value of the image picker field.
     *     'label'       => (string) The label of the image picker field.
     *     'description' => (string) The description of the image picker field.
     *     'max_width'   => (int)    The max width of the image picker thumbnail.
     *     'choices'     => (array)  Contains the image picker choices |value|label|image|.
     * ]
     * @return HTMLElement
     **/
    public static function get_image_picker_field( $args = [] ) {
        return Helper::render_view( 'field/image-picker-field', $args );
    }

    /**
     * Return the loader picker field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating iamge picker field.
     * $args = [
     *     'name'        => (string) The name of the loader picker field.
     *     'group'       => (string) The name of the group this loader picker field.
     *     'value'       => (string) The default value of the loader picker field.
     *     'label'       => (string) The label of the loader picker field.
     *     'description' => (string) The description of the loader picker field.
     *     'choices'     => (array)  Contains the name of the loaders.
     *]
     * @return HTMLElement
     **/
    public static function get_loader_picker_field( $args = [] ) {  
        return Helper::render_view( 'field/loader-picker-field', $args );
    }

    /**
     * Return the multiple field component.
     *
     * @since 1.0.0
     * 
     * $args = [
     *     'label'       => (string) The label of the text field.
     *     'description' => (string) The description of the text field.
     *     'fields'      => (array)  Containing the set of fields.
     * ]
     * @return HTMLElement
    **/
    public static function get_multiple_field( $args = [] ) {
        return Helper::render_view( 'field/multiple-field', $args );
    }

    /**
     * Return the note field component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating note field.
     * $args = [
     *     'title'        => (string) The title of the note field.
     *     'content'      => (string) The content that will be displayed in note field.
     * ]
     * @return HTMLElement
    **/
    public static function get_note_field( $args = [] ) {
        return Helper::render_view( 'field/note-field', $args );
    }
}