<?php
/**
 * Views > Admin > Component > Navigation.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'data'  => (array) Contains the label, icon, url and active_state of the navigation.
 * ]
 **/

$data = ( isset( $args ) ? $args : [] );
?>

<ul class="hd-navigation">
    <?php foreach ( $data as $value ): ?>
        <li class="hd-navigation__li">
            <a href="<?php echo esc_url( $value['url'] ); ?>" class="hd-navigation__link" data-state="<?php echo esc_attr( $value['state'] ); ?>">
                <div class="hd-circle-icon"><?php echo $value['icon']; ?></div>
                <span><?php echo esc_html( $value['label'] ); ?></span>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
