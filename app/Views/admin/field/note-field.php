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
 *     'title'        => (string) The title of the note field.
 *     'content'      => (string) The content that will be displayed in note field.
 * ]
 **/

$title       = ( isset( $args['title'] ) ? $args['title'] : '' );
$message     = ( isset( $args['message'] ) ? $args['message'] : '' );
?>

<div class="hd-form-field">
    <div class="hd-note-field hd-bg-clr-white hd-p-15 hd-br-default">
        <div class="hd-flex">
            <div>
                <?php echo Helper::get_icon( 'information-circle', 'hd-svg' ); ?>
            </div>
            <div class="hd-ml-10">
                <p class="hd-fw-700">
                    <?php echo esc_html( $title ); ?>
                </p>
                <p>
                    <?php echo $message; ?>
                </p>
            </div>
        </div>
    </div>
</div>