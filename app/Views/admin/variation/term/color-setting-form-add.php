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
<h2>
	<?php echo __( 'Color Swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
</h2>
<p class="description">
	<?php echo __( 'Configure the settings for this color swatch. For more additional configuration, click ', HVSFW_PLUGIN_DOMAIN ); ?>	
	<a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>" aria-label="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>">
		<?php echo __( 'here', HVSFW_PLUGIN_DOMAIN ); ?>
	</a>
</p>
<div class="form-field">
	<label>
		<?php echo __( 'Colors', HVSFW_PLUGIN_DOMAIN ); ?>
	</label>
	<?php
		echo Helper::render_view( 'variation/field/color-picker-field', [
			'id'	  => 'hvsfw-color-picker-swatch',
			'name'	  => 'hvsfw_color_swatch[]',
			'default' => [ '#ffffff' ]
		]);
	?>
	<p class="description">
		<?php echo __( 'Add colors as much as you want for this color swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
	</p>
</div>