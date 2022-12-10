<?php
/**
 * Views > Admin > Field > Loader Picker Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string) The name of the loader picker field.
 *     'group'       => (string) The name of the group this loader picker field.
 *     'value'       => (string) The default value of the loader picker field.
 *     'label'       => (string) The label of the loader picker field.
 *     'description' => (string) The description of the loader picker field.
 *     'choices'     => (array)  Contains the name of the loaders.
 *]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$choices     = ( isset( $args['choices'] ) ? $args['choices'] : [] );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--loader-picker-field">
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

        <?php if ( ! empty( $name ) && ! empty( $choices ) ): ?>
            <div class="hd-loader-picker-field">
                <?php foreach ( $choices as $choice ): ?>
                    <button type="button" class="hd-js-loader-picker-field-btn hd-loader-picker-field__thumbnail" data-value="<?php echo esc_attr( $choice ) ?>" data-input="<?php echo esc_attr( $name ); ?>" data-state="<?php echo ( $value == $choice ? 'active' : 'default' ); ?>">
                        <div class="hd-loader-picker-field__container">
                            <div class="hd-<?php echo esc_attr( $choice ); ?>"></div>
                        </div>
                    </button>
                <?php endforeach; ?>
                <input type="hidden" id="<?php echo esc_attr( $name ) ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
            </div>
        <?php endif; ?>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>