<?php
/**
 * Views > Admin > Field > Color Picker Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string) The name of the color-picker field.
 *     'group'       => (string) The name of the group this color-picker field.
 *     'value'       => (string) The default value of the color-picker field.
 *     'label'       => (string) The label of the color-picker field.
 *     'description' => (string) The description of the color-picker field.
 *]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : 'rgba(0,0,0,1)' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );
$hexa        = ( isset( $args['hexa'] ) ? $args['hexa'] : '#00000000' );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--color-picker-field">
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
            <div class="hd-color-picker-field">
                <button type="button" class="hd-js-color-picker-btn hd-color-picker-field__btn" data-value="<?php echo esc_attr( $value ); ?>" data-input="<?php echo esc_attr( $name ); ?>" style="background-color: <?php echo esc_attr( $value ); ?>"></button>
                <span><?php echo esc_html( $hexa ); ?></span>
                <input type="hidden" id="<?php echo esc_attr( $name ) ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
            </div>
        <?php endif; ?>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>