<?php
/**
 * Views > Admin > Variation > Term > Preview > Image Swatch.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'term_id' => (integer) The term ID of the current term editing.
 * ]
 **/

if ( ! isset( $args['term_id'] ) ) {
    return;
}

$image         = Helper::get_swatch_image( $args['term_id'] );
?>

<div class="hvsfw-preview hvsfw-preview__image">
    <img class="hvsfw-preview__image__img" src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_url( $image['alt'] ); ?>" title="<?php echo esc_url( $image['title'] ); ?>">
</div>