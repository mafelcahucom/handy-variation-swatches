<?php
/**
 * App > Views > Admin > Field > Textarea Field.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'name'        => (string) Contains the name of the textarea field.
 *     'group'       => (string) Contains the name of the group this textarea field.
 *     'value'       => (string) Contains the default value of the textarea field.
 *     'label'       => (string) Contains the label of the textarea field.
 *     'description' => (string) Contains the description of the textarea field.
 *     'placeholder' => (string) Contains the placeholder of the textarea field.
 * ]
 */

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );

if ( empty( $name ) || empty( $group ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--textarea-field">
        <?php if ( ! empty( $label ) ) : ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <textarea class="hd-textarea-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>"><?php echo $value; ?></textarea>
        <?php if ( ! empty( $description ) ) : ?>
            <p class="hd-form-field__description">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
        <p class="hd-form-field__error">
            <?php echo __( 'Error Message', 'handy-variation-swatches' ); ?>
        </p>
    </div>
</div>
