<?php
/**
 * App > Views > Admin > Variation > Term > Image Setting Form Edit.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'term_id' => (integer) Contains the term ID of the current term editing.
 * ]
 */

if ( ! isset( $args['term_id'] ) ) {
    return;
}
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="hvsfw_type">
            <?php echo __( 'Image Swatch', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <p class="description">
            <?php echo __( 'Configure the settings for this image swatch. For more additional configuration, click ', 'handy-variation-swatches' ); ?>
            <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>" aria-label="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>">
                <?php echo __( 'here', 'handy-variation-swatches' ); ?>
            </a>
        </p>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label>
            <?php echo __( 'Image', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/image-picker-field', array(
                'id'      => 'hvsfw-image-picker-swatch',
                'name'    => 'hvsfw_image_swatch',
                'term_id' => $args['term_id'],
            ));
        ?>
        <p class="description">
            <?php echo __( 'Select an image for this image swatch.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field">
    <th scope="row" valign="top">
        <label>
            <?php echo __( 'Image Size', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/image-size-selector-field', array(
                'id'      => 'hvsfw-image-size-swatch',
                'name'    => 'hvsfw_image_size_swatch',
                'term_id' => $args['term_id'],
            ));
        ?>
        <p class="description">
            <?php echo __( 'Select an image size for this image swatch to override the default image size.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
