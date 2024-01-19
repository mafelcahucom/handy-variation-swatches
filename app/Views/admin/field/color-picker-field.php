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
 *     'name'        => (string) Contains the name of the color-picker field.
 *     'group'       => (string) Contains the name of the group this color-picker field.
 *     'value'       => (string) Contains the default value of the color-picker field.
 *     'label'       => (string) Contains the label of the color-picker field.
 *     'description' => (string) Contains the description of the color-picker field.
 *]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : 'rgba(0,0,0,1)' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );
$hexa        = ( isset( $args['hexa'] ) ? $args['hexa'] : '#00000000' );

if ( empty( $name ) || empty( $group ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--color-picker-field">
        <input type="hidden" id="<?php echo esc_attr( $name ) ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php if ( ! empty( $label ) ): ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <div class="hd-color-picker-field">
            <button type="button" class="hd-color-picker-field__btn" data-value="<?php echo esc_attr( $value ); ?>" data-input="<?php echo esc_attr( $name ); ?>" style="background-color: <?php echo esc_attr( $value ); ?>"></button>
            <span class="hd-color-picker-field__label">
                <?php echo esc_html( $hexa ); ?>
            </span>
        </div>
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