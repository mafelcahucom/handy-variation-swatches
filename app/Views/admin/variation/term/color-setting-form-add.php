<?php
/**
 * Views > Admin > Variation > Term > Color Setting Form Add.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;
?>

<hr/>
<h2>Color Swatch.</h2>
<p class="description">Configure the colors for this color swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div class="form-field">
	<label>Colors</label>
	<div id="hvsfw-color-picker" class="hvsfw-color-picker" data-page="add" data-count="1">
		<div class="hvsfw-color-picker__list">
			<div class="hvsfw-color-picker__item">
				<div class="hvsfw-col__left">
					<input type="hidden" name="hvsfw_colors[]" class="hvsfw-color-picker__input" value="#ffffff">
				</div>
				<div class="hvsfw-col__right">
					<button type="button" class="hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button">Delete</button>
				</div>
			</div>
		</div>
		<button type="button" class="hvsfw-js-color-picker-add-btn button">Add More</button>
	</div>
</div>
<hr/>