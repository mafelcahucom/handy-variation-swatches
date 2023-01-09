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
<p class="description">Configure the settings for this color swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
<div class="form-field">
	<label>Colors</label>
	<?php
		echo Helper::render_view( 'variation/field/color-picker-field', [
			'id'	  => 'hvsfw-color-picker-swatch',
			'name'	  => 'hvsfw_color_swatch[]',
			'default' => [ '#ffffff' ]
		]);
	?>
	<p class="description">Add colors as much as you want for this color swatch.</p>
</div>