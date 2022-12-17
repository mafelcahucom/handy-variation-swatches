<?php
/**
 * Views > Admin > Variation > Term > Tooltip Setting Form Edit.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;
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

$tooltip = Utility::get_swatch_tooltip( $args['term_id'] );
$content = [
    'text'  => '',
    'html'  => '',
    'image' => 0
];

if ( $tooltip['type'] === 'text' && ! empty( $tooltip['content'] ) ) {
    $content['text'] = $tooltip['content'];
}

if ( $tooltip['type'] === 'html' && ! empty( $tooltip['content'] ) ) {
    $content['html'] = $tooltip['content'];
}

if ( $tooltip['type'] === 'image' && ! empty( $tooltip['content'] ) ) {
    $content['image'] = ( is_numeric( $tooltip['content'] ) ? $tooltip['content'] : 0 );
}

$states['text']  = ( $tooltip['type'] === 'text' ? 'show' : 'hide' );
$states['html']  = ( $tooltip['type'] === 'html' ? 'show' : 'hide' );
$states['image'] = ( $tooltip['type'] === 'image' ? 'show' : 'hide' );
?>

<tr class="form-field hvsfw-field">
    <th scope="row" valign="top">
        <label>Tooltip</label>
    </th>
    <td>
        <select name="hvsfw_tooltip_type" id="hvsfw_tooltip_type">
            <option value="none" <?php selected( $tooltip['type'], 'none' ); ?>>None</option>
            <option value="text" <?php selected( $tooltip['type'], 'text' ); ?>>Text</option>
            <option value="html" <?php selected( $tooltip['type'], 'html' ); ?>>HTML</option>
            <option value="image" <?php selected( $tooltip['type'], 'image' ); ?>>Image</option>
        </select>
        <p class="description">Select your preferred tooltip content type.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-type="text" data-state="<?php echo $states['text']; ?>">
    <th scope="row" valign="top">
        <label>Tooltip Content (Text)</label>
    </th>
    <td>
        <input type="text" name="hvsfw_tooltip_text" id="hvsfw_tooltip_text" value="<?php echo esc_attr( $content['text'] ); ?>">
        <p class="description">Write the tooltip text content. Term name is the default value.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-type="html" data-state="<?php echo $states['html']; ?>">
    <th scope="row" valign="top">
        <label>Tooltip Content (HTML)</label>
    </th>
    <td>
        <textarea name="hvsfw_tooltip_html" id="hvsfw_tooltip_html" rows="5">
            <?php echo $content['html']; ?>
        </textarea>
        <p class="description">Write the tooltip html markup content. Term name is the default value.</p>
    </td>
</tr>
<tr class="form-field hvsfw-field hvsfw-field__tooltip" data-type="image" data-state="<?php echo $states['image']; ?>">
    <th scope="row" valign="top">
        <label>Tooltip Content (Image)</label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/image-picker-field', [
                'id'   => 'hvsfw-image-picker-tooltip',
                'name' => 'hvsfw_tooltip_image',
                'attachment_id' => $content['image'] 
            ]);
        ?>
        <p class="description">Select the image for the tooltip image content. Term name is the default value.</p>
    </td>
</tr>