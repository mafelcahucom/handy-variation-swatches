<?php
/**
 * App > Admin > Variation > Product Meta View.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\SwatchHelper;

defined( 'ABSPATH' ) || exit;

/**
 * The `ProductMetaView` class contains the all swatch
 * product meta views or components.
 *
 * @since 1.0.0
 */
final class ProductMetaView {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Holds the product id.
     *
     * @since 1.0.0
     *
     * @var integer
     */
    private static $product_id;

    /**
     * Holds the swatches value from _hvsfw_swatches post meta.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private static $swatches;

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Return the attribute type choices.
     *
     * @since 1.0.0
     *
     * @param  array $excluded Contains the list of type to be excluded.
     * @return array
     */
    private static function get_attribute_types( $excluded = array() ) {
        $types = array(
            'default'  => 'Default',
            'select'   => 'Select',
            'button'   => 'Button',
            'color'    => 'Color',
            'image'    => 'Image',
            'assorted' => 'Assorted',
        );

        if ( ! empty( $excluded ) ) {
            foreach ( $excluded as $exclude ) {
                if ( array_key_exists( $exclude, $types ) ) {
                    unset( $types[ $exclude ] );
                }
            }
        }

        return $types;
    }

    /**
     * Return the name with the defined array indexes.
     *
     * @since 1.0.0
     *
     * @param  array $indexes Contains the list of array index.
     * @return string
     */
    private static function get_name( $indexes = array() ) {
        $name = '_hvsfw_value';
        if ( ! empty( $indexes ) ) {
            foreach ( $indexes as $index ) {
                $name .= "[$index]";
            }
        }

        return $name;
    }

    /**
     * Render the custom woocommerce notice.
     *
     * @since 1.0.0
     *
     * @param array $args Contains the necessary arguments for rendering notice.
     * $args = [
     *    'state'   => (string) Contains the notice state.
     *    'message' => (string) Contains the notice message.
     * ]
     */
    public static function notice( $args = array() ) {
        if ( ! isset( $args['state'] ) || ! isset( $args['message'] ) ) {
            return;
        }
        ?>
        <div id="hvsfw-notice" class="hvsfw-notice" data-state="<?php echo $args['state']; ?>" data-visibility="visible">
            <p id="hvsfw-notice-text hvsfw-p-0">
                <?php echo esc_html( $args['message'] ); ?>
            </p>
        </div>
        <?php
    }

