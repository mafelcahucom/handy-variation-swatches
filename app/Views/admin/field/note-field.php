<?php
/**
 * Views > Admin > Field > Note Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'type'    => (string)  Contains the type of note field |message|alert.
 *     'title'   => (string)  Contains the title of the note field.
 *     'content' => (string)  Contains the content that will be displayed in note field.
 *     'icon'    => (boolean) Contains the flag whether to show icon in note field, default false.
 * ]
**/

$type    = ( isset( $args['type'] ) ? $args['type'] : 'default' );
$title   = ( isset( $args['title'] ) ? $args['title'] : '' );
$content = ( isset( $args['content'] ) ? $args['content'] : '' );
$icon    = ( isset( $args['icon'] ) ? $args['icon'] : true );
?>

<div class="hd-note-field hd-note-field--<?php echo esc_attr( $type ); ?>">
    <?php if ( $icon ): ?>
        <div class="hd-note-field__icon">
            <?php echo Helper::get_icon( 'information-circle', 'hd-svg' ); ?>
        </div>
    <?php endif; ?>
    <div class="hd-note-field__message">
        <?php if ( ! empty( $title ) ): ?>
            <p class="hd-note-field__title">
                <?php echo esc_html( $title ); ?>
            </p>
        <?php endif; ?>
        <?php if ( ! empty( $content ) ): ?>
            <p class="hd-note-field__content">
                <?php echo $content; ?>
            </p>
        <?php endif; ?>
    </div>
</div>