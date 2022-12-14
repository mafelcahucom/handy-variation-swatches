<?php
/**
 * Views > Admin > Variation > Term > Image Setting Form Edit.
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

$attachment_id = get_term_meta( $args['term_id'], '_hvsfw_value', true );
$attachment_id = ( ! empty( $attachment_id ) && ! is_array( $attachment_id ) ? $attachment_id : 0 );
$image         = Helper::get_swatch_image( $args['term_id'] );
$placeholder   = Helper::get_product_thumbnail_placeholer_src();
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label>Image Swatch</label>
    </th>
    <td>
        <div id="hvsfw-image-picker" class="hvsfw-image-picker">
            <div class="hvsfw-image-picker__previewer">
                <img id="hvsfw-image-picker-img" class="hvsfw-image-picker__img" src="<?php echo esc_url( $image['src'] ); ?>" data-default="<?php echo esc_url( $placeholder ); ?>" alt="<?php echo esc_url( $image['alt'] ); ?>" title="<?php echo esc_url( $image['title'] ); ?>">
            </div>
            <input type="hidden" id="hvsfw-image-picker-input" name="hvsfw_image" value="<?php echo esc_attr( $attachment_id ); ?>">
            <div class="hvsfw-image-picker__control">
                <div class="hvsfw-col__left">
                    <button type="button" id="hvsfw-js-image-picker-select-btn" class="button button-primary" data-state="default">Upload</button>
                </div>
                <div class="hvsfw-col__right">
                    <button type="button" id="hvsfw-js-image-picker-remove-btn" class="button" data-state="<?php echo ( ! empty( $attachment_id ) ? 'default' : 'disabled' ); ?>">Remove</button>
                </div>
            </div>
        </div>
        <p class="description">Select the image for this image swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
    </td>
</tr>