    /**
     * Render the swatches panel.
     *
     * @since 1.0.0
     *
     * @param  integer $post_id Contains the current post id.
     * @return void
     */
    public static function swatches_panel( $post_id ) {
        ?>
        <div id="hvsfw_swatch_panel" class="hvsfw panel woocommerce_options_panel hidden">
            <div id="hvsfw-notice" class="hvsfw-notice" data-state="success" data-visibility="hidden">
                <p id="hvsfw-notice-text" class="hvsfw-p-0"></p>
            </div>
            <div id="hvsfw-swatch-attributes">
                <?php
                    // Render swatch attributes.
                    self::swatch_attributes( $post_id );
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * Render the swatch attributes list.
     *
     * @since 1.0.0
     *
     * @param  integer $post_id Contains the current post id.
     * @return void
     */
    public static function swatch_attributes( $post_id ) {
        $product          = wc_get_product( $post_id );
        self::$product_id = $post_id;
        self::$swatches   = Utility::get_product_swatches( $post_id );

        $is_valid_product = false;
        if ( ! empty( $product ) && $product->get_type() === 'variable' ) {
            $attributes = Utility::get_attributes( $product );
            if ( ! empty( $attributes ) ) {
                $is_valid_product = true;
            }
        }

        $show_controller = ( $is_valid_product ? 'yes' : 'no' );
        ?>
        <div class="hvsfw-attributes">
            <?php
                if ( $is_valid_product ) {
                    foreach ( $attributes as $key => $attribute ) {
                        self::attribute_component(array(
                            'name'      => $key,
                            'attribute' => $attribute,
                        ));
                    }
                } else {
                    self::notice(array(
                        'state'   => 'success',
                        'message' => __( 'Before you can customize the variation swatches settings you need to add attributes and save this product first.', 'handy-variation-swatches' ),
                    ));
                }
            ?>
        </div>
        <div class="hvsfw-control" data-visible="<?php echo $show_controller; ?>">
            <div class="hvsfw-flex">
                <div class="hvsfw-col__left hvsfw-mr-10">
                    <button type="button" id="hvsfw-js-save-setting-btn" class="button button-primary">
                        <?php echo __( 'Save Settings', 'handy-variation-swatches' ); ?>
                    </button>
                </div>
                <div class="hvsfw-col__right">
                    <button type="button" id="hvsfw-js-reset-setting-btn" class="button">
                        <?php echo __( 'Reset Settings', 'handy-variation-swatches' ); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render the attribute wrapper component.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for rendering attribute components.
     * $args = [
     *    'name'      => (string) Contains the name of the product attribute name or slug.
     *    'attribute' => (object) Contains the single product attribute.
     * ]
     * @return void
     */
    private static function attribute_component( $args = array() ) {
        if ( ! isset( $args['name'] ) || ! isset( $args['attribute'] ) ) {
            return;
        }

        $stored_swatches      = self::$swatches;
        $swatch_options       = self::get_attribute_types();
        $attribute_id         = $args['attribute']->get_id();
        $attribute_label      = $args['attribute']->get_name();
        $is_custom_attribute  = 'yes';
        if ( $attribute_id !== 0 ) {
            $taxonomy = get_taxonomy( $args['name'] );
            if ( $taxonomy ) {
                $attribute_label     = $taxonomy->labels->singular_name;
                $is_custom_attribute = 'no';
            }
        }

        // Set attribute type.
        $attribute_type = 'default';
        if ( isset( $stored_swatches[ $args['name'] ] ) ) {
            if ( isset( $stored_swatches[ $args['name'] ]['type'] ) ) {
                $attribute_type = $stored_swatches[ $args['name'] ]['type'];
            }
        }

        $style_root_name = esc_attr( self::get_name( array( $args['name'], 'style' ) ) );
        $style_setting   = ( isset( $stored_swatches[ $args['name'] ]['style'] ) ? $stored_swatches[ $args['name'] ]['style'] : array() );
        $show_style      = ( in_array( $attribute_type, array( 'button', 'color', 'image' ), true ) ? 'yes' : 'no' );
        ?>
        <div class="hvsfw-accordion" data-accordion="attribute">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title">
                    <?php echo esc_html( $attribute_label ); ?>
                </span>
                <div class="hvsfw-flex hvsfw-flex-ai-c">
                    <div class="hvsfw-flex hvsfw-flex-ai-c hvsfw-mr-10">
                        <span class="hvsfw-mr-10">
                            <?php echo __( 'Type', 'handy-variation-swatches' ); ?>
                        </span>
                        <select name="<?php echo self::get_name( array( $args['name'], 'type' ) ); ?>" class="hvsfw-field-attribute-type hvsfw-setting-field-type" data-prefix="<?php echo $style_root_name; ?>">
                            <?php foreach ( $swatch_options as $key => $option ) : ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $attribute_type, $key ); ?>>
                                    <?php echo esc_html( $option ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="<?php echo self::get_name( array( $args['name'], 'custom' ) ); ?>" value="<?php echo $is_custom_attribute; ?>">
                    </div>
                    <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>">
                        <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                    </button>
                </div>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-accordion__wrapper">
                        <div class="hvsfw-mb-10" data-accordion="global-style" data-visible="<?php echo $show_style; ?>">
                            <?php
                                // Render global style component.
                                self::style_component(array(
                                    'accordion' => 'global-style',
                                    'title'     => __( 'Style', 'handy-variation-swatches' ),
                                    'type'      => $attribute_type,
                                    'setting'   => $style_setting,
                                    'root_name' => $style_root_name,
                                ));
                            ?>
                        </div>
                    </div>
                    <div class="hvsfw-accordion__wrapper">
                        <?php
                            // Render terms component.
                            self::term_component(array(
                                'type'      => $attribute_type,
                                'attr_name' => $args['name'],
                                'is_custom' => $is_custom_attribute,
                                'attribute' => $args['attribute'],
                            ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render the attribute term wrapper component.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for rendering term components.
     * $args = [
     *    'type'      => (string) Contains the attribute type.
     *    'attr_name' => (string) Contains the attribute name or slug.
     *    'is_custom' => (string) Contains the flag whether is custom attribute.
     *    'attribute' => (object) Contains the object attribute.
     * ]
     * @return void
     */
    private static function term_component( $args = array() ) {
        $parameters = array( 'type', 'attr_name', 'is_custom', 'attribute' );
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        $terms = array();
        foreach ( $args['attribute']->get_options() as $key => $option ) {
            if ( $args['is_custom'] === 'yes' ) {
                $terms[ $key ]['id']   = 0;
                $terms[ $key ]['name'] = $option;
                $terms[ $key ]['slug'] = Utility::get_converted_slug( $option );
            } else {
                $term = get_term( $option );
                if ( $term ) {
                    $terms[ $key ]['id']   = $option;
                    $terms[ $key ]['name'] = $term->name;
                    $terms[ $key ]['slug'] = $term->slug;
                }
            }
        }

        $stored_swatches   = self::$swatches;
        $swatch_options    = self::get_attribute_types( array( 'default', 'select', 'assorted' ) );
        $show_term_control = ( in_array( $args['type'], array( 'default', 'select' ), true ) ? 'no' : 'yes' );
        $is_type_assorted  = ( $args['type'] === 'assorted' ? 'yes' : 'no' );
        ?>
        <?php foreach ( $terms as $key => $term ) : ?>
            <?php
                $term_type     = 'button';
                $style_setting = array();
                $root_name     = esc_attr( self::get_name( array( $args['attr_name'], 'term', $term['slug'] ) ) );
                if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $term['slug'] ] ) ) {
                    $stored_term = $stored_swatches[ $args['attr_name'] ]['term'][ $term['slug'] ];

                    // Set term type.
                    if ( isset( $stored_term['type'] ) ) {
                        if ( in_array( $stored_term['type'], array( 'button', 'color', 'image' ), true ) ) {
                            $term_type = $stored_term['type'];
                        }
                    }

                    // Set style setting.
                    if ( isset( $stored_term['style'] ) ) {
                        $style_setting = $stored_term['style'];
                    }
                }
            ?>
            <div class="hvsfw-accordion" data-accordion="term">
                <div class="hvsfw-accordion__head">
                    <span class="hvsfw-accordion__title">
                        <?php echo esc_html( $term['name'] ); ?>
                    </span>
                    <div class="hvsfw-term-control hvsfw-flex hvsfw-flex-ai-c" data-visible="<?php echo $show_term_control; ?>">
                        <div class="hvsfw-term-select-type hvsfw-flex hvsfw-flex-ai-c hvsfw-mr-10" data-visible="<?php echo $is_type_assorted; ?>">
                            <span class="hvsfw-mr-10">
                                <?php echo __( 'Type', 'handy-variation-swatches' ); ?>
                            </span>
                            <select name="<?php echo $root_name . '[type]' ?>" class="hvsfw-field-term-type hvsfw-setting-field-type" data-prefix="<?php echo $root_name . '[style]'; ?>">
                                <?php foreach ( $swatch_options as $key => $option ) : ?>
                                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $term_type, $key ); ?>>
                                        <?php echo esc_html( $option ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="<?php echo $root_name . '[id]'; ?>" value="<?php echo esc_attr( $term['id'] ); ?>">
                        </div>
                        <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>">
                            <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                        </button>
                    </div>
                </div>
                <div class="hvsfw-accordion__body" data-state="close">
                    <div class="hvsfw-accordion__content">
                        <div data-accordion="style" data-visible="<?php echo $is_type_assorted; ?>">
                            <?php
                                // Render term style component.
                                self::style_component(array(
                                    'accordion' => 'style',
                                    'title'     => __( 'Style', 'handy-variation-swatches' ),
                                    'type'      => $term_type,
                                    'setting'   => $style_setting,
                                    'root_name' => $root_name . '[style]',
                                ));
                            ?>
                        </div>
                        <?php
                            // Render value component.
                            self::value_component(array(
                                'type'      => $term_type,
                                'attr_name' => $args['attr_name'],
                                'term_slug' => $term['slug'],
                                'term_name' => $term['name'],
                                'root_name' => $root_name . '[value]',
                            ));

                            // Render tooltip component.
                            self::tooltip_component(array(
                                'attr_name' => $args['attr_name'],
                                'term_slug' => $term['slug'],
                                'root_name' => $root_name . '[tooltip]',
                                'is_custom' => $args['is_custom'],
                            ));
                        ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
    }

    /**
     * Render the attribute term value component.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for rendering value components.
     * $args = [
     *    'type'      => (string) Contains the term type.
     *    'attr_name' => (string) Contains the attribute name or slug.
     *    'term_name' => (string) Contains the term name.
     *    'term_slug' => (string) Contains the term slug.
     *    'root_name' => (string) Contains the root name, will be used in field attribute name.
     * ]
     * @return void
     */
    private static function value_component( $args = array() ) {
        $parameters = array( 'type', 'attr_name', 'term_name', 'term_name', 'root_name' );
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        // Set stored swatches.
        $stored_swatches = self::$swatches;

        // Set value button label.
        $value_button_label = $args['term_name'];
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['button_label'] ) ) {
            $current_button_label = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['button_label'];
            if ( ! empty( $current_button_label ) ) {
                $value_button_label = $current_button_label;
            }
        }

        // Set value colors.
        $value_colors = array( '#ffffff' );
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['color'] ) ) {
            $current_colors = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['color'];
            if ( ! empty( $current_colors ) && is_array( $current_colors ) ) {
                $value_colors = $current_colors;
            }
        }

        // Set value image.
        $value_image = 0;
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['image'] ) ) {
            $current_image = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['image'];
            if ( ! empty( $current_image ) ) {
                $value_image = $current_image;
            }
        }

        // Set value image size.
        $value_image_size = 'thumbnail';
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['image_size'] ) ) {
            $current_image_size = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['value']['image_size'];
            if ( ! empty( $current_image_size ) ) {
                $value_image_size = $current_image_size;
            }
        }

        // Set group visibility.
        $show_value_button = ( $args['type'] === 'button' ? 'yes' : 'no' );
        $show_value_color  = ( $args['type'] === 'color' ? 'yes' : 'no' );
        $show_value_image  = ( $args['type'] === 'image' ? 'yes' : 'no' );
        ?>
        <div class="hvsfw-accordion" data-accordion="value">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title" data-type="value">
                    <?php echo esc_html( ucfirst( $args['type'] ) ); ?>
                </span>
                <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>">
                    <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                </button>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-field" data-group-field="value_button" data-visible="<?php echo $show_value_button; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_button_label'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Button Label', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[button_label]'; ?>" id="<?php echo $args['root_name'] . '_button_label'; ?>" class="hvsfw-field-value-button-label" placeholder="<?php echo __( 'Label', 'handy-variation-swatches' ); ?>" value="<?php echo esc_attr( $value_button_label ); ?>" data-default="<?php echo esc_attr( $args['term_name'] ); ?>">
                                    <input type="hidden" name="<?php echo $args['root_name'] . '[button_default]' ?>" value="<?php echo esc_attr( $args['term_name'] ); ?>">
                                </div>
                                <?php echo wc_help_tip( __( 'Write the button label. Term name is the default value.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="value_color" data-visible="<?php echo $show_value_color; ?>">
                        <div class="hvsfw-field__col--left">
                            <label class="hvsfw-field__label">
                                <?php echo __( 'Colors', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <?php
                                        echo Helper::render_view( 'variation/field/color-picker-field', array(
                                            'id'      => $args['root_name'] . '_color',
                                            'name'    => $args['root_name'] . '[color][]',
                                            'default' => $value_colors,
                                        ));
                                    ?>
                                </div>
                                <?php echo wc_help_tip( __( 'Add colors as much as you want for this color swatch.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="value_image" data-visible="<?php echo $show_value_image; ?>">
                        <div class="hvsfw-field__col--left">
                            <label class="hvsfw-field__label">
                                <?php echo __( 'Image', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <?php
                                        echo Helper::render_view( 'variation/field/image-picker-field', array(
                                            'id'            => $args['root_name'] . '_image',
                                            'name'          => $args['root_name'] . '[image]',
                                            'attachment_id' => $value_image,
                                        ));
                                    ?>
                                </div>
                                <?php echo wc_help_tip( __( 'Select an image for this image swatch.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="value_image" data-visible="<?php echo $show_value_image; ?>">
                        <div class="hvsfw-field__col--left">
                            <label class="hvsfw-field__label">
                                <?php echo __( 'Image Size', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <?php
                                        echo Helper::render_view( 'variation/field/image-size-selector-field', array(
                                            'id'      => $args['root_name'] . '_image_size',
                                            'name'    => $args['root_name'] . '[image_size]',
                                            'default' => $value_image_size,
                                        ));
                                    ?>
                                </div>
                                <?php echo wc_help_tip( __( 'Select an image size for this image swatch to override the default image size.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render the attribute term tooltip component.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for rendering tooltip components.
     * $args = [
     *    'attr_name' => (string) Contains the attribute name or slug.
     *    'term_slug' => (string) Contains the term slug.
     *    'root_name' => (string) Contains the root name, will be used in field attribute name.
     *    'is_custom' => (string) Contains the flag whether is custom attribute.
     * ]
     * @return void
     */
    private static function tooltip_component( $args = array() ) {
        $parameters = array( 'attr_name', 'term_slug', 'root_name' );
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        // Set stored swatches.
        $stored_swatches = self::$swatches;

        // Set tooltip type.
        $tooltip_type = 'none';
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['tooltip']['type'] ) ) {
            $current_tooltip_type = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['tooltip']['type'];
            if ( ! empty( $current_tooltip_type ) ) {
                $tooltip_type = $current_tooltip_type;
            }
        }

        // Set tooltip content.
        $tooltip_text  = '';
        $tooltip_html  = '';
        $tooltip_image = 0;
        if ( isset( $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['tooltip']['content'] ) ) {
            $current_tooltip_content = $stored_swatches[ $args['attr_name'] ]['term'][ $args['term_slug'] ]['tooltip']['content'];

            // Text.
            if ( $tooltip_type === 'text' ) {
                $tooltip_text = $current_tooltip_content;
            }

            // HTML.
            if ( $tooltip_type === 'html' ) {
                $tooltip_html = $current_tooltip_content;
            }

            // Image.
            if ( $tooltip_type === 'image' ) {
                if ( ! empty( $current_tooltip_content ) ) {
                    $tooltip_image = $current_tooltip_content;
                }
            }
        }

        // Set tooltip type choices.
        $tooltip_choices = array(
            array(
                'value' => 'none',
                'label' => __( 'None', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'default',
                'label' => __( 'Default', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'text',
                'label' => __( 'Text', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'html',
                'label' => __( 'HTML', 'handy-variation-swatches' ),
            ),
            array(
                'value' => 'image',
                'label' => __( 'Image', 'handy-variation-swatches' ),
            ),
        );

        // Remove default value in tooltip choices.
        if ( $args['is_custom'] === 'yes' ) {
            unset( $tooltip_choices[1] );
        }

        // Set group visibility.
        $show_tooltip_text  = ( $tooltip_type === 'text' ? 'yes' : 'no' );
        $show_tooltip_html  = ( $tooltip_type === 'html' ? 'yes' : 'no' );
        $show_tooltip_image = ( $tooltip_type === 'image' ? 'yes' : 'no' );
        ?>
        <div class="hvsfw-accordion" data-accordion="tooltip">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title">
                    <?php echo __( 'Tooltip', 'handy-variation-swatches' ); ?>
                </span>
                <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>">
                    <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                </button>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_type'; ?>" data-visible="yes">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_type'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Type', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <select name="<?php echo $args['root_name'] . '[type]'; ?>" id="<?php echo $args['root_name'] . '_type'; ?>" class="hvsfw-tooltip-field-type" data-prefix="<?php echo $args['root_name']; ?>">
                                        <?php foreach ( $tooltip_choices as $choice ) : ?>
                                            <option value="<?php echo $choice['value']; ?>" <?php selected( $tooltip_type, $choice['value'] ) ?>>
                                                <?php echo $choice['label']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php echo wc_help_tip( __( 'Select your preferred tooltip content type.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_content_text'; ?>" data-visible="<?php echo $show_tooltip_text; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_content_text'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Content (Text)', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[content_text]'; ?>" id="<?php echo $args['root_name'] . '_content_text'; ?>" class="hvsfw-tooltip-field-content-text" value="<?php echo esc_attr( $tooltip_text ); ?>">
                                </div>
                                <?php echo wc_help_tip( __( 'Write the tooltip text content. Term name is the default value.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_content_html'; ?>" data-visible="<?php echo $show_tooltip_html; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_content_html'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Content (HTML)', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <textarea name="<?php echo $args['root_name'] . '[content_html]'; ?>" id="<?php echo $args['root_name'] . '_content_html'; ?>" class="hvsfw-tooltip-field-content-html" rows="5">
                                        <?php echo $tooltip_html; ?>
                                    </textarea>
                                </div>
                                <?php echo wc_help_tip( __( 'Write the tooltip html markup content. Term name is the default value.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_content_image'; ?>" data-visible="<?php echo $show_tooltip_image; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_content_image'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Content (Image)', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <?php
                                        echo Helper::render_view( 'variation/field/image-picker-field', array(
                                            'id'            => $args['root_name'] . '_content_image',
                                            'name'          => $args['root_name'] . '[content_image]',
                                            'attachment_id' => $tooltip_image,
                                        ));
                                    ?>
                                </div>
                                <?php echo wc_help_tip( __( 'Select the image for the tooltip image content. Term name is the default value.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render the attribute style wrapper component.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for rendering style components.
     * $args = [
     *    'accordion' => (string) Contains the name of the accordion or prefix.
     *    'title'     => (string) Contains the title or label of accordion.
     *    'type'      => (string) Contains the type of the swatch.
     *    'setting'   => (array)  Contains the product swatch style value from _hvsfw_value post meta.
     *    'root_name' => (string) Contains the root name, will be used in field attribute name.
     * ]
     * @return void
     */
    private static function style_component( $args = array() ) {
        $parameters = array( 'accordion', 'title', 'type', 'setting', 'root_name' );
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        // Set the default setting value.
        $defaults = array();
        foreach ( SwatchHelper::get_swatch_setting_schema() as $key => $field ) {
            $defaults[ $key ] = $field['default'];
        }
        unset( $defaults['type'] );

        // Set the current setting value, replace with default if value is empty.
        $settings = $args['setting'];
        foreach ( $defaults as $key => $default ) {
            $settings[ $key ] = ( isset( $settings[ $key ] ) ? $settings[ $key ] : $default );
        }

        // Set the group field visibility.
        $settings['type']  = $args['type'];
        $field_visibility  = SwatchHelper::get_swatch_setting_group_field_visibility( $settings );
        ?>
        <div class="hvsfw-accordion" data-accordion="<?php echo $args['accordion']; ?>">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title">
                    <?php echo esc_html( $args['title'] ); ?>
                </span>
                <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>" title="<?php echo __( 'Open', 'handy-variation-swatches' ); ?>">
                    <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                </button>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_style'; ?>" data-visible="<?php echo $field_visibility['style']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_style'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Style', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <select name="<?php echo $args['root_name'] . '[style]'; ?>" id="<?php echo $args['root_name'] . '_style'; ?>" class="hvsfw-setting-field-style" data-prefix="<?php echo $args['root_name']; ?>">
                                        <option value="default" <?php selected( $settings['style'], 'default' ); ?>>
                                            <?php echo __( 'Default', 'handy-variation-swatches' ); ?>
                                        </option>
                                        <option value="custom" <?php selected( $settings['style'], 'custom' ); ?>>
                                            <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
                                        </option>
                                    </select>
                                </div>
                                <?php echo wc_help_tip( __( 'Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_shape'; ?>" data-visible="<?php echo $field_visibility['shape']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_shape'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Shape', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <select name="<?php echo $args['root_name'] . '[shape]'; ?>" id="<?php echo $args['root_name'] . '_shape'; ?>" class="hvsfw-setting-field-shape" data-prefix="<?php echo $args['root_name']; ?>">
                                        <option value="square" <?php selected( $settings['shape'], 'square' ); ?>>
                                            <?php echo __( 'Square', 'handy-variation-swatches' ); ?>
                                        </option>
                                        <option value="circle" <?php selected( $settings['shape'], 'circle' ); ?>>
                                            <?php echo __( 'Circle', 'handy-variation-swatches' ); ?>
                                        </option>
                                        <option value="custom" <?php selected( $settings['shape'], 'custom' ); ?>>
                                            <?php echo __( 'Custom', 'handy-variation-swatches' ); ?>
                                        </option>
                                    </select>
                                </div>
                                <?php echo wc_help_tip( __( 'Select your preferred shape of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_size'; ?>" data-visible="<?php echo $field_visibility['size']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_size'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[size]'; ?>" id="<?php echo $args['root_name'] . '_size'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['size'] ); ?>">
                                </div>
                                <?php echo wc_help_tip( __( 'The size or width & height of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_dimension'; ?>" data-visible="<?php echo $field_visibility['dimension']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_width'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_width'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[width]'; ?>" id="<?php echo $args['root_name'] . '_width'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['width'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_height'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Height', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[height]'; ?>" id="<?php echo $args['root_name'] . '_height'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['height'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The width and height of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_font'; ?>" data-visible="<?php echo $field_visibility['font']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_font_size'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Font', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_size'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Size', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[font_size]'; ?>" id="<?php echo $args['root_name'] . '_font_size'; ?>" placeholder="14px" value="<?php echo esc_attr( $settings['font_size'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_weight'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Weight', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <select name="<?php echo $args['root_name'] . '[font_weight]'; ?>" id="<?php echo $args['root_name'] . '_font_weight'; ?>">
                                                <?php foreach ( Helper::get_font_weight_choices() as $value ) : ?>
                                                    <option value="<?php echo $value['value']; ?>" <?php selected( $settings['font_weight'], $value['value'] ); ?>>
                                                        <?php echo $value['label']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The font size and weight of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_text_color'; ?>" data-visible="<?php echo $field_visibility['text_color']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Text Color', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[font_color]'; ?>" id="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['font_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_hover_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[font_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_font_hover_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['font_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The text color of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_background_color'; ?>" data-visible="<?php echo $field_visibility['background_color']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Background Color', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[background_color]'; ?>" id="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_background_hover_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[background_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_background_hover_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['background_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The background color of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_padding'; ?>" data-visible="<?php echo $field_visibility['padding']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_padding_top'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Padding', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid hvsfw-mb-10">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_top'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Top', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_top]'; ?>" id="<?php echo $args['root_name'] . '_padding_top'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_top'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_bottom'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Bottom', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_bottom]'; ?>" id="<?php echo $args['root_name'] . '_padding_bottom'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_bottom'] ); ?>">
                                        </div>
                                    </div>
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_left'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Left', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_left]'; ?>" id="<?php echo $args['root_name'] . '_padding_left'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_left'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_right'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Right', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_right]'; ?>" id="<?php echo $args['root_name'] . '_padding_right'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_right'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The padding of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_border'; ?>" data-visible="<?php echo $field_visibility['border']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_border_style'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Border', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid hvsfw-mb-10">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_style'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Style', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <select name="<?php echo $args['root_name'] . '[border_style]'; ?>" id="<?php echo $args['root_name'] . '_border_style'; ?>">
                                                <?php foreach ( Helper::get_border_style_choices() as $value ) : ?>
                                                    <option value="<?php echo $value['value']; ?>" <?php selected( $settings['border_style'], $value['value'] ); ?>>
                                                        <?php echo $value['label']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_width'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Width', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[border_width]'; ?>" id="<?php echo $args['root_name'] . '_border_width'; ?>" placeholder="1px" value="<?php echo esc_attr( $settings['border_width'] ); ?>">
                                        </div>
                                    </div>
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[border_color]'; ?>" id="<?php echo $args['root_name'] . '_border_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['border_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_hover_color'; ?>" class="hvsfw-field__label--sub">
                                                <?php echo __( 'Active Color', 'handy-variation-swatches' ); ?>
                                            </label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[border_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_border_hover_color'; ?>" class="hvsfw-color-picker-style" value="<?php echo esc_attr( $settings['border_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( __( 'The border of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_border_radius'; ?>" data-visible="<?php echo $field_visibility['border_radius']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_border_radius'; ?>" class="hvsfw-field__label">
                                <?php echo __( 'Border Radius', 'handy-variation-swatches' ); ?>
                            </label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[border_radius]'; ?>" id="<?php echo $args['root_name'] . '_border_radius'; ?>" placeholder="0px" value="<?php echo esc_attr( $settings['border_radius'] ); ?>">
                                </div>
                                <?php echo wc_help_tip( __( 'The border radius of this variation swatch attribute.', 'handy-variation-swatches' ) ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
