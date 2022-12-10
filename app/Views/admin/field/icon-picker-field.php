<?php
/**
 * Views > Admin > Field > Icon Picker Field.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'name'        => (string) The name of the icon picker field.
 *     'group'       => (string) The name of the group this icon picker field.
 *     'value'       => (string) The default value of the icon picker field.
 *     'label'       => (string) The label of the icon picker field.
 *     'description' => (string) The description of the icon picker field.
 *     'icons'       => (array)  Contains the icon picker list [ name, svg ].
 * ]
 **/

$name        = ( isset( $args['name'] ) ? $args['name'] : '' );
$group       = ( isset( $args['group'] ) ? $args['group'] : '' );
$value       = ( isset( $args['value'] ) ? $args['value'] : '' );
$label       = ( isset( $args['label'] ) ? $args['label'] : '' );
$description = ( isset( $args['description'] ) ? $args['description'] : '' );
$icons       = ( isset( $args['icons'] ) ? $args['icons'] : [] );
?>

<div id="hd-form-field-<?php echo esc_attr( $name ); ?>" class="hd-form-field" data-has-error="0">
    <div class="hd-form-field--icon-picker-field">
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

        <?php if ( ! empty( $name ) && ! empty( $icons ) ): ?>
            <div class="hd-icon-picker-field">
                <?php foreach ( $icons as $icon ): ?>
                    <div class="hd-js-icon-picker-field-btn hd-icon-picker-field__thumbnail" data-value="<?php echo esc_attr( $icon['name'] ); ?>" data-input="<?php echo esc_attr( $name ); ?>" data-state="<?php echo ( $value == $icon['name'] ? 'active' : 'default' ); ?>" aria-label="<?php echo esc_attr( $icon['name'] ); ?>" title="<?php echo esc_attr( $icon['name'] ); ?>">
                        <?php echo $icon['svg']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" data-input-group="<?php echo esc_attr( $group ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endif; ?>
        <p class="hd-form-field__error hd-clr-red hd-fs-13 hd-mt-15">Error Message</p>
    </div>
</div>