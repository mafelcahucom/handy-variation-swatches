<?php
/**
 * Views > Admin > Variation > Meta Box > Swatch Panel.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'product_id' => (integer) The ID of the target product.
 *]
**/

if ( ! isset( $args['product_id'] ) ) {
	return;
}
?>

<div id="hvsfw_swatch_panel" class="panel woocommerce_options_panel">
	<input type="text">
</div>