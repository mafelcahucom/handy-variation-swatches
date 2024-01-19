<?php
/**
 * Views > Admin > Component > Tab Panel.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 *  $args = [
 *      'id'         => (string) Contains the id of tab panel.
 *      'class'      => (string) Contains the additional class.
 *      'state'      => (string) Contains the state of the tab panel |default|active.
 *      'components' => (array)  Contains the components to be rendered inside tab panel. 
 * ]
*/

$class = ( isset( $args['class'] ) ? $args['class'] : '' );
$state = ( isset( $args['state'] ) ? $args['state'] : '' );
?>

<div id="<?php echo esc_attr( $args['id'] ); ?>" class="hd-tab__panel" data-state="<?php echo esc_attr( $state ); ?>">
    <?php
        foreach ( $args['components'] as $component ):
            echo $component;
        endforeach;
    ?>
</div>