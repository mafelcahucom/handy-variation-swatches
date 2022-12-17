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
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label>Image Swatch</label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/image-picker-field', [
                'id'      => 'hvsfw-image-picker-swatch',
                'name'    => 'hvsfw_image_swatch',
                'term_id' => $args['term_id']
            ]);
        ?>
        <p class="description">Select the image for this image swatch. For more additional configuration, click <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="Go To Settings" aria-label="Go To Settings">here</a>.</p>
    </td>
</tr>