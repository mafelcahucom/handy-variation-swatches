<?php
/**
 * App > Views > Admin > Field > Switch Field.
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
 *     'name'        => (string)  Contains the name of the switch field.
 *     'group'       => (string)  Contains the name of the group this switch field.
 *     'value'       => (boolean) Contains the default value of the switch field.
 *     'label'       => (string)  Contains the label of the switch field.
 *     'description' => (string)  Contains the description of the switch field.
 *     'choices'     => (array)   Contains the choices label aliases on : On | off : Off.
 *]
 */

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : 0 );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$choices     = ( isset( $args['choices'] ) ? $args['choices'] : array() );

if ( empty( $name ) || empty( $group ) ) {
    return;
}
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--switch-field">
        <input type="hidden" class="hd-switch-field__input" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo ( $value == 1 ? 1 : 0 ); ?>">
        <?php if ( ! empty( $label ) ) : ?>
            <label class="hd-form-field__label hd-mb-5">
                <?php echo esc_html( $label ); ?>
            </label>
        <?php endif; ?>
        <div class="hd-switch-field">
            <button type="button" class="hd-switch-field__btn" data-type="off" data-name="<?php echo esc_attr( $name ); ?>" data-state="<?php echo ( $value == 0 ? 'active' : 'default' ); ?>">
                <?php echo esc_html( isset( $choices['off'] ) && ! empty( $choices['off'] ) ? $choices['off'] : __( 'Off', 'handy-variation-swatches' ) ); ?>
            </button>
            <button type="button" class="hd-switch-field__btn" data-type="on" data-name="<?php echo esc_attr( $name ); ?>" data-state="<?php echo ( $value == 1 ? 'active' : 'default' ); ?>">
                <?php echo esc_html( isset( $choices['on'] ) && ! empty( $choices['on'] ) ? $choices['on'] : __( 'On', 'handy-variation-swatches' ) ); ?>
            </button>
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
