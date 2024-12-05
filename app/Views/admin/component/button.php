<?php
/**
 * App > Views > Admin > Component > Button.
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
 *     'id'    => (string) Contains the id of the button.
 *     'class' => (string) Contains the additional class.
 *     'attr'  => (array)  Contains the additional attributes.
 *     'state' => (string) Contains the current state of the button.
 *     'label' => (string) Contains the label of the button.
 *     'icon'  => (string) Contains the icon of the button.
 * ]
 */

$id    = ( isset( $args['id'] ) ? $args['id'] : '' );
$label = ( isset( $args['label'] ) ? $args['label'] : '' );
$class = ( isset( $args['class'] ) ? $args['class'] : '' );
$attr  = ( isset( $args['attr'] ) ? $args['attr'] : array() );
$state = ( isset( $args['state'] ) ? $args['state'] : 'default' );
$icon  = ( isset( $args['icon'] ) ? $args['icon'] : '' );
?>

<button id="<?php echo esc_attr( $id ); ?>" class="hd-btn <?php echo esc_attr( $class ); ?>" data-state="<?php echo esc_attr( $state ); ?>" <?php echo Helper::get_attributes( $attr ); ?>>
    <div class="hd-btn__detail">
        <?php if ( ! empty( $icon ) ) : ?>
            <?php echo Helper::get_icon( $icon, 'hd-btn__icon' ); ?>
        <?php endif; ?>
        <span class="hd-btn__label">
            <?php echo esc_html( $label ); ?>
        </span>
    </div>
    <div class="hd-btn__loader hd-loader"></div>
</button>
