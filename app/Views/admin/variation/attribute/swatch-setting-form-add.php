<?php
/**
 * App > Views > Admin > Variation > Attribute > Swatch Setting Form Add.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;
?>
<hr>
<h2>
    <?php echo __( 'Variation Swatch Settings', 'handy-variation-swatches' ); ?>
</h2>
<p class="description">
    <?php echo __( 'Configure the settings for this variation swatch attribute. For more additional configuration, click ', 'handy-variation-swatches' ); ?>
    <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>" aria-label="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>">
        <?php echo __( 'here', 'handy-variation-swatches' ); ?>
    </a>
</p>
<div id="hvsfw-form-field-style" class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_style" data-visible="no">
    <label for="hvsfw_style">
        <?php echo __( 'Style (Design)', 'handy-variation-swatches' ); ?>
    </label>
    <select name="hvsfw_style" id="hvsfw_style" data-prefix="hvsfw">
        <option value="default">
            <?php echo __( 'Default', 'handy-variation-swatches' ); ?>
        </option>
        <option value="custom">
            <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
        </option>
    </select>
    <p class="description">
        <?php echo __( 'Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_shape" data-visible="no">
    <label for="hvsfw_shape">
        <?php echo __( 'Shape', 'handy-variation-swatches' ); ?>
    </label>
    <select name="hvsfw_shape" id="hvsfw_shape" data-prefix="hvsfw">
        <option value="square">
            <?php echo __( 'Square', 'handy-variation-swatches' ); ?>
        </option>
        <option value="circle">
            <?php echo __( 'Circle', 'handy-variation-swatches' ); ?>
        </option>
        <option value="custom">
            <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
        </option>
    </select>
    <p class="description">
        <?php echo __( 'Select your preferred shape of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_size" data-visible="no">
    <label for="hvsfw_size">
        <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
    </label>
    <input type="text" name="hvsfw_size" id="hvsfw_size" placeholder="40px" value="40px">
    <p class="description">
        <?php echo __( 'The size or width & height of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_dimension" data-visible="no">
    <label for="hvsfw_width">
        <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_width" id="hvsfw_width" placeholder="40px" value="40px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Height', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_height" id="hvsfw_height" placeholder="40px" value="40px">
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The width and height of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_font" data-visible="no">
    <label for="hvsfw_font_size">
        <?php echo __( 'Font', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_font_size" id="hvsfw_font_size" placeholder="14px" value="14px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Weight', 'handy-variation-swatches' ); ?>
            </p>
            <select name="hvsfw_font_weight" id="hvsfw_font_weight">
                <?php foreach ( Helper::get_font_weight_choices() as $value ) : ?>
                    <option value="<?php echo $value['value']; ?>">
                        <?php echo $value['label']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The font size and weight of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_text_color" data-visible="no">
    <label>
        <?php echo __( 'Text Color', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_font_color" id="hvsfw_font_color" class="hvsfw-color-picker" value="#000000">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_font_hover_color" id="hvsfw_font_hover_color" class="hvsfw-color-picker" value="#0071f2">
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The text color of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_background_color" data-visible="no">
    <label>
        <?php echo __( 'Background Color', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_background_color" id="hvsfw_background_color" class="hvsfw-color-picker" value="#ffffff">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_background_hover_color" id="hvsfw_background_hover_color" class="hvsfw-color-picker" value="#ffffff">
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The background color of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_padding" data-visible="no">
    <label for="hvsfw_padding_top">
        <?php echo __( 'Padding', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Top', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_padding_top" id="hvsfw_padding_top" placeholder="5px" value="5px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Bottom', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_padding_bottom" id="hvsfw_padding_bottom" placeholder="5px" value="5px">
        </div>
    </div>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Left', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_padding_left" id="hvsfw_padding_left" placeholder="5px" value="5px">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Right', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_padding_right" id="hvsfw_padding_right" placeholder="5px" value="5px">
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The padding of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_border" data-visible="no">
    <label for="hvsfw_border_style">
        <?php echo __( 'Border', 'handy-variation-swatches' ); ?>
    </label>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Style', 'handy-variation-swatches' ); ?>
            </p>
            <select name="hvsfw_border_style" id="hvsfw_border_style">
                <?php foreach ( Helper::get_border_style_choices() as $value ) : ?>
                    <option value="<?php echo $value['value']; ?>">
                        <?php echo $value['label']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
            </p>
            <input type="text" name="hvsfw_border_width" id="hvsfw_border_width" placeholder="1px" value="1px">
        </div>
    </div>
    <div class="hvsfw-field__two-col">
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_border_color" id="hvsfw_border_color" class="hvsfw-color-picker" value="#000000">
        </div>
        <div class="hvsfw-field__col">
            <p class="description">
                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
            </p>
            <input type="hidden" name="hvsfw_border_hover_color" id="hvsfw_border_hover_color" class="hvsfw-color-picker" value="#0071f2">
        </div>
    </div>
    <p class="description">
        <?php echo __( 'The border of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
<div class="form-field hvsfw-field hvsfw-field__add" data-group-field="hvsfw_border_radius" data-visible="no">
    <label for="hvsfw_size">
        <?php echo __( 'Border Radius', 'handy-variation-swatches' ); ?>
    </label>
    <input type="text" name="hvsfw_border_radius" id="hvsfw_border_radius" placeholder="0px" value="0px">
    <p class="description">
        <?php echo __( 'The border radius of this variation swatch attribute.', 'handy-variation-swatches' ); ?>
    </p>
</div>
