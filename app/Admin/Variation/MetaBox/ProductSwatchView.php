<?php
namespace HVSFW\Admin\Variation\MetaBox;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Product Swatch View.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ProductSwatchView {

	/**
	 * Inherit Singleton.
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
     * Holds the swatch value.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private static $swatch_value;

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Render the custom woocommerce notice.
     *
     * @since 1.0.0
     *
     * @param array  $args  Containing the arguments for rendering notice.
     * $args = [
     *     'state'   => (string) The notice state.
     *     'message' => (string) The notice message.
     * ]
     */
    public static function notice( $args = [] ) {
        if ( ! isset( $args['state'] ) || ! isset( $args['message'] ) ) {
            return;
        }
        ?>
        <div id="hvsfw-notice" class="hvsfw-notice" data-state="<?php echo $args['state']; ?>" data-visibility="visible">
            <p id="hvsfw-notice-text"><?php echo $args['message']; ?></p>
        </div>
        <?php
    }

    /**
     * Return the attribute type choices.
     *
     * @since 1.0.0
     * 
     * @param  array   $excluded        The list of type to be excluded.
     * @return array
     */
    private static function get_attribute_types( $excluded = [] ) {
        $types = [
            'default'  => 'Default',
            'select'   => 'Select',
            'button'   => 'Button',
            'color'    => 'Color',
            'image'    => 'Image',
            'assorted' => 'Assorted'
        ];

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
     * @param  array  $indexes  The list of array index.
     * @return string
     */
    private static function get_name( $indexes = [] ) {
        $name = '_hvsfw_value';
        if ( ! empty( $indexes ) ) {
            foreach ( $indexes as $index ) {
                $name .= "[$index]";
            }
        }

        return $name;
    }

    /**
     * Return a converted slug string.
     *
     * @since 1.0.0
     * 
     * @param  string  $string  The string to be converted to slug.
     * @return string
     */
    private static function get_converted_slug( $string ) {
        if ( empty( $string ) ) {
            return;
        }

        return strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $string ) ) );
    }

    /**
     * Render the swatches panel.
     *
     * @since 1.0.0
     * 
     * @param  object  $product  The product object.
     */
    public static function swatches_panel( $product ) {
        self::$product_id   = $product->get_id();
        self::$swatch_value = Utility::get_product_swatch_value( self::$product_id );
        $is_valid_product   = ( ! empty( $product ) && $product->get_type() === 'variable' );
        ?>
        <div id="hvsfw_swatch_panel" class="hvsfw panel woocommerce_options_panel hidden">
            <input type="hidden" name="hvsfw_product_id" value="<?php echo esc_attr( self::$product_id ); ?>">
            <div id="hvsfw-notice" class="hvsfw-notice" data-state="success" data-visibility="hidden">
                <p id="hvsfw-notice-text"></p>
            </div>
            <?php
                if ( $is_valid_product ) {
                    $attributes = Utility::get_attributes( $product );
                    if ( ! empty( $attributes ) ) {
                        foreach ( $attributes as $key => $attribute ) {
                            self::attribute_component([
                                'name'      => $key,
                                'attribute' => $attribute
                            ]);
                        }
                    }
                } else {
                    self::notice([
                        'state'   => 'success',
                        'message' => 'Before you can customize the variation swatches settings you need to save this product first.'
                    ]);
                }
            ?>
        </div>
        <?php
    }

    /**
     * Render the attribute wrapper component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for rendering attribute components.
     * $args = [
     *     'name'      => (string)  The name of the product attribute name or slug.
     *     'attribute' => (object)  The single product attribute.
     * ]
     */
    private static function attribute_component( $args = [] ) {
        if ( ! isset( $args['name'] ) || ! isset( $args['attribute'] ) ) {
            return;
        }

        $attribute_id         = $args['attribute']->get_id();
        $attribute_label      = $args['attribute']->get_name();
        $attribute_type       = 'select';
        $is_custom_attribute  = true;
        if ( $attribute_id !== 0 ) {
            $taxonomy = get_taxonomy( $args['name'] );
            if ( $taxonomy ) {
                $attribute_label     = $taxonomy->labels->singular_name;
                $attribute_type      = Utility::get_attribute_type_by_id( $attribute_id );
                $is_custom_attribute = false;
            }
        }

        $attribute_options       = self::get_attribute_types();
        $global_style_root_name  = self::get_name( [ $args['name'], 'style' ] );
        $global_style_setting    = ( isset( self::$swatch_value['style'] ) ? self::$swatch_value['style'] : [] );
        $show_global_style       = ( in_array( $attribute_type, [ 'button', 'color', 'image' ] ) ? 'yes' : 'no' );
        ?>
        <div class="hvsfw-accordion" data-accordion="attribute">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title">
                    <?php echo esc_html( $attribute_label ); ?>
                </span>
                <div class="hvsfw-flex hvsfw-flex-ai-c">
                    <div class="hvsfw-flex hvsfw-flex-ai-c hvsfw-mr-10">
                        <span class="hvsfw-mr-10">Type</span>
                        <select name="<?php echo self::get_name( [ $args['name'], 'type' ] ); ?>" class="hvsfw-field-attribute-type hvsfw-setting-field-type" data-prefix="<?php echo $global_style_root_name; ?>">
                            <?php foreach ( $attribute_options as $key => $option ): ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $attribute_type, $key ); ?>>
                                    <?php echo esc_html( $option ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="<?php echo self::get_name( [ $args['name'], 'custom' ] ); ?>" value="<?php echo $is_custom_attribute; ?>">
                    </div>
                    <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="open" title="open">
                        <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                    </button>
                </div>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-accordion__wrapper" data-accordion="global-style" data-visible="<?php echo $show_global_style; ?>">
                        <?php
                            self::style_component([
                                'accordion' => 'global-style',
                                'title'     => 'Style',
                                'type'      => $attribute_type,
                                'setting'   => $global_style_setting,
                                'root_name' => $global_style_root_name
                            ]);
                        ?>
                    </div>
                    <div class="hvsfw-accordion__wrapper">
                        <?php 
                            self::term_component([
                                'name'      => $args['name'],
                                'type'      => $attribute_type,
                                'is_custom' => $is_custom_attribute,
                                'attribute' => $args['attribute']
                            ]); 
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
     * @param  array  $args  Containing the arguments for rendering term components.
     * $args = [
     *     'name'      => (string)  The attribute name or slug.
     *     'type'      => (string)  The attribute type.
     *     'is_custom' => (boolean) Is custom attribute.
     *     'attribute' => (object)  The object attribute.
     * ]
     */
    private static function term_component( $args = [] ) {
        $parameters = [ 'name', 'type', 'is_custom', 'attribute' ];
        if ( Helper::has_array_unset( $args, $parameters ) ) {
            return;
        }

        $terms = [];
        foreach ( $args['attribute']->get_options() as $key => $option ) {
            if ( $args['is_custom'] === true ) {
                $terms[ $key ]['name'] = $option;
                $terms[ $key ]['slug'] = self::get_converted_slug( $option );
            } else {
                $term = get_term( $option );
                if ( $term ) {
                    $terms[ $key ]['name'] = $term->name;
                    $terms[ $key ]['slug'] = $term->slug;
                }
            }
        }

        $attribute_options        = self::get_attribute_types( [ 'default' ] );
        $visible_term_control     = ( in_array( $args['type'], [ 'default', 'select' ] ) ? 'no' : 'yes' );
        $visible_term_select_type = ( $args['type'] === 'custom' ? 'yes' : 'no' ); 
        ?>
        <?php foreach ( $terms as $term ): ?>
            <div class="hvsfw-accordion" data-accordion="term">
                <div class="hvsfw-accordion__head">
                    <span class="hvsfw-accordion__title">
                        <?php echo esc_html( $term['name'] ); ?>
                    </span>
                    <div class="hvsfw-term-control hvsfw-flex hvsfw-flex-ai-c" data-visible="<?php echo $visible_term_control; ?>">
                        <div class="hvsfw-term-select-type hvsfw-flex hvsfw-flex-ai-c hvsfw-mr-10" data-visible="<?php echo $visible_term_select_type; ?>">
                            <span class="hvsfw-mr-10">Type</span>
                            <select class="hvsfw-field-term-type hvsfw-field__select-type" name="<?php echo self::get_name( [ $args['name'], $term['slug'], 'type' ] ); ?>">
                                <?php foreach ( $attribute_options as $key => $option ): ?>
                                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $args['type'], $key ); ?>>
                                        <?php echo esc_html( $option ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="open" title="open">
                            <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                        </button>
                    </div>
                </div>
                <div class="hvsfw-accordion__body" data-state="close">
                    <div class="hvsfw-accordion__content">
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php
    }

    /**
     * Render the attribute style wrapper component.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the arguments for rendering style components.
     * $args = [
     *     'accordion' => (string)  The name of the accordion or prefix.
     *     'title'     => (string)  The title or label of accordion.
     *     'type'      => (string)  The type of the swatch.
     *     'setting'   => (array)   The product swatch style value from _hvsfw_value post meta.
     *     'root_name' => (string)  The root name, will be used in field attribute name.
     * ]
     */
    private static function style_component( $args = [] ) {
        $parameters = [ 'accordion', 'title', 'type', 'setting', 'root_name' ];
        if ( Helper::has_array_unset( $args, $parameters ) ) {
            return;
        }

        // Set the default setting value.
        $defaults = [];
        foreach ( Helper::get_swatch_setting_schema() as $key => $field ) {
            $defaults[ $key ] = $field['default'];
        }
        unset( $defaults['type'] );

        // Set the current setting value, replace with default if value is empty.
        $settings = $args['setting'];
        foreach ( $defaults as $key => $default  ) {
            $settings[ $key ] = ( isset( $settings[ $key ] ) ? $settings[ $key ] : $default );
        }

        // Set the group field visibility.
        $settings['type']  = $args['type'];
        $settings['style'] = 'custom';
        $field_visibility  = Helper::get_swatch_setting_group_field_visibility( $settings );
        ?>
        <div class="hvsfw-accordion" data-accordion="<?php echo $args['accordion']; ?>">
            <div class="hvsfw-accordion__head">
                <span class="hvsfw-accordion__title">
                    <?php echo esc_html( $args['title'] ); ?>
                </span>
                <button type="button" class="hvsfw-accordion__toggle-btn hvsfw-flex-cc" data-state="close" aria-label="open" title="open">
                    <span class="hvsfw-accordion__chevron hvsfw-dashicon"></span>
                </button>
            </div>
            <div class="hvsfw-accordion__body" data-state="close">
                <div class="hvsfw-accordion__content">
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_style'; ?>" data-visible="<?php echo $field_visibility['style']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_style'; ?>" class="hvsfw-field__label">Style</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <select name="<?php echo $args['root_name'] . '[style]'; ?>" id="<?php echo $args['root_name'] . '_style'; ?>" class="hvsfw-setting-field-style" data-prefix="<?php echo $args['root_name']; ?>">
                                        <option value="default" <?php selected( $settings['style'], 'default' ); ?>>Default</option>
                                        <option value="custom" <?php selected( $settings['style'], 'custom' ); ?>>Custom</option>
                                    </select>
                                </div>
                                <?php echo wc_help_tip( 'Select whether to use the default style from main settings or assign a custom style in this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_shape'; ?>" data-visible="<?php echo $field_visibility['shape']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_shape'; ?>" class="hvsfw-field__label">Shape</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <select name="<?php echo $args['root_name'] . '[shape]'; ?>" id="<?php echo $args['root_name'] . '_shape'; ?>" class="hvsfw-setting-field-shape" data-prefix="<?php echo $args['root_name']; ?>">
                                        <option value="square" <?php selected( $settings['shape'], 'square' ); ?>>Square</option>
                                        <option value="circle" <?php selected( $settings['shape'], 'circle' ); ?>>Circle</option>
                                        <option value="custom" <?php selected( $settings['shape'], 'custom' ); ?>>Custom</option>
                                    </select>
                                </div>
                                <?php echo wc_help_tip( 'Select your preferred shape of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_size'; ?>" data-visible="<?php echo $field_visibility['size']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_size'; ?>" class="hvsfw-field__label">Size</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[size]'; ?>" id="<?php echo $args['root_name'] . '_size'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['size'] ); ?>">
                                </div>
                                <?php echo wc_help_tip( 'The size or width & height of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_dimension'; ?>" data-visible="<?php echo $field_visibility['dimension']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_width'; ?>" class="hvsfw-field__label">Size</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_width'; ?>" class="hvsfw-field__label--sub">Width</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[width]'; ?>" id="<?php echo $args['root_name'] . '_width'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['width'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_height'; ?>" class="hvsfw-field__label--sub">Height</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[height]'; ?>" id="<?php echo $args['root_name'] . '_height'; ?>" placeholder="40px" value="<?php echo esc_attr( $settings['height'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The width and height of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_font'; ?>" data-visible="<?php echo $field_visibility['font']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_font_size'; ?>" class="hvsfw-field__label">Font</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_size'; ?>" class="hvsfw-field__label--sub">Size</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[font_size]'; ?>" id="<?php echo $args['root_name'] . '_font_size'; ?>" placeholder="14px" value="<?php echo esc_attr( $settings['font_size'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_weight'; ?>" class="hvsfw-field__label--sub">Weight</label>
                                            <select name="<?php echo $args['root_name'] . '[font_weight]'; ?>" id="<?php echo $args['root_name'] . '_font_weight'; ?>">
                                                <?php foreach ( Helper::get_font_weight_choices() as $value ): ?>
                                                    <option value="<?php echo $value['value']; ?>" <?php selected( $settings['font_weight'], $value['value'] ); ?>>
                                                        <?php echo $value['label']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The font size and weight of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_text_color'; ?>" data-visible="<?php echo $field_visibility['text_color']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-field__label">Text Color</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-field__label--sub">Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[font_color]'; ?>" id="<?php echo $args['root_name'] . '_font_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_font_hover_color'; ?>" class="hvsfw-field__label--sub">Active Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[font_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_font_hover_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['font_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The text color of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_background_color'; ?>" data-visible="<?php echo $field_visibility['background_color']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-field__label">Background Color</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-field__label--sub">Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[background_color]'; ?>" id="<?php echo $args['root_name'] . '_background_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_background_hover_color'; ?>" class="hvsfw-field__label--sub">Active Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[background_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_background_hover_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['background_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The background color of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_padding'; ?>" data-visible="<?php echo $field_visibility['padding']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_padding_top'; ?>" class="hvsfw-field__label">Padding</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid hvsfw-mb-10">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_top'; ?>" class="hvsfw-field__label--sub">Top</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_top]'; ?>" id="<?php echo $args['root_name'] . '_padding_top'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_top'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_bottom'; ?>" class="hvsfw-field__label--sub">Bottom</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_bottom]'; ?>" id="<?php echo $args['root_name'] . '_padding_bottom'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_bottom'] ); ?>">
                                        </div>
                                    </div>
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_left'; ?>" class="hvsfw-field__label--sub">Left</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_left]'; ?>" id="<?php echo $args['root_name'] . '_padding_left'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_left'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_padding_right'; ?>" class="hvsfw-field__label--sub">Right</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[padding_right]'; ?>" id="<?php echo $args['root_name'] . '_padding_right'; ?>" placeholder="5px" value="<?php echo esc_attr( $settings['padding_right'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The padding of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_border'; ?>" data-visible="<?php echo $field_visibility['border']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_border_style'; ?>" class="hvsfw-field__label">Border</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <div class="hvsfw-field__grid hvsfw-mb-10">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_style'; ?>" class="hvsfw-field__label--sub">Style</label>
                                            <select name="<?php echo $args['root_name'] . '[border_style]'; ?>" id="<?php echo $args['root_name'] . '_border_style'; ?>">
                                                <?php foreach ( Helper::get_border_style_choices() as $value ): ?>
                                                    <option value="<?php echo $value['value']; ?>" <?php selected( $settings['border_style'], $value['value'] ); ?>>
                                                        <?php echo $value['label']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_width'; ?>" class="hvsfw-field__label--sub">Width</label>
                                            <input type="text" name="<?php echo $args['root_name'] . '[border_width]'; ?>" id="<?php echo $args['root_name'] . '_border_width'; ?>" placeholder="1px" value="<?php echo esc_attr( $settings['border_width'] ); ?>">
                                        </div>
                                    </div>
                                    <div class="hvsfw-field__grid">
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_color'; ?>" class="hvsfw-field__label--sub">Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[border_color]'; ?>" id="<?php echo $args['root_name'] . '_border_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_color'] ); ?>">
                                        </div>
                                        <div class="hvsfw-field__grid__col">
                                            <label for="<?php echo $args['root_name'] . '_border_hover_color'; ?>" class="hvsfw-field__label--sub">Active Color</label>
                                            <input type="hidden" name="<?php echo $args['root_name'] . '[border_hover_color]'; ?>" id="<?php echo $args['root_name'] . '_border_hover_color'; ?>" class="hvsfw-color-picker" value="<?php echo esc_attr( $settings['border_hover_color'] ); ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php echo wc_help_tip( 'The border of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="hvsfw-field" data-group-field="<?php echo $args['root_name'] . '_border_radius'; ?>" data-visible="<?php echo $field_visibility['border_radius']; ?>">
                        <div class="hvsfw-field__col--left">
                            <label for="<?php echo $args['root_name'] . '_border_radius'; ?>" class="hvsfw-field__label">Border Radius</label>
                        </div>
                        <div class="hvsfw-field__col--right">
                            <div class="hvsfw-field__wrap">
                                <div class="hvsfw-field__fluid">
                                    <input type="text" name="<?php echo $args['root_name'] . '[border_radius]'; ?>" id="<?php echo $args['root_name'] . '_border_radius'; ?>" placeholder="0px" value="<?php echo esc_attr( $settings['border_radius'] ); ?>">
                                </div>
                                <?php echo wc_help_tip( 'The border radius of this variation swatch attribute.' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}