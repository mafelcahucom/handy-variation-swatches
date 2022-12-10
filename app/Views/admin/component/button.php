<?php
/**
 * Views > Admin > Component > Button.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

/** 
 * $args = [
 *     'type'         => (string) The type of button normal | circle | circle-link.
 *     'id'           => (string) The id of the button.
 *     'class'        => (string) Additional class.
 *     'attr'         => (array) Contains the additional attributes.
 *     'label'        => (string) The label of the button. In cirle label will be used in aria-label
 *     'icon'         => (string) The name of svg icon. This is only applicable in circle type.
 *     'url'          => (string) The url to be used in link tag.
 * ]
 **/

$id    = ( isset( $args['id'] ) ? $args['id'] : '' );
$type  = ( isset( $args['type'] ) ? $args['type'] : 'normal' );
$label = ( isset( $args['label'] ) ? $args['label'] : '' );
$class = ( isset( $args['class'] ) ? $args['class'] : '' );
$attr  = ( isset( $args['attr'] ) ? $args['attr'] : [] );
$icon  = ( isset( $args['icon'] ) ? $args['icon'] : '' );
$url   = ( isset( $args['url'] ) ? $args['url'] : '#' );
?>

<?php if ( $type === 'normal' ): ?>
    <button id="<?php echo esc_attr( $id ); ?>" class="hd-btn <?php echo esc_attr( $class ); ?>" data-state="default" <?php echo Helper::get_attributes( $attr ); ?>>
        <span><?php echo esc_html( $label ); ?></span>
        <div class="hd-loader"></div>
    </button>
<?php endif; ?>

<?php if ( $type === 'circle' ): ?>
    <button id="<?php echo esc_attr( $id ); ?>" class="hd-btn-circle <?php echo esc_attr( $class ); ?>" aria-label="<?php echo esc_attr( $label ); ?>" <?php echo Helper::get_attributes( $attr ); ?>>
        <?php echo Helper::get_icon( $icon, 'hd-svg' ); ?>
    </button>
<?php endif; ?>

<?php if ( $type === 'circle-link' ): ?>
    <a href="<?php echo esc_url( $url ); ?>" id="<?php echo esc_attr( $id ); ?>" class="hd-btn-circle <?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $label ); ?>" <?php echo Helper::get_attributes( $attr ); ?>>
        <?php echo Helper::get_icon( $icon, 'hd-svg' ); ?>
    </a>
<?php endif; ?>