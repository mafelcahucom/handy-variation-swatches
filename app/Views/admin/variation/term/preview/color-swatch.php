<?php
/**
 * Views > Admin > Variation > Term > Preview > Color Swatch.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'term_id' => (integer) The term ID of the current term editing.
 * ]
 **/

if ( ! isset( $args['term_id'] ) ) {
    return;
}

$colors 	= get_term_meta( $args['term_id'], '_hvsfw_value', true );
$colors 	= ( ! empty( $colors ) && is_array( $colors ) ? $colors : [ '#ffffff' ] );
$cell_width = ( 100 / count( $colors ) ) . '%';
?>

<div class="hvsfw-preview hvsfw-preview__color">
	<?php foreach ( $colors as $color ): ?>
		<div class="hvsfw-preview__color__cell" style="width: <?php echo $cell_width; ?>; background-color: <?php echo esc_url( $color ); ?>;"></div>
	<?php endforeach; ?>
</div>