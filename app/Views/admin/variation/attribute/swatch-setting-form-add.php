<?php
/**
 * Views > Admin > Variation > Attribute > Swatch Setting Form Add.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;
?>
<hr>
<h2>Variation Swatch Settings.</h2>
<p class="description">Configure the settings for this variation swatch attribute. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div id="hvsfw-form-field-style" class="form-field hvsfw-field hvsfw-field__add" data-field="style" data-state="hide">
    <label for="hvsfw_style">Style (Design)</label>
    <select name="hvsfw_style" id="hvsfw_style">
        <option value="default">Default</option>
        <option value="custom">Custom</option>
    </select>
    <p class="description">Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="shape" data-state="hide">
    <label for="hvsfw_shape">Shape</label>
    <select name="hvsfw_shape" id="hvsfw_shape">
        <option value="square">Square</option>
        <option value="circle">Circle</option>
        <option value="custom">Custom</option>
    </select>
    <p class="description">Select your preferred shape of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="size" data-state="hide">
    <label for="hvsfw_size">Size</label>
    <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="40px">
    <p class="description">The size or width & height of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="dimension" data-state="hide">
    <label for="hvsfw_width">Size</label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Width</p>
            <input type="text" name="hvsfw_width" id="hvsfw_width" placeholder="40px" value="40px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Height</p>
            <input type="text" name="hvsfw_height" id="hvsfw_height" placeholder="40px" value="40px">
        </div>
    </div>
    <p class="description">The width and height of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="font" data-state="hide">
    <label for="hvsfw_font_size">Font</label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Size</p>
            <input type="text" name="hvsfw_font_size" id="hvsfw_font_size" placeholder="14px" value="14px">
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
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="textColor" data-state="hide">
    <label>Text Color</label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Color</p>
            <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="#000000">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Active Color</p>
            <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="#0071f2">
        </div>
    </div>
    <p class="description">The text color of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="backgroundColor" data-state="hide">
    <label>Background Color</label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Color</p>
            <input type="hidden" name="hvsfw_background_color" id="hvsfw_background_color" class="hvsfw-color-picker" value="#ffffff">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Active Color</p>
            <input type="hidden" name="hvsfw_background_hover_color" id="hvsfw_background_hover_color" class="hvsfw-color-picker" value="#ffffff">
        </div>
    </div>
    <p class="description">The background color of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="padding" data-state="hide">
    <label for="hvsfw_padding_top">Padding</label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Top</p>
            <input type="text" name="hvsfw_padding_top" id="hvsfw_padding_top" placeholder="5px" value="5px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Bottom</p>
            <input type="text" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" placeholder="5px" value="5px">
        </div>
    </div>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Left</p>
            <input type="text" name="hvsfw_padding_left" id="hvsfw_padding_left" placeholder="5px" value="5px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Right</p>
            <input type="text" name="hvsfw_padding_right" id="hvsfw_padding_right" placeholder="5px" value="5px">
        </div>
    </div>
    <p class="description">The padding of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="border" data-state="hide">
    <label for="hvsfw_border_style">Border</label>
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
            <input type="text" name="hvsfw_border_width" id="hvsfw_border_width" placeholder="1px" value="1px">
        </div>
    </div>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">Color</p>
            <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="#000000">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">Active Color</p>
            <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="#0071f2">
        </div>
    </div>
    <p class="description">The border of this variation swatch attribute.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-field="borderRadius" data-state="hide">
    <label for="hvsfw_size">Border Radius</label>
    <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="0px">
    <p class="description">The border radius of this variation swatch attribute.</p>
</div>