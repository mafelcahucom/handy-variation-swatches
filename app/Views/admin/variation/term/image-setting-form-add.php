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
?>

<hr/>
<h2>Image Swatch.</h2>
<p class="description">Select the image for this image swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div class="form-field">
	<label>Image</label>
	<?php
		echo Helper::render_view( 'variation/field/image-picker-field', [
			'id'   => 'hvsfw-image-picker-swatch',
			'name' => 'hvsfw_image_swatch',
			'attachment_id' => 0 
		]);
	?>
</div>