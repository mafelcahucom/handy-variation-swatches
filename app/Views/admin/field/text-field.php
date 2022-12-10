<?php
/**
 * Views > Admin > Field > Text Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string) The name of the text field.
 *     'group'       => (string) The name of the group this text field.
 *     'value'       => (string) The default value of the text field.
 *     'label'       => (string) The label of the text field.
 *     'description' => (string) The description of the text field.
 *     'placeholder' => (string) The placeholder of the text field.
 * ]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--text-field">
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
            <input type="text" class="hd-text-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endif; ?>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>