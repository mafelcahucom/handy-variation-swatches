<?php
/**
 * Views > Admin > Variation > Term > Preview > Color Swatch.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'term_id' => (integer) The term ID of the current term editing.
 * ]
 **/

if ( ! isset( $args['term_id'] ) ) {
    return;
}

$colors = Utility::get_swatch_color( $args['term_id'] );
?>

<div class="hvsfw-preview hvsfw-preview__color" style="background: <?php echo Utility::get_linear_color( $colors ); ?>;"></div>