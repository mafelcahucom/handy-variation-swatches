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
 *     'type' => (string) Contains the attribute swatch type.
 * ]
 **/

if ( ! isset( $args['type'] ) ) {
	return;
}

$placeholder = Utility::get_product_thumbnail_placeholder_src();
?>

<?php if ( ! in_array( $args['type'], [ 'color', 'image' ] ) ): ?>
	<hr/>
<?php endif; ?>

<?php if ( $args['type'] === 'button' ): ?>
	<h2>
		<?php echo __( 'Button Swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
	</h2>
	<p class="description">
		<?php echo __( 'Configure the settings for this button swatch. For more additional configuration, click ', HVSFW_PLUGIN_DOMAIN ); ?>
		<a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>" aria-label="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>">
			<?php echo __( 'here', HVSFW_PLUGIN_DOMAIN ); ?>
		</a>
	</p>
<?php endif; ?>

<div class="form-field hvsfw-field" data-group-field="hvsfw-tooltip-add_type">
	<label for="hvsfw-tooltip-add_type">
		<?php echo __( 'Tooltip', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<select name="hvsfw_tooltip_type" id="hvsfw-tooltip-add_type" class="hvsfw-tooltip-field-type" data-prefix="hvsfw-tooltip-add">
		<option value="none">
			<?php echo __( 'None', HVSFW_PLUGIN_DOMAIN ); ?>
		</option>
		<option value="text">
			<?php echo __( 'Text', HVSFW_PLUGIN_DOMAIN ); ?>
		</option>
		<option value="html">
			<?php echo __( 'HTML', HVSFW_PLUGIN_DOMAIN ); ?>
		</option>
		<option value="image">
			<?php echo __( 'Image', HVSFW_PLUGIN_DOMAIN ); ?>
		</option>
	</select>
	<p class="description">
		<?php echo __( 'Select your preferred tooltip content type.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-add_content_text" data-visible="no">
	<label for="hvsfw-tooltip-add_content_text">
		<?php echo __( 'Tooltip Content (Text)', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<input type="text" name="hvsfw_tooltip_text" id="hvsfw-tooltip-add_content_text" value="">
	<p class="description">
		<?php echo __( 'Write the tooltip text content. Term name is the default value.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-add_content_html" data-visible="no">
	<label for="hvsfw-tooltip-add_content_html">
		<?php echo __( 'Tooltip Content (HTML)', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<textarea name="hvsfw_tooltip_html" id="hvsfw-tooltip-add_content_html" rows="5"></textarea>
	<p class="description">
		<?php echo __( 'Write the tooltip html markup content. Term name is the default value.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>
<div class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-add_content_image" data-visible="no">
	<label for="hvsfw-tooltip-add_content_image">
		<?php echo __( 'Tooltip Content (Image)', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<?php
		echo Helper::render_view( 'variation/field/image-picker-field', [
			'id'   			=> 'hvsfw-tooltip-add_content_image',
			'name' 			=> 'hvsfw_tooltip_image',
			'attachment_id' => 0 
		]);
	?>
	<p class="description">
		<?php echo __( 'Select the image for the tooltip image content. Term name is the default value.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>
<hr/>