<?php
/**
 * Views > Admin > Field > Switch Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string) The name of the switch field.
 *     'group'       => (string) The name of the group this switch field.
 *     'value'       => (boolean) The default value of the switch field.
 *     'label'       => (string) The label of the switch field.
 *     'description' => (string) The description of the switch field.
 *]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : 0 );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--switch-field">
        <div class="hd-flex">
            <div>
                <?php if ( ! empty( $name ) ): ?>
                    <input type="checkbox" class="hd-js-switch-field hd-switch-field" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( ( $value == 1 ? 1 : 0 ) ); ?>" <?php echo checked( ( $value == 1 ? 1 : 0 ), 1, false ); ?>>
                <?php endif; ?>
            </div>
            <div class="hd-ml-15">
                <?php if ( ! empty( $label ) ): ?>
                    <label class="hd-title hd-mb-5" for="<?php echo esc_attr( $name ); ?>">
                        <?php echo esc_html( $label ); ?>
                    </label>
                <?php endif; ?>

                <?php if ( ! empty( $description ) ): ?>
                    <p class="hd-text">
                        <?php echo esc_html( $description ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>