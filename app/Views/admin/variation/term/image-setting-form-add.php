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
<h2>
	<?php echo __( 'Image Swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
</h2>
<p class="description">
	<?php echo __( 'Configure the settings for this image swatch. For more additional configuration, click ', HVSFW_PLUGIN_DOMAIN ); ?>
	<a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>" aria-label="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>">
		<?php echo __( 'here', HVSFW_PLUGIN_DOMAIN ); ?>
	</a>
</p>
<div class="form-field">
	<label>
		<?php echo __( 'Image', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<?php
		echo Helper::render_view( 'variation/field/image-picker-field', [
			'id'   => 'hvsfw-image-picker-swatch',
			'name' => 'hvsfw_image_swatch',
			'attachment_id' => 0 
		]);
	?>
	<p class="description">
		<?php echo __( 'Select an image for this image swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>
<div class="form-field hvsfw-field">
	<label>
		<?php echo __( 'Image Size.', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<?php
		echo Helper::render_view( 'variation/field/image-size-selector-field', [
			'id'	  => 'hvsfw-image-size-swatch',
			'name'	  => 'hvsfw_image_size_swatch',
			'default' => 'thumbnail'
		]);
	?>
	<p class="description">
		<?php echo __( 'Select an image size for this image swatch to override the default image size.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>