<?php
/**
 * Views > Admin > Variation > Term > Color Setting Form Edit.
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

$colors = get_term_meta( $args['term_id'], '_hvsfw_colors', true );
$colors = ( ! empty( $colors ) ? $colors : [ '#ffffff' ] );
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label>Color Swatch</label>
    </th>
    <td>
        <div id="hvsfw-color-picker" class="hvsfw-color-picker" data-page="edit" data-count="<?php echo count( $colors ); ?>">
            <div class="hvsfw-color-picker__list">
                <?php foreach ( $colors as $color ): ?>
                    <div class="hvsfw-color-picker__item">
                        <div class="hvsfw-col__left">
                            <input type="hidden" name="hvsfw_colors[]" class="hvsfw-color-picker__input" value="<?php echo esc_attr( $color ); ?>">
                        </div>
                        <div class="hvsfw-col__right">
                            <button type="button" class="hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="button" class="hvsfw-js-color-picker-add-btn button">Add More</button>
        </div>
        <p class="description">Configure the colors for this color swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
    </td>
</tr>