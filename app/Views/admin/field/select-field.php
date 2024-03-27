<?php
/**
 * Views > Admin > Field > Select Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/** 
 * $args = [
 *     'name'        => (string) Contains the name of the select field.
 *     'group'       => (string) Contains the name of the group this select field.
 *     'value'       => (string) Contains the default value of the select field.
 *     'label'       => (string) Contains the label of the select field.
 *     'options'     => (array)  Contains the set of options to be selected.
 *     'description' => (string) Contains the description of the select field.
 *     'placeholder' => (string) Contains the placeholder of the select field.
 * ]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$options     = ( isset( $args['options'] ) ? $args['options'] : [] );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );

if ( empty( $name ) || empty( $group ) || empty( $options ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--select-field">
        <?php if ( ! empty( $label ) ): ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <select class="hd-select-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>">
            <?php if ( ! empty( $placeholder ) ): ?>
                <option value=""><?php echo esc_html( $placeholder ); ?></option>
            <?php endif; ?>
            <?php if ( ! empty( $options ) ): ?>
                <?php foreach ( $options as $option ): ?>
                    <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo selected( $option['value'], $value, false ) ?>>
                        <?php echo esc_html( $option['label'] ); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <?php if ( ! empty( $description ) ): ?>
            <p class="hd-form-field__description">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
        <p class="hd-form-field__error">
            <?php echo __( 'Error Message', HVSFW_PLUGIN_DOMAIN ); ?>
        </p>
    </div>
</div>