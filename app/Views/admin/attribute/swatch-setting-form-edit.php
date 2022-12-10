<?php
/**
 * Views > Admin > Attribute > Swatch Setting Form Edit.
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

$setting = $args['setting'];
$setting['type']                   = ( isset( $setting['type'] ) ? $setting['type'] : 'button' );
$setting['style']                  = ( isset( $setting['style'] ) ? $setting['style'] : 'default' );
$setting['shape']                  = ( isset( $setting['shape'] ) ? $setting['shape'] : 'square' );
$setting['size']                   = ( isset( $setting['size'] ) ? $setting['size'] : '40px' );
$setting['width']                  = ( isset( $setting['width'] ) ? $setting['width'] : '40px' );
$setting['height']                 = ( isset( $setting['height'] ) ? $setting['height'] : '40px' );
$setting['font_size']              = ( isset( $setting['font_size'] ) ? $setting['font_size'] : '14px' );
$setting['font_weight']            = ( isset( $setting['font_weight'] ) ? $setting['font_weight'] : '500' );
$setting['font_color']             = ( isset( $setting['font_color'] ) ? $setting['font_color'] : '#000000' );
$setting['font_hover_color']       = ( isset( $setting['font_hover_color'] ) ? $setting['font_hover_color'] : '#0071f2' );
$setting['background_color']       = ( isset( $setting['background_color'] ) ? $setting['background_color'] : '#ffffff' );
$setting['background_hover_color'] = ( isset( $setting['background_hover_color'] ) ? $setting['background_hover_color'] : '#ffffff' );
$setting['padding_top']            = ( isset( $setting['padding_top'] ) ? $setting['padding_top'] : '5px' );
$setting['padding_bottom']         = ( isset( $setting['padding_bottom'] ) ? $setting['padding_bottom'] : '5px' );
$setting['padding_left']           = ( isset( $setting['padding_left'] ) ? $setting['padding_left'] : '5px' );
$setting['padding_right']          = ( isset( $setting['padding_right'] ) ? $setting['padding_right'] : '5px' );
$setting['border_style']           = ( isset( $setting['border_style'] ) ? $setting['border_style'] : 'solid' );
$setting['border_width']           = ( isset( $setting['border_width'] ) ? $setting['border_width'] : '1px' );
$setting['border_color']           = ( isset( $setting['border_color'] ) ? $setting['border_color'] : '#000000' );
$setting['border_hover_color']     = ( isset( $setting['border_hover_color'] ) ? $setting['border_hover_color'] : '#0071f2' );
$setting['padding_right']          = ( isset( $setting['padding_right'] ) ? $setting['padding_right'] : '5px' );
$setting['padding_right']          = ( isset( $setting['padding_right'] ) ? $setting['padding_right'] : '5px' );
$setting['border_radius']          = ( isset( $setting['border_radius'] ) ? $setting['border_radius'] : '0px' );

// Setting each group field state.
$state = [
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

if ( $setting['style'] === 'custom' ) {
    $is_color_image = in_array( $setting['type'], [ 'color', 'image' ] );

    // Shape, Border.
    $state['shape']  = 'show';
    $state['border'] = 'show';

    // Size.
    if ( $setting['shape'] === 'custom' && $is_color_image ) {
        $state['size'] = 'show';
    }

    // Dimension.
    $state['dimension'] = 'show';
    if ( $setting['shape'] !== 'custom' && $is_color_image ) {
        $state['dimension'] = 'hide';
    }

    // Font, Text Color, Background Color, Padding.
    if ( $setting['type'] === 'button' ) {
        $state['font']             = 'show';
        $state['text_color']       = 'show';
        $state['background_color'] = 'show';
        $state['padding']          = 'show';
    }

    // Border Radius.
    if ( $setting['shape'] === 'custom' ) {
        $state['border_radius'] = 'show';
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
            <option value="button" <?php selected( $setting['type'], 'button' ); ?>>Button</option>
            <option value="color" <?php selected( $setting['type'], 'color' ); ?>>Color</option>
            <option value="image" <?php selected( $setting['type'], 'image' ); ?>>Image</option>
        </select>
        <p class="description">Select your preferred representation of this variation swatch attribute in the front-end.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="style" data-state="show">
    <th scope="row" valign="top">
        <label for="hvsfw_style">Style (Design)</label>
    </th>
    <td>
        <select name="hvsfw_style" id="hvsfw_style">
            <option value="default" <?php selected( $setting['style'], 'default' ); ?>>Default</option>
            <option value="custom" <?php selected( $setting['style'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="shape" data-state="<?php echo $state['shape']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_shape">Shape</label>
    </th>
    <td>
        <select name="hvsfw_shape" id="hvsfw_shape">
            <option value="square" <?php selected( $setting['shape'], 'square' ); ?>>Square</option>
            <option value="circle" <?php selected( $setting['shape'], 'circle' ); ?>>Circle</option>
            <option value="custom" <?php selected( $setting['shape'], 'custom' ); ?>>Custom</option>
        </select>
        <p class="description">Select your preferred shape of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="size" data-state="<?php echo $state['size']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Size</label>
    </th>
    <td>
        <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="<?php echo esc_attr( $setting['size'] ); ?>">
        <p class="description">The size or width & height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="dimension" data-state="<?php echo $state['dimension']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_width">Size</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="text" name="hvsfw_width" id="hvsfw_width" placeholder="40px" value="<?php echo esc_attr( $setting['width'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Height</p>
                <input type="text" name="hvsfw_height" id="hvsfw_height" placeholder="40px" value="<?php echo esc_attr( $setting['height'] ); ?>">
            </div>
        </div>
        <p class="description">The width and height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="font" data-state="<?php echo $state['font']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_font_size">Font</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Size</p>
                <input type="text" name="hvsfw_font_size" id="hvsfw_font_size" placeholder="14px" value="<?php echo esc_attr( $setting['font_size'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Weight</p>
                <select name="hvsfw_font_weight" id="hvsfw_font_weight">
                    <option value="100" <?php selected( $setting['font_weight'], '100' ); ?>>100</option>
                    <option value="200" <?php selected( $setting['font_weight'], '200' ); ?>>200</option>
                    <option value="300" <?php selected( $setting['font_weight'], '300' ); ?>>300</option>
                    <option value="400" <?php selected( $setting['font_weight'], '400' ); ?>>400</option>
                    <option value="500" <?php selected( $setting['font_weight'], '500' ); ?>>500</option>
                    <option value="600" <?php selected( $setting['font_weight'], '600' ); ?>>600</option>
                    <option value="700" <?php selected( $setting['font_weight'], '700' ); ?>>700</option>
                    <option value="800" <?php selected( $setting['font_weight'], '800' ); ?>>800</option>
                    <option value="900" <?php selected( $setting['font_weight'], '900' ); ?>>900</option>
                </select>
            </div>
        </div>
        <p class="description">The font size and weight of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="textColor" data-state="<?php echo $state['text_color']; ?>">
    <th scope="row" valign="top">
        <label>Text Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['font_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['font_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The text color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="backgroundColor" data-state="<?php echo $state['background_color']; ?>">
    <th scope="row" valign="top">
        <label>Background Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_bg_color" id="hvsfw_bg_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['background_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_bg_hover_color" id="hvsfw_bg_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['background_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The background color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="padding" data-state="<?php echo $state['padding']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_padding_top">Padding</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Top</p>
                <input type="text" name="hvsfw_padding_top" id="hvsfw_padding_top" placeholder="5px" value="<?php echo esc_attr( $setting['padding_top'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Bottom</p>
                <input type="text" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" placeholder="5px" value="<?php echo esc_attr( $setting['padding_bottom'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Left</p>
                <input type="text" name="hvsfw_padding_left" id="hvsfw_padding_left" placeholder="5px" value="<?php echo esc_attr( $setting['padding_left'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Right</p>
                <input type="text" name="hvsfw_padding_right" id="hvsfw_padding_right" placeholder="5px" value="<?php echo esc_attr( $setting['padding_right'] ); ?>">
            </div>
        </div>
        <p class="description">The padding of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="border" data-state="<?php echo $state['border']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_border_style">Border</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Style</p>
                <select name="hvsfw_border_style" id="hvsfw_border_style">
                    <option value="dotted" <?php selected( $setting['border_style'], 'dotted' ); ?>>Dotted</option>
                    <option value="dashed" <?php selected( $setting['border_style'], 'dashed' ); ?>>Dashed</option>
                    <option value="solid" <?php selected( $setting['border_style'], 'solid' ); ?>>Solid</option>
                    <option value="double" <?php selected( $setting['border_style'], 'double' ); ?>>Double</option>
                    <option value="groove" <?php selected( $setting['border_style'], 'groove' ); ?>>Groove</option>
                    <option value="ridge" <?php selected( $setting['border_style'], 'ridge' ); ?>>Ridge</option>
                    <option value="inset" <?php selected( $setting['border_style'], 'inset' ); ?>>Inset</option>
                    <option value="outset" <?php selected( $setting['border_style'], 'outset' ); ?>>Outset</option>
                    <option value="none" <?php selected( $setting['border_style'], 'none' ); ?>>None</option>
                    <option value="hidden" <?php selected( $setting['border_style'], 'hidden' ); ?>>Hidden</option>
                </select>
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="text" name="hvsfw_border_width" id="hvsfw_border_width" placeholder="1px" value="<?php echo esc_attr( $setting['border_width'] ); ?>">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['border_color'] ); ?>">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="<?php echo esc_attr( $setting['border_hover_color'] ); ?>">
            </div>
        </div>
        <p class="description">The border of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="borderRadius" data-state="<?php echo $state['border_radius']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Border Radius</label>
    </th>
    <td>
        <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="<?php echo esc_attr( $setting['border_radius'] ); ?>">
        <p class="description">The border radius of this variation swatch attribute.</p>
    </td>
</tr>