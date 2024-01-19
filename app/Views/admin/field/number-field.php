<?php
/**
 * Views > Admin > Field > Number Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string)  Contains the name of the number field.
 *     'group'       => (string)  Contains the name of the group this number field.
 *     'value'       => (integer) Contains the default value of the number field.
 *     'label'       => (string)  Contains the label of the number field.
 *     'description' => (string)  Contains the description of the number field.
 *     'placeholder' => (string)  Contains the placeholder of the number field.
 * ]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = absint( ( isset( $args['value'] ) ? $args['value'] : 0 ) );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );

if ( empty( $name ) || empty( $group ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--number-field">
        <?php if ( ! empty( $label ) ): ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <input type="number" class="hd-number-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php if ( ! empty( $description ) ): ?>
            <p class="hd-form-field__description">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
        <p class="hd-form-field__error">
            <?php __( 'Error Message', HVSFW_PLUGIN_DOMAIN ); ?>
        </p>
    </div>
</div>