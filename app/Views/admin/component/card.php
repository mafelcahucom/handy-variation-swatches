<?php
/**
 * Views > Admin > Component > Card.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'title'      => (string) Contains the title of the card.
 *     'class'      => (string) Contains the additional class.
 *     'components' => (string) Contains the components to be render inside the card.
 * ]
**/

$title      = ( isset( $args['title'] ) ? $args['title'] : '' );
$class      = ( isset( $args['class'] ) ? $args['class'] : '' );
$components = ( isset( $args['components'] ) ? $args['components'] : [] );
?>

<div class="hd-card <?php echo esc_attr( $class ); ?>" data-state="opened">
    <div class="hd-card__header">
        <span class="hd-card__title">
            <?php echo esc_html( $title ); ?>
        </span>
        <div class="hd-card__chevron">
            <?php echo Helper::get_icon( 'chevron-up', 'hd-svg' ); ?>
        </div>
    </div>
    <div class="hd-card__body">
        <div class="hd-card__content">
            <?php
                foreach ( $components as $component ):
                    echo $component;
                endforeach;
            ?>
        </div>
    </div>
</div>