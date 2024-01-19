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
 *     'term_id' => (integer) Contains the term ID of the current term editing.
 * ]
 **/

if ( ! isset( $args['term_id'] ) ) {
    return;
}
?>

<tr class="form-field">
    <th scope="row" valign="top">
        <label for="hvsfw_type">
            <?php echo __( 'Color Swatch', HVSFW_PLUGIN_DOMAIN ); ?>
        </label>
    </th>
    <td>
        <p class="description">
            <?php echo __( 'Configure the settings for this color swatch. For more additional configuration, click ', HVSFW_PLUGIN_DOMAIN ); ?>
            <a class="hvsfw-card__setting" href="<?php echo esc_url( Helper::get_root_url() ); ?>" target="_blank" title="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>" aria-label="<?php echo __( 'Go To Settings', HVSFW_PLUGIN_DOMAIN ); ?>">
                <?php echo __( 'here', HVSFW_PLUGIN_DOMAIN ); ?>
            </a>
        </p>
    </td>
</tr>
<tr class="form-field">
    <th scope="row" valign="top">
        <label>Colors</label>
    </th>
    <td>
        <?php
            echo Helper::render_view( 'variation/field/color-picker-field', [
                'id'      => 'hvsfw-color-picker-swatch',
                'name'    => 'hvsfw_color_swatch[]',
                'term_id' => $args['term_id']
            ]);
        ?>
        <p class="description">
            <?php echo __( 'Add colors as much as you want for this color swatch.', HVSFW_PLUGIN_DOMAIN ); ?>
        </p>
    </td>
</tr>