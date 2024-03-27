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
 *     'name'        => (string) Contains the name of the loader picker field.
 *     'group'       => (string) Contains the name of the group this loader picker field.
 *     'value'       => (string) Contains the default value of the loader picker field.
 *     'label'       => (string) Contains the label of the loader picker field.
 *     'description' => (string) Contains the description of the loader picker field.
 *     'choices'     => (array)  Contains the name of the loaders.
 *]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$choices     = ( isset( $args['choices'] ) ? $args['choices'] : [] );

if ( empty( $name ) || empty( $group ) || empty( $choices ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--loader-picker-field">
        <input type="hidden" id="<?php echo esc_attr( $name ) ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php if ( ! empty( $label ) ): ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
            <div class="hd-loader-picker-field">
            <?php foreach ( $choices as $key => $choice ): ?>
                <button type="button" class="hd-loader-picker-field__item" data-value="<?php echo esc_attr( $choice ) ?>" data-input="<?php echo esc_attr( $name ); ?>" data-visibility="<?php echo ( $key > 9 ? 'hidden' : 'visible' ); ?>" data-state="<?php echo ( $value == $choice ? 'active' : 'default' ); ?>">
                    <div class="hd-loader-picker-field__loader">
                        <div class="hd-<?php echo esc_attr( $choice ); ?>"></div>
                    </div>
                </button>
            <?php endforeach; ?>
            <?php if ( count( $choices ) > 10 ): ?>
                <span class="hd-loader-picker-field__pagination hd-form-field__pagination" data-event="more">
                    <?php echo __( 'Show More', HVSFW_PLUGIN_DOMAIN ); ?>
                </span>
            <?php endif; ?>
        </div>
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