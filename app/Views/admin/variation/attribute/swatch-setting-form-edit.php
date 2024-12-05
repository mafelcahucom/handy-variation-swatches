<?php
/**
 * App > Views > Admin > Variation > Attribute > Swatch Setting Form Edit.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\SwatchHelper;

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'default' => (array) Contains the default value for the attribute fields.
 *     'setting' => (array) Contains the setting of the attribute configurations from _hsvfw_attribute.
 * ]
 */

if ( ! isset( $args['default'] ) || ! isset( $args['setting'] ) ) {
    return;
}

$defaults = $args['default'];
$settings = ( is_array( $args['setting'] ) ? $args['setting'] : array() );
foreach ( $defaults as $key => $default ) {
    $settings[ $key ] = ( isset( $settings[ $key ] ) ? $settings[ $key ] : $default );
}

// Set the group field visibility.
$field_visibility = SwatchHelper::get_swatch_setting_group_field_visibility( $settings );
?>
<tr class="form-field">
    <th scope="row" valign="top">
        <label for="hvsfw_type">
            <?php echo __( 'Variation Swatch Settings', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <p class="description">
            <?php echo __( 'Configure the settings for this variation swatch attribute. For more additional configuration, click ', 'handy-variation-swatches' ); ?>
            <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>">
                <?php echo __( 'here', 'handy-variation-swatches' ); ?>
            </a>
        </p>
    </td>
</tr>
<tr id="hvsfw-form-field-style" class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_style" data-visible="<?php echo $field_visibility['style']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_style">
            <?php echo __( 'Style (Design)', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <select name="hvsfw_style" id="hvsfw_style" data-prefix="hvsfw">
            <option value="default" <?php selected( $settings['style'], 'default' ); ?>>
                <?php echo __( 'Default', 'handy-variation-swatches' ); ?>
            </option>
            <option value="custom" <?php selected( $settings['style'], 'custom' ); ?>>
                <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
            </option>
        </select>
        <p class="description">
            <?php echo __( 'Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_shape" data-visible="<?php echo $field_visibility['shape']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_shape">
            <?php echo __( 'Shape', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <select name="hvsfw_shape" id="hvsfw_shape" data-prefix="hvsfw">
            <option value="square" <?php selected( $settings['shape'], 'square' ); ?>>
                <?php echo __( 'Square', 'handy-variation-swatches' ); ?>
            </option>
            <option value="circle" <?php selected( $settings['shape'], 'circle' ); ?>>
                <?php echo __( 'Circle', 'handy-variation-swatches' ); ?>
            </option>
            <option value="custom" <?php selected( $settings['shape'], 'custom' ); ?>>
                <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
            </option>
        </select>
        <p class="description">
            <?php echo __( 'Select your preferred shape of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_size" data-visible="<?php echo $field_visibility['size']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">
            <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="<?php echo esc_attr( $settings['size'] ); ?>">
        <p class="description">
            <?php echo __( 'The size or width & height of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_dimension" data-visible="<?php echo $field_visibility['dimension']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_width">
            <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_width" id="hvsfw_width" placeholder="40px" value="<?php echo esc_attr( $settings['width'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Height', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_height" id="hvsfw_height" placeholder="40px" value="<?php echo esc_attr( $settings['height'] ); ?>">
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The width and height of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_font" data-visible="<?php echo $field_visibility['font']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_font_size">
            <?php echo __( 'Font', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_font_size" id="hvsfw_font_size" placeholder="14px" value="<?php echo esc_attr( $settings['font_size'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Weight', 'handy-variation-swatches' ); ?>
                </p>
                <select name="hvsfw_font_weight" id="hvsfw_font_weight">
                    <?php foreach ( Helper::get_font_weight_choices() as $value ) : ?>
                        <option value="<?php echo $value['value']; ?>" <?php selected( $settings['font_weight'], $value['value'] ); ?>>
                            <?php echo $value['label']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The font size and weight of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_text_color" data-visible="<?php echo $field_visibility['text_color']; ?>">
    <th scope="row" valign="top">
        <label>
            <?php echo __( 'Text Color', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The text color of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_background_color" data-visible="<?php echo $field_visibility['background_color']; ?>">
    <th scope="row" valign="top">
        <label>
            <?php echo __( 'Background Color', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_background_color" id="hvsfw_background_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_background_hover_color" id="hvsfw_background_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The background color of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_padding" data-visible="<?php echo $field_visibility['padding']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_padding_top">
            <?php echo __( 'Padding', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Top', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_padding_top" id="hvsfw_padding_top" placeholder="5px" value="<?php echo esc_attr( $settings['padding_top'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Bottom', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" placeholder="5px" value="<?php echo esc_attr( $settings['padding_bottom'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Left', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_padding_left" id="hvsfw_padding_left" placeholder="5px" value="<?php echo esc_attr( $settings['padding_left'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Right', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_padding_right" id="hvsfw_padding_right" placeholder="5px" value="<?php echo esc_attr( $settings['padding_right'] ); ?>">
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The padding of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_border" data-visible="<?php echo $field_visibility['border']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_border_style">
            <?php echo __( 'Border', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Style', 'handy-variation-swatches' ); ?>
                </p>
                <select name="hvsfw_border_style" id="hvsfw_border_style">
                    <?php foreach ( Helper::get_border_style_choices() as $value ) : ?>
                        <option value="<?php echo $value['value']; ?>" <?php selected( $settings['border_style'], $value['value'] ); ?>>
                            <?php echo $value['label']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
                </p>
                <input type="text" name="hvsfw_border_width" id="hvsfw_border_width" placeholder="1px" value="<?php echo esc_attr( $settings['border_width'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">
                    <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                </p>
                <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">
            <?php echo __( 'The border of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-group-field="hvsfw_border_radius" data-visible="<?php echo $field_visibility['border_radius']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">
            <?php echo __( 'Border Radius', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="<?php echo esc_attr( $settings['border_radius'] ); ?>">
        <p class="description">
            <?php echo __( 'The border radius of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
