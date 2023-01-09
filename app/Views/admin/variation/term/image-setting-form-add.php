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

Helper::get_image_sizes();
?>

<hr/>
<h2>Image Swatch.</h2>
<p class="description">Configure the settings for this image swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div class="form-field">
	<label>Image</label>
	<?php
		echo Helper::render_view( 'variation/field/image-picker-field', [
			'id'   => 'hvsfw-image-picker-swatch',
			'name' => 'hvsfw_image_swatch',
			'attachment_id' => 0 
		]);
	?>
	<p class="description">Select an image for this image swatch.</p>
</div>
<div class="form-field hvsfw-field">
	<label>Image Size</label>
	<?php
		echo Helper::render_view( 'variation/field/image-size-selector-field', [
			'id'	  => 'hvsfw-image-size-swatch',
			'name'	  => 'hvsfw_image_size_swatch',
			'default' => 'thumbnail'
		]);
	?>
	<p class="description">Select an image size for this image swatch to override the default image size.</p>
</div>