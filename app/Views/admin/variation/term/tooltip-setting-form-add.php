<?php
/**
 * Views > Admin > Variation > Term > Tooltip Setting Form Add.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'type' => (string) The attribute swatch type.
 * ]
 **/

if ( ! isset( $args['type'] ) ) {
	return;
}

$placeholder = Utility::get_product_thumbnail_placeholer_src();
?>

<?php if ( ! in_array( $args['type'], [ 'color', 'image' ] ) ): ?>
	<hr/>
<?php endif; ?>

<?php if ( $args['type'] === 'button' ): ?>
	<h2>Button Swatch.</h2>
	<p class="description">Configure the settings for this button swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<?php endif; ?>

<div class="form-field hvsfw-field">
	<label for="hvsfw_tooltip_type">Tooltip</label>
	<select name="hvsfw_tooltip_type" id="hvsfw_tooltip_type">
		<option value="none">None</option>
		<option value="text">Text</option>
		<option value="html">HTML</option>
		<option value="image">Image</option>
	</select>
	<p class="description">Select your preferred tooltip content type.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-type="text" data-visible="no">
	<label for="hvsfw_tooltip_text">Tooltip Content (Text)</label>
	<input type="text" name="hvsfw_tooltip_text" id="hvsfw_tooltip_text" value="">
	<p class="description">Write the tooltip text content. Term name is the default value.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-type="html" data-visible="no">
	<label for="hvsfw_tooltip_html">Tooltip Content (HTML)</label>
	<textarea name="hvsfw_tooltip_html" id="hvsfw_tooltip_html" rows="5"></textarea>
	<p class="description">Write the tooltip html markup content. Term name is the default value.</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-type="image" data-visible="no">
	<label for="hvsfw_tooltip_image">Tooltip Content (Image)</label>
	<?php
		echo Helper::render_view( 'variation/field/image-picker-field', [
			'id'   => 'hvsfw-image-picker-tooltip',
			'name' => 'hvsfw_tooltip_image',
			'attachment_id' => 0 
		]);
	?>
	<p class="description">Select the image for the tooltip image content. Term name is the default value.</p>
</div>
<hr/>