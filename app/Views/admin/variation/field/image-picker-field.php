<?php
/**
 * Views > Admin > Variation > Field > Image Picker Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'id'			   => (string) 	Contains the id of the image input.
 *     'name'		   => (string)  Contains the name of the image input.
 *     'term_id'	   => (integer) Contains the id of the term.
 *     'attachment_id' => (integer) Contains the id of the attachment.
 * ]
 **/

if ( ! isset( $args['id'] ) || ! isset( $args['name'] ) ) {
	return;
}

$image 		   = [];
$attachment_id = 0;
$placeholder   = Utility::get_product_thumbnail_placeholder_src();

if ( isset( $args['term_id'] ) ) {
	$image 		   = Utility::get_swatch_image_by_term_id( $args['term_id'] );
	$attachment_id = Utility::get_swatch_image( $args['term_id'] );
}

if ( isset( $args['attachment_id'] ) ) {
	$image 		   = Utility::get_swatch_image_by_attachment_id( $args['attachment_id'] );
	$attachment_id = $args['attachment_id'];
}

$remove_state = ( $attachment_id === 0 ? 'disabled' : 'default' );
?>

<div id="<?php echo esc_attr( $args['id'] ); ?>" class="hvsfw-image-picker">
	<div class="hvsfw-image-picker__previewer">
        <img class="hvsfw-image-picker__img" src="<?php echo esc_url( $image['src'] ); ?>" data-default="<?php echo esc_url( $placeholder ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>">
    </div>
	<input type="hidden" id="<?php echo esc_attr( $args['name'] ); ?>" class="hvsfw-image-picker-input" name="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo esc_attr( $attachment_id ); ?>">
	<div class="hvsfw-image-picker__control">
		<div class="hvsfw-col__left">
			<button type="button" class="hvsfw-js-image-picker-select-btn button button-primary" data-state="default">
				<?php echo __( 'Upload', HVSFW_PLUGIN_DOMAIN ); ?>
			</button>
		</div>
		<div class="hvsfw-col__right">
			<button type="button" class="hvsfw-js-image-picker-remove-btn button" data-state="<?php echo $remove_state; ?>">
				<?php echo __( 'Remove', HVSFW_PLUGIN_DOMAIN ); ?>
			</button>
		</div>
	</div>
</div>