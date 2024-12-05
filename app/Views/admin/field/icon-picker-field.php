<?php
/**
 * App > Views > Admin > Field > Icon Picker Field.
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
 *     'name'        => (string) Contains the name of the icon picker field.
 *     'group'       => (string) Contains the name of the group this icon picker field.
 *     'value'       => (string) Contains the default value of the icon picker field.
 *     'label'       => (string) Contains the label of the icon picker field.
 *     'description' => (string) Contains the description of the icon picker field.
 *     'icons'       => (array)  Contains the icon picker list [ name, svg ].
 * ]
 */

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$icons       = ( isset( $args['icons'] ) ? $args['icons'] : array() );

if ( empty( $name ) || empty( $group ) || empty( $icons ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--icon-picker-field">
        <input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php if ( ! empty( $label ) ) : ?>
            <label class="hd-form-field__label hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <div class="hd-icon-picker-field">
            <?php foreach ( $icons as $key => $icon ) : ?>
                <div class="hd-icon-picker-field__item" data-value="<?php echo esc_attr( $icon['name'] ); ?>" data-input="<?php echo esc_attr( $name ); ?>" data-visibility="<?php echo ( $key > 9 ? 'hidden' : 'visible' ); ?>" data-state="<?php echo ( $value == $icon['name'] ? 'active' : 'default' ); ?>" aria-label="<?php echo esc_attr( $icon['name'] ); ?>" title="<?php echo esc_attr( $icon['name'] ); ?>">
                    <?php echo $icon['svg']; ?>
                </div>
            <?php endforeach; ?>
            <?php if ( count( $icons ) > 10 ) : ?>
                <span class="hd-icon-picker-field__pagination hd-form-field__pagination" data-event="more">
                    <?php echo __( 'Show More', 'handy-variation-swatches' ); ?>
                </span>
            <?php endif; ?>
        </div>
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
