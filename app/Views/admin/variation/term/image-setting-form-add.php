<?php
/**
 * Views > Admin > Variation > Term > Image Setting Form Add.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

$placeholder = Helper::get_product_thumbnail_placeholer_src();
?>

<hr/>
<h2>Image Swatch.</h2>
<p class="description">Select the image for this image swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div class="form-field">
	<label>Image</label>
	<div id="hvsfw-image-picker" class="hvsfw-image-picker">
		<div class="hvsfw-image-picker__previewer">
			<img id="hvsfw-image-picker-img" class="hvsfw-image-picker__img" src="<?php echo esc_url( $placeholder ); ?>" data-default="<?php echo esc_url( $placeholder ); ?>" alt="WooCommerce Placeholder" title="WooCommerce Placeholder">
		</div>
		<input type="hidden" id="hvsfw-image-picker-input" name="hvsfw_image" value="0">
		<div class="hvsfw-image-picker__control">
			<div class="hvsfw-col__left">
				<button type="button" id="hvsfw-js-image-picker-select-btn" class="button button-primary" data-state="default">Upload</button>
			</div>
			<div class="hvsfw-col__right">
				<button type="button" id="hvsfw-js-image-picker-remove-btn" class="button" data-state="disabled">Remove</button>
			</div>
		</div>
	</div>
</div>
<hr/>