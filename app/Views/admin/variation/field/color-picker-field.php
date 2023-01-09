<?php
/**
 * Views > Admin > Variation > Field > Color Picker Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'id'		 => (string)  The id of the image input.
 *     'name'	 => (string)  The name of the image input.
 *     'term_id' => (integer) The id of the term.
 *     'default' => (array)   The default colors.
 * ]
 **/

if ( ! isset( $args['id'] ) || ! isset( $args['name'] ) ) {
	return;
}

$colors = [ '#ffffff' ];

if ( isset( $args['default'] ) ) {
	$colors = $args['default'];
}

if ( isset( $args['term_id'] ) ) {
	$colors = Utility::get_swatch_color( $args['term_id'] );
}
?>

<div id="<?php echo esc_attr( $args['id'] ); ?>" class="hvsfw-color-picker" data-count="<?php echo count( $colors ); ?>">
	<div class="hvsfw-color-picker__list">
		<?php foreach ( $colors as $color ): ?>
			<div class="hvsfw-color-picker__item">
				<div class="hvsfw-col__left">
					<input type="hidden" name="<?php echo esc_attr( $args['name'] ); ?>" class="hvsfw-color-picker__input" value="<?php echo esc_attr( $color ); ?>">
				</div>
				<div class="hvsfw-col__right">
					<button type="button" class="hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button">Delete</button>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<button type="button" class="hvsfw-js-color-picker-add-btn button">Add More</button>
</div>