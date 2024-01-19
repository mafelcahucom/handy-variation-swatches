<?php
/**
 * Views > Admin > Variation > Field > Image Size Selector Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/** 
 * $args = [
 *     'id'		 => (string)  Contains the id of the image size selector.
 *     'name'	 => (string)  Contains the name of the image size selector.
 *     'term_id' => (integer) Contains the id of the term.
 *     'default' => (string)  Contains the default image size value.
 * ]
 **/

if ( ! isset( $args['id'] ) || ! isset( $args['name'] ) ) {
	return;
}

$current_size = 'thumbnail';
$image_sizes  = Helper::get_image_sizes();

if ( isset( $args['term_id'] ) ) {
	$current_size = Utility::get_swatch_image_size( $args['term_id'] );
}

if ( isset( $args['default'] ) ) {
	if ( in_array( $args['default'], array_column( $image_sizes, 'value' ) ) ) {
		$current_size = $args['default'];
	}
}
?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="hvsfw-image-size-selector">
	<select id="<?php echo esc_attr( $args['name'] ); ?>" name="<?php echo esc_attr( $args['name'] ); ?>">
		<?php foreach ( $image_sizes as $image_size ): ?>
			<option value="<?php echo esc_attr( $image_size['value'] ); ?>" <?php selected( $current_size, $image_size['value'] ); ?>>
				<?php echo esc_html( $image_size['label'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
</div>