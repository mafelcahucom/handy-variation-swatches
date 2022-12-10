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
 *     'name'        => (string) The name of the number field.
 *     'group'       => (string) The name of the group this number field.
 *     'value'       => (int)    The default value of the number field.
 *     'label'       => (string) The label of the number field.
 *     'description' => (string) The description of the number field.
 *     'placeholder' => (string) The placeholder of the number field.
 * ]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = absint( ( isset( $args['value'] ) ? $args['value'] : 0 ) );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--number-field">
        <?php if ( ! empty( $label ) ): ?>
            <label class="hd-title hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>

        <?php if ( ! empty( $description ) ): ?>
            <p class="hd-text hd-mb-15">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>

        <?php if ( ! empty( $name ) ): ?>
            <input type="number" class="hd-number-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endif; ?>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>