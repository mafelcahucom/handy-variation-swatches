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
 *     'value'   => (array) The value of the attribute configurations from _hsvfw_attribute.
 *     'default' => (array) The default value for the attribute fields.
 * ]
 **/

if ( ! isset( $args['value'] ) || ! isset( $args['default'] ) ) {
    return;
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
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="type">
    <th scope="row" valign="top">
        <label for="hvsfw_type">Swatch Type</label>
    </th>
    <td>
        <select name="hvsfw_type" id="hvsfw_type">
            <option value="button">Button</option>
            <option value="color">Color</option>
            <option value="image">Image</option>
        </select>
        <p class="description">Select your preferred representation of this variation swatch attribute in the front-end.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="style">
    <th scope="row" valign="top">
        <label for="hvsfw_style">Style (Design)</label>
    </th>
    <td>
        <select name="hvsfw_style" id="hvsfw_style">
            <option value="default">Default</option>
            <option value="custom">Custom</option>
        </select>
        <p class="description">Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="shape">
    <th scope="row" valign="top">
        <label for="hvsfw_shape">Shape</label>
    </th>
    <td>
        <select name="hvsfw_shape" id="hvsfw_shape">
            <option value="square">Square</option>
            <option value="circle">Circle</option>
            <option value="custom">Custom</option>
        </select>
        <p class="description">Select your preferred shape of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="size">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Size</label>
    </th>
    <td>
        <input type="number" name="hvsfw_size" id="hvsfw_size" min="0" placeholder="40">
        <p class="description">The size or width & height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="dimension">
    <th scope="row" valign="top">
        <label for="hvsfw_width">Size</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="number" name="hvsfw_width" id="hvsfw_width" min="0" placeholder="40">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Height</p>
                <input type="number" name="hvsfw_height" id="hvsfw_height" min="0" placeholder="40">
            </div>
        </div>
        <p class="description">The width and height of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="font">
    <th scope="row" valign="top">
        <label for="hvsfw_font_size">Font</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Size</p>
                <input type="number" name="hvsfw_font_size" id="hvsfw_font_size" min="0" placeholder="14">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Weight</p>
                <select name="hvsfw_font_weight" id="hvsfw_font_weight">
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                    <option value="600">600</option>
                    <option value="700">700</option>
                    <option value="800">800</option>
                    <option value="900">900</option>
                </select>
            </div>
        </div>
        <p class="description">The font size and weight of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="text-color">
    <th scope="row" valign="top">
        <label>Text Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="#bada55">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="#bada55">
            </div>
        </div>
        <p class="description">The text color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="background-color">
    <th scope="row" valign="top">
        <label>Background Color</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_bg_color" id="hvsfw_bg_color" class="hvsfw-color-picker" value="#bada55">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_bg_hover_color" id="hvsfw_bg_hover_color" class="hvsfw-color-picker" value="#bada55">
            </div>
        </div>
        <p class="description">The background color of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="padding">
    <th scope="row" valign="top">
        <label for="hvsfw_padding_top">Padding</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Top</p>
                <input type="number" name="hvsfw_padding_top" id="hvsfw_padding_top" min="0" placeholder="5">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Bottom</p>
                <input type="number" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" min="0" placeholder="5">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Left</p>
                <input type="number" name="hvsfw_padding_left" id="hvsfw_padding_left" min="0" placeholder="5">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Right</p>
                <input type="number" name="hvsfw_padding_right" id="hvsfw_padding_right" min="0" placeholder="5">
            </div>
        </div>
        <p class="description">The padding of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="border">
    <th scope="row" valign="top">
        <label for="hvsfw_border_style">Border</label>
    </th>
    <td>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Style</p>
                <select name="hvsfw_border_style" id="hvsfw_border_style">
                    <option value="dotted">Dotted</option>
                    <option value="dashed">Dashed</option>
                    <option value="solid">Solid</option>
                    <option value="double">Double</option>
                    <option value="groove">Groove</option>
                    <option value="ridge">Ridge</option>
                    <option value="inset">Inset</option>
                    <option value="outset">Outset</option>
                    <option value="none">None</option>
                    <option value="hidden">Hidden</option>
                </select>
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Width</p>
                <input type="number" name="hvsfw_border_width" id="hvsfw_border_width" min="0" placeholder="1">
            </div>
        </div>
        <div class="hvsfw-field__two-col">
            <div class="hvsfw-field__col">
                <p class="description">Color</p>
                <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="#bada55">
            </div>
            <div class="hvsfw-field__col">
                <p class="description">Active Color</p>
                <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="#bada55">
            </div>
        </div>
        <p class="description">The border of this variation swatch attribute.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__edit" data-field="border-radius">
    <th scope="row" valign="top">
        <label for="hvsfw_size">Border Radius</label>
    </th>
    <td>
        <input type="number" name="hvsfw_border_radius" id="hvsfw_border_radius" min="0" placeholder="0">
        <p class="description">The border radius of this variation swatch attribute.</p>
    </td>
</tr>