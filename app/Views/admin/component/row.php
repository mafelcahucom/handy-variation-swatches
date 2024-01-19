<?php
/**
 * Views > Admin > Component > Row.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'type'        => (string) Contains the type of row |block|grid.
 *     'label'       => (string) Contains the label of the row.
 *     'description' => (string) Contains the description of the row.
 *     'fields'      => (array)  Contains the fields to be rendered.
 * ]
**/

$type         = ( isset( $args['type'] ) ? $args['type'] : '' );
$label        = ( isset( $args['label'] ) ? $args['label'] : '' );
$description  = ( isset( $args['description'] ) ? $args['description'] : '' );
$fields       = ( isset( $args['fields'] ) ? $args['fields'] : [] );
$total_fields = ( is_array( $fields ) ? count( $fields ) : 0 );

if ( ! in_array( $type, [ 'block', 'grid' ] ) || $total_fields === 0 ) {
    return;
}
?>

<div class="hd-row hd-row--<?php echo esc_attr( $type ); ?>">
    <?php if ( ! empty( $label ) || ! empty( $description ) ): ?>
        <div class="hd-row__title">
            <?php if ( ! empty( $label ) ): ?>
                <label class="hd-row__label">
                    <?php echo esc_html( $label ); ?>
                </label>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="hd-row__content">
        <div class="hd-row__content--<?php echo ( $total_fields > 1 ? 'multiple' : 'single' ); ?>">
            <?php foreach ( $fields as $field ): ?>
                <div class="hd-row__field">
                    <?php echo $field; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ( ! empty( $description ) ): ?>
            <p class="hd-row__description">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
    </div>
</div>