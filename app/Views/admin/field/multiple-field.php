<?php
/**
 * Views > Admin > Field > Multiple Field.
 * 
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'label'       => (string) The label of the text field.
 *     'description' => (string) The description of the text field.
 *     'fields'      => (array)  Containing the set of fields.
 * ]
 **/

$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$fields      = ( isset( $args['fields'] ) ? $args['fields'] : [] );
?>

<div class="hd-form-field hd-form-field--multiple">
    <?php if ( ! empty( $label ) ): ?>
        <label class="hd-title hd-mb-5">
            <?php echo esc_html( $label ); ?>
        </label>
    <?php endif; ?>

    <?php if ( ! empty( $description ) ): ?>
        <p class="hd-text">
            <?php echo esc_html( $description ); ?>
        </p>
    <?php endif; ?>

    <?php if ( ! empty( $fields ) ): ?>
        <div class="hd-form-field__grid">
            <?php
                foreach ( $fields as $field ) {
                    echo $field;
                }
            ?>
        </div>
    <?php endif; ?>
</div>