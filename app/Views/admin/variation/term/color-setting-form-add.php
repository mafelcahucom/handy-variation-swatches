<?php
/**
 * App > Views > Admin > Variation > Term > Color Setting Form Add.
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

<hr/>
<h2>
	<?php echo __( 'Color Swatch.', 'handy-variation-swatches' ); ?>
</h2>
<p class="description">
	<?php echo __( 'Configure the settings for this color swatch. For more additional configuration, click ', 'handy-variation-swatches' ); ?>	
	<a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>" aria-label="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>">
		<?php echo __( 'here', 'handy-variation-swatches' ); ?>
	</a>
</p>
<div class="form-field">
	<label>
		<?php echo __( 'Colors', 'handy-variation-swatches' ); ?>
	</label>
	<?php
		echo Helper::render_view( 'variation/field/color-picker-field', array(
			'id'	  => 'hvsfw-color-picker-swatch',
			'name'	  => 'hvsfw_color_swatch[]',
			'default' => array( '#ffffff' ),
		));
	?>
	<p class="description">
		<?php echo __( 'Add colors as much as you want for this color swatch.', 'handy-variation-swatches' ); ?>
	</p>
</div>
