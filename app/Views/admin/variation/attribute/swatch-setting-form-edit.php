<?php
/**
 * Views > Admin > Variation > Attribute > Swatch Setting Form Edit.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

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

// Setting each group field state.
$states = [
    'style'            => 'hide',
    'shape'            => 'hide',
    'size'             => 'hide',
    'dimension'        => 'hide',
    'font'             => 'hide',
    'text_color'       => 'hide',
    'background_color' => 'hide',
    'padding'          => 'hide',
    'border'           => 'hide',
    'border_radius'    => 'hide'
];

// Style.
if ( $settings['type'] !== 'select' ) {
    $states['style'] = 'show';
}

if ( $settings['style'] === 'custom' ) {
    $is_color_image = in_array( $settings['type'], [ 'color', 'image' ] );

    // Shape, Border.
    $states['shape']  = 'show';
    $states['border'] = 'show';

    // Size.
    if ( $is_color_image && $settings['shape'] !== 'custom' ) {
        $states['size'] = 'show';
    }

    // Dimension.
    $states['dimension'] = 'show';
    if ( $is_color_image && $settings['shape'] !== 'custom' ) {
        $states['dimension'] = 'hide';
    }

    // Font, Text Color, Background Color, Padding.
    if ( $settings['type'] === 'button' ) {
        $states['font']             = 'show';
        $states['text_color']       = 'show';
        $states['background_color'] = 'show';
        $states['padding']          = 'show';
    }

    // Border Radius.
    if ( $settings['shape'] === 'custom' ) {
        $states['border_radius'] = 'show';
    }
}
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="hvsfw_type">Variation Swatch Settings</label>
    </th>
    <td>
        <p class="description">Configure the settings for this variation swatch attribute. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>">here</a>.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="type" data-state="show">
    <th scope="row" valign="top">
        <label for="hvsfw_type">Swatch Type</label>
    </th>
    <td>
        <select name="hvsfw_type" id="hvsfw_type">
            <option value="select" <?php selected( $settings['type'], 'select' ); ?>>Select</option>
            <option value="button" <?php selected( $settings['type'], 'button' ); ?>>Button</option>
            <option value="color" <?php selected( $settings['type'], 'color' ); ?>>Color</option>
            <option value="image" <?php selected( $settings['type'], 'image' ); ?>>Image</option>
        </select>
        <p class="description">Select your preferred representation of this variation swatch attribute in the front-end.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="style" data-state="<?php echo $states['style']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_style">Style (Design)</label>
    </th>
    <td>
        <select name="hvsfw_style" id="hvsfw_style">
            <option value="default" <?php selected( $settings['style'], 'default' ); ?>>Default</option>
            <option value="custom" <?php selected( $settings['style'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="shape" data-state="<?php echo $states['shape']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_shape">Shape</label>
    </th>
    <td>
        <select name="hvsfw_shape" id="hvsfw_shape">
            <option value="square" <?php selected( $settings['shape'], 'square' ); ?>>Square</option>
            <option value="circle" <?php selected( $settings['shape'], 'circle' ); ?>>Circle</option>
            <option value="custom" <?php selected( $settings['shape'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select your preferred shape of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="size" data-state="<?php echo $states['size']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Size</label>
    </th>
    <td>
        <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="<?php echo esc_attr( $settings['size'] ); ?>">
        <p class="description">The size or width & height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="dimension" data-state="<?php echo $states['dimension']; ?>">
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
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="font" data-state="<?php echo $states['font']; ?>">
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
                    <option value="100" <?php selected( $settings['font_weight'], '100' ); ?>>100</option>
                    <option value="200" <?php selected( $settings['font_weight'], '200' ); ?>>200</option>
                    <option value="300" <?php selected( $settings['font_weight'], '300' ); ?>>300</option>
                    <option value="400" <?php selected( $settings['font_weight'], '400' ); ?>>400</option>
                    <option value="500" <?php selected( $settings['font_weight'], '500' ); ?>>500</option>
                    <option value="600" <?php selected( $settings['font_weight'], '600' ); ?>>600</option>
                    <option value="700" <?php selected( $settings['font_weight'], '700' ); ?>>700</option>
                    <option value="800" <?php selected( $settings['font_weight'], '800' ); ?>>800</option>
                    <option value="900" <?php selected( $settings['font_weight'], '900' ); ?>>900</option>
                </select>
            </div>
        </div>
        <p class="description">The font size and weight of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="textColor" data-state="<?php echo $states['text_color']; ?>">
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
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="backgroundColor" data-state="<?php echo $states['background_color']; ?>">
    <th scope="row" valign="top">
        <label>Background Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_bg_color" id="hvsfw_bg_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_bg_hover_color" id="hvsfw_bg_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The background color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="padding" data-state="<?php echo $states['padding']; ?>">
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
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="border" data-state="<?php echo $states['border']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_border_style">Border</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Style</p>
                <select name="hvsfw_border_style" id="hvsfw_border_style">
                    <option value="dotted" <?php selected( $settings['border_style'], 'dotted' ); ?>>Dotted</option>
                    <option value="dashed" <?php selected( $settings['border_style'], 'dashed' ); ?>>Dashed</option>
                    <option value="solid" <?php selected( $settings['border_style'], 'solid' ); ?>>Solid</option>
                    <option value="double" <?php selected( $settings['border_style'], 'double' ); ?>>Double</option>
                    <option value="groove" <?php selected( $settings['border_style'], 'groove' ); ?>>Groove</option>
                    <option value="ridge" <?php selected( $settings['border_style'], 'ridge' ); ?>>Ridge</option>
                    <option value="inset" <?php selected( $settings['border_style'], 'inset' ); ?>>Inset</option>
                    <option value="outset" <?php selected( $settings['border_style'], 'outset' ); ?>>Outset</option>
                    <option value="none" <?php selected( $settings['border_style'], 'none' ); ?>>None</option>
                    <option value="hidden" <?php selected( $settings['border_style'], 'hidden' ); ?>>Hidden</option>
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
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="borderRadius" data-state="<?php echo $states['border_radius']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Border Radius</label>
    </th>
    <td>
        <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="<?php echo esc_attr( $settings['border_radius'] ); ?>">
        <p class="description">The border radius of this variation swatch attribute.</p>
    </td>
</tr>