<?php
/**
 * Views > Admin > Variation > Attribute > Swatch Setting Form Edit.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\SwatchHelper;

defined( 'ABSPATH' ) || exit; 

/** 
 * $args = [
 *     'setting' => (array) The setting of the attribute configurations from _hsvfw_attribute.
 *     'default' => (array) The default value for the attribute fields.
 * ]
 **/

if ( ! isset( $args['setting'] ) || ! isset( $args['default'] ) ) {
    return;
}

$settings = $args['setting'];
$defaults = $args['default'];
foreach ( $defaults as $key => $default  ) {
    $settings[ $key ] = ( isset( $settings[ $key ] ) ? $settings[ $key ] : $default );
}

// Set the group field visibility.
$field_visibility = SwatchHelper::get_swatch_setting_group_field_visibility( $settings );
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="hvsfw_type">Variation Swatch Settings</label>
    </th>
    <td>
        <p class="description">Configure the settings for this variation swatch attribute. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>">here</a>.</p>
    </td>
</tr>
<tr id="hvsfw-form-field-style" class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_style" data-visible="<?php echo $field_visibility['style']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_style">Style (Design)</label>
    </th>
    <td>
        <select name="hvsfw_style" id="hvsfw_style" data-prefix="hvsfw">
            <option value="default" <?php selected( $settings['style'], 'default' ); ?>>Default</option>
            <option value="custom" <?php selected( $settings['style'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_shape" data-visible="<?php echo $field_visibility['shape']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_shape">Shape</label>
    </th>
    <td>
        <select name="hvsfw_shape" id="hvsfw_shape" data-prefix="hvsfw">
            <option value="square" <?php selected( $settings['shape'], 'square' ); ?>>Square</option>
            <option value="circle" <?php selected( $settings['shape'], 'circle' ); ?>>Circle</option>
            <option value="custom" <?php selected( $settings['shape'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select your preferred shape of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_size" data-visible="<?php echo $field_visibility['size']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Size</label>
    </th>
    <td>
        <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="<?php echo esc_attr( $settings['size'] ); ?>">
        <p class="description">The size or width & height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_dimension" data-visible="<?php echo $field_visibility['dimension']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_width">Size</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="text" name="hvsfw_width" id="hvsfw_width" placeholder="40px" value="<?php echo esc_attr( $settings['width'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Height</p>
                <input type="text" name="hvsfw_height" id="hvsfw_height" placeholder="40px" value="<?php echo esc_attr( $settings['height'] ); ?>">
            </div>
        </div>
        <p class="description">The width and height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_font" data-visible="<?php echo $field_visibility['font']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_font_size">Font</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Size</p>
                <input type="text" name="hvsfw_font_size" id="hvsfw_font_size" placeholder="14px" value="<?php echo esc_attr( $settings['font_size'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Weight</p>
                <select name="hvsfw_font_weight" id="hvsfw_font_weight">
                    <?php foreach ( Helper::get_font_weight_choices() as $value ): ?>
                        <option value="<?php echo $value['value']; ?>" <?php selected( $settings['font_weight'], $value['value'] ); ?>>
                            <?php echo $value['label']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <p class="description">The font size and weight of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_text_color" data-visible="<?php echo $field_visibility['text_color']; ?>">
    <th scope="row" valign="top">
        <label>Text Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The text color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_background_color" data-visible="<?php echo $field_visibility['background_color']; ?>">
    <th scope="row" valign="top">
        <label>Background Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_background_color" id="hvsfw_background_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_background_hover_color" id="hvsfw_background_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The background color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_padding" data-visible="<?php echo $field_visibility['padding']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_padding_top">Padding</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Top</p>
                <input type="text" name="hvsfw_padding_top" id="hvsfw_padding_top" placeholder="5px" value="<?php echo esc_attr( $settings['padding_top'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Bottom</p>
                <input type="text" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" placeholder="5px" value="<?php echo esc_attr( $settings['padding_bottom'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Left</p>
                <input type="text" name="hvsfw_padding_left" id="hvsfw_padding_left" placeholder="5px" value="<?php echo esc_attr( $settings['padding_left'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Right</p>
                <input type="text" name="hvsfw_padding_right" id="hvsfw_padding_right" placeholder="5px" value="<?php echo esc_attr( $settings['padding_right'] ); ?>">
            </div>
        </div>
        <p class="description">The padding of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_border" data-visible="<?php echo $field_visibility['border']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_border_style">Border</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Style</p>
                <select name="hvsfw_border_style" id="hvsfw_border_style">
                    <?php foreach ( Helper::get_border_style_choices() as $value ): ?>
                        <option value="<?php echo $value['value']; ?>" <?php selected( $settings['border_style'], $value['value'] ); ?>>
                            <?php echo $value['label']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="text" name="hvsfw_border_width" id="hvsfw_border_width" placeholder="1px" value="<?php echo esc_attr( $settings['border_width'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The border of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_border_radius" data-visible="<?php echo $field_visibility['border_radius']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Border Radius</label>
    </th>
    <td>
        <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="<?php echo esc_attr( $settings['border_radius'] ); ?>">
        <p class="description">The border radius of this variation swatch attribute.</p>
    </td>
</tr>