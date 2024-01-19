<?php
/**
 * Views > Admin > Component > Tab Navigation.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'class' => (string) Contains the additional class.   
 *     'tabs'  => (array)  Contains the title and panel of each tab.
 * ]
 **/

$class = ( isset( $args['class'] ) ? $args['class'] : '' );
$tabs  = ( isset( $args['tabs'] ) ? $args['tabs'] : [] );
?>

<div class="hd-tab__nav <?php echo esc_attr( $args['class'] ) ?>" data-visibility="hidden">
    <div class="hd-tab__nav__container">
        <button class="hd-tab__nav__action-btn hd-btn-square" data-event="prev" data-state="disabled" aria-label="<?php echo __( 'Previous', HVSFW_PLUGIN_DOMAIN ); ?>">
            <?php echo Helper::get_icon( 'chevron-backward', 'hd-svg' ); ?>
        </button>
        <ul class="hd-tab__nav__list">
            <?php foreach ( $tabs as $tab ): ?>
                <li class="hd-tab__nav__item">
                    <button type="button" class="hd-tab__nav__item-btn hd-btn" data-target="<?php echo esc_attr( $tab['panel'] ); ?>" data-state="default">
                        <?php echo esc_html( $tab['title'] ); ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
        <button class="hd-tab__nav__action-btn hd-btn-square" data-event="next" data-state="default" aria-label="<?php echo __( 'Next', HVSFW_PLUGIN_DOMAIN ); ?>">
            <?php echo Helper::get_icon( 'chevron-forward', 'hd-svg' ); ?>
        </button>
    </div>
</div>