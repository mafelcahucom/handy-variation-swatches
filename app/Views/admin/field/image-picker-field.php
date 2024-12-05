<?php
/**
 * App > Views > Admin > Field > Image Picker Field.
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
 *     'name'        => (string) Contains the name of the image picker field.
 *     'group'       => (string) Contains the name of the group this image picker field.
 *     'value'       => (string) Contains the default value of the image picker field.
 *     'label'       => (string) Contains the label of the image picker field.
 *     'description' => (string) Contains the description of the image picker field.
 *     'max_width'   => (int)    Contains the max width of the image picker thumbnail.
 *     'choices'     => (array)  Contains the images picker choices |value|label|image|.
 * ]
 */

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$max_width   = ( isset( $args['max_width'] ) ? $args['max_width'] : '50' );
$choices     = ( isset( $args['choices'] ) ? $args['choices'] : array() );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--image-picker-field">
        <?php if ( ! empty( $label ) ) : ?>
            <label class="hd-title hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <?php if ( ! empty( $description ) ) : ?>
            <p class="hd-text hd-mb-15">
                <?php echo esc_html( $description ); ?>
            </p>
        <?php endif; ?>
        <?php if ( ! empty( $name ) && ! empty( $choices ) ) : ?>
            <div class="hd-image-picker-field" style="grid-template-columns: repeat(auto-fill, minmax(<?php echo esc_attr( $max_width ) . 'px'; ?>, 3fr));">
                <?php foreach ( $choices as $choice ) : ?>
                    <div class="hd-js-image-picker-field-btn hd-image-picker-field__thumbnail" data-value="<?php echo esc_attr( $choice['value'] ); ?>" data-input="<?php echo esc_attr( $name ); ?>" data-state="<?php echo ( $value == $choice['value'] ? 'active' : 'default' ); ?>" aria-label="<?php echo esc_attr( $choice['label'] ); ?>" title="<?php echo esc_attr( $choice['label'] ); ?>">
                        <img src="<?php echo esc_url( $choice['image'] ); ?>" alt="<?php echo esc_attr( $choice['label'] ); ?>" title="<?php echo esc_attr( $choice['label'] ); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endif; ?>
        <p class="hd-form-field__error">
            <?php echo __( 'Error Message', 'handy-variation-swatches' ); ?>
        </p>
    </div>
</div>
