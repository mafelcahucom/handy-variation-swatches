<?php
/**
 * App > Views > Admin > Variation > Term > Tooltip Setting Form Edit.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'type'    => (string)  Contains the attribute swatch type.
 *     'term_id' => (integer) Contains the term ID of the current term editing.
 * ]
 */

if ( ! isset( $args['type'] ) || ! isset( $args['term_id'] ) ) {
    return;
}

$tooltip = Utility::get_swatch_tooltip( $args['term_id'] );
$content = array(
    'text'  => '',
    'html'  => '',
    'image' => 0,
);

if ( $tooltip['type'] === 'text' && ! empty( $tooltip['content'] ) ) {
    $content['text'] = $tooltip['content'];
}

if ( $tooltip['type'] === 'html' && ! empty( $tooltip['content'] ) ) {
    $content['html'] = $tooltip['content'];
}

if ( $tooltip['type'] === 'image' && ! empty( $tooltip['content'] ) ) {
    $content['image'] = ( is_numeric( $tooltip['content'] ) ? $tooltip['content'] : 0 );
}

$visible['text']  = ( $tooltip['type'] === 'text' ? 'yes' : 'no' );
$visible['html']  = ( $tooltip['type'] === 'html' ? 'yes' : 'no' );
$visible['image'] = ( $tooltip['type'] === 'image' ? 'yes' : 'no' );
?>

<?php if ( $args['type'] === 'button' ) : ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="hvsfw_type">
                <?php echo __( 'Button Swatch', 'handy-variation-swatches' ); ?>
            </label>
        </th>
        <td>
            <p class="description">
                <?php echo __( 'Configure the settings for this button swatch. For more additional configuration, click ', 'handy-variation-swatches' ); ?>
                <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>" aria-label="<?php echo __( 'Go To Settings', 'handy-variation-swatches' ); ?>">
                    <?php echo __( 'here', 'handy-variation-swatches' ); ?>
                </a>
            </p>
        </td>
    </tr>
<?php endif; ?>

<tr class="form-field hvsfw-field">
    <th scope="row" valign="top">
        <label for="hvsfw-tooltip-edit_type">
            <?php echo __( 'Tooltip', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <select name="hvsfw_tooltip_type" id="hvsfw-tooltip-edit_type" class="hvsfw-tooltip-field-type" data-prefix="hvsfw-tooltip-edit">
            <option value="none" <?php selected( $tooltip['type'], 'none' ); ?>>
                <?php echo __( 'None', 'handy-variation-swatches' ); ?>
            </option>
            <option value="text" <?php selected( $tooltip['type'], 'text' ); ?>>
                <?php echo __( 'Text', 'handy-variation-swatches' ); ?>
            </option>
            <option value="html" <?php selected( $tooltip['type'], 'html' ); ?>>
                <?php echo __( 'HTML', 'handy-variation-swatches' ); ?>
            </option>
            <option value="image" <?php selected( $tooltip['type'], 'image' ); ?>>
                <?php echo __( 'Image', 'handy-variation-swatches' ); ?>
            </option>
        </select>
        <p class="description">
            <?php echo __( 'Select your preferred tooltip content type.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-edit_content_text" data-visible="<?php echo $visible['text']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw-tooltip-edit_content_text">
            <?php echo __( 'Tooltip Content (Text)', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <input type="text" name="hvsfw_tooltip_text" id="hvsfw-tooltip-edit_content_text" value="<?php echo esc_attr( $content['text'] ); ?>">
        <p class="description">
            <?php echo __( 'Write the tooltip text content. Term name is the default value.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-edit_content_html" data-visible="<?php echo $visible['html']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw-tooltip-edit_content_html">
            <?php echo __( 'Tooltip Content (HTML)', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <textarea name="hvsfw_tooltip_html" id="hvsfw-tooltip-edit_content_html" rows="5">
            <?php echo $content['html']; ?>
        </textarea>
        <p class="description">
            <?php echo __( 'Write the tooltip html markup content. Term name is the default value.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-group-field="hvsfw-tooltip-edit_content_image" data-visible="<?php echo $visible['image']; ?>">
    <th scope="row" valign="top">
        <label for="hvsfw-tooltip-edit_content_image">
            <?php echo __( 'Tooltip Content (Image)', 'handy-variation-swatches' ); ?>
        </label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/image-picker-field', array(
                'id'            => 'hvsfw-tooltip-edit_content_image',
                'name'          => 'hvsfw_tooltip_image',
                'attachment_id' => $content['image'],
            ));
        ?>
        <p class="description">
            <?php echo __( 'Select the image for the tooltip image content. Term name is the default value.', 'handy-variation-swatches' ); ?>
        </p>
    </td>
</tr>
