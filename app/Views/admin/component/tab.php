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
 *     'class' => (string) Additional class.   
 *     'tabs'  => (array)  Contains the [ title, panel ].
 * ]
 **/

$class = ( isset( $args['class'] ) ? $args['class'] : '' );
$tabs  = ( isset( $args['tabs'] ) ? $args['tabs'] : [] );
?>

<div class="hd-tab <?php echo esc_attr( $args['class'] ) ?>">
    <div class="hd-carousel">
        <button class="hd-js-carousel-btn hd-carousel__btn hd-btn-circle" data-event="prev" data-state="disabled" aria-label="previous">
            <?php echo Helper::get_icon( 'chevron-backward-filled', 'hd-svg' ); ?>
        </button>
        <ul class="hd-carousel__list">
            <?php foreach ( $tabs as $tab ): ?>
                <li class="hd-carousel__item">
                    <button type="button" class="hd-js-tab-btn hd-tab__btn hd-btn" data-target="<?php echo esc_attr( $tab['panel'] ); ?>" data-state="default">
                        <?php echo esc_html( $tab['title'] ); ?>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
        <button class="hd-js-carousel-btn hd-carousel__btn hd-btn-circle" data-event="next" data-state="default" aria-label="next">
            <?php echo Helper::get_icon( 'chevron-forward-filled', 'hd-svg' ); ?>
        </button>
    </div>
</div>