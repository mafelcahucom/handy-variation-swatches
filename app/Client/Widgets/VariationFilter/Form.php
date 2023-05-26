<?php
namespace HVSFW\Client\Widgets\VariationFilter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Widgets\VariationFilter\Inc\LocalHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Variation Filter Form.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Form {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the widget form instance.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private static $instance = [];

    /**
     * Holds the unique widget prefix.
     * 
     * @since 1.0.0
     *
     * @var string
     */
    private static $field_id = '';

    /**
     * Holds the prefix for input name.
     * 
     * @since 1.0.0
     *
     * @var string
     */
    private static $field_name = '';

    /**
     * Holds the display type.
     * 
     * @since 1.0.0
     *
     * @var string
     */
    private static $display_type = '';

	/**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Render Variation Filter Form.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains the arguments for rendering widget form.
     * $args = [
     *     'instance'   => (array)  The available instance of the form.
     *     'field_id'   => (string) Contains the unique widget prefix.
     *     'field_name' => (string) Contains the prefix for input name.
     * ]
     * @return HTMLElement
     */
    public static function render( $args = [] ) {
        $parameters = [ 'instance', 'field_id', 'field_name' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        self::$instance     = ( ! empty( $args['instance'] ) ? $args['instance'] : [] );
        self::$field_id     = ( ! empty( $args['field_id'] ) ? $args['field_id'] : '' );
        self::$field_name   = ( ! empty( $args['field_name'] ) ? $args['field_name'] : '' );
        self::$display_type = self::get_display_type();

        ob_start();
        ?>
            <div class="hvsfw-vf">
                <?php 
                    echo self::get_accordion([
                        'title'   => 'General',
                        'class'   => 'hvsfw-vf-mt-10 hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::general_form(),
                    ]);

                    echo self::get_accordion([
                        'title'   => 'Title',
                        'class'   => 'hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::title_form()
                    ]);

                    echo self::get_accordion([
                        'title'   => 'List Style',
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::list_form(),
                        'is_show' => self::is_show_accordion( 'list' )
                    ]);

                    echo self::get_accordion([
                        'title'   => 'Select Style',
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::select_form(),
                        'is_show' => self::is_show_accordion( 'select' )
                    ]);

                    echo self::get_accordion([
                        'title'   => 'Button Style',
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::button_form(),
                        'is_show' => self::is_show_accordion( 'button' )
                    ]);

                    echo self::get_accordion([
                        'title'   => 'Color Style',
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::color_form(),
                        'is_show' => self::is_show_accordion( 'color' )
                    ]);

                    echo self::get_accordion([
                        'title'   => 'Image Style',
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::image_form(),
                        'is_show' => self::is_show_accordion( 'image' )
                    ]);
                ?>
            </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the general settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function general_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_attribute_field();

                echo self::get_select_field([
                    'name'    => '[general][show_count]',
                    'label'   => 'Show Product Count',
                    'default' => 'yes',
                    'options' => [ 'yes', 'no' ]
                ]);

                echo self::get_select_field([
                    'name'    => '[general][display_type]',
                    'label'   => 'Display Type',
                    'default' => 'swatch',
                    'options' => [ 'swatch', 'select', 'list' ]
                ]);

                echo self::get_select_field([
                    'name'    => '[general][query_type]',
                    'label'   => 'Query Type',
                    'default' => 'or',
                    'options' => [ 'or', 'and' ]
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the title settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function title_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_text_field([
                    'name'    => '[title][text]',
                    'label'   => 'Title',
                    'default' => 'Filter by'
                ]);

                echo self::get_size_field([
                    'name'    => '[title][font_size]',
                    'label'   => 'Font Size',
                    'default' => '22px'
                ]);

                echo self::get_select_field([
                    'name'    => '[title][font_weight]',
                    'label'   => 'Font Weight',
                    'default' => '500',
                    'options' => LocalHelper::get_font_weights()
                ]);

                echo self::get_size_field([
                    'name'    => '[title][line_height]',
                    'label'   => 'Line Height',
                    'default' => '26px'
                ]);

                echo self::get_size_field([
                    'name'    => '[title][margin_bottom]',
                    'label'   => 'Margin Bottom',
                    'default' => '20px'
                ]);

                echo self::get_color_field([
                    'name'    => '[title][color]',
                    'label'   => 'Color',
                    'default' => '#000000'
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the list settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function list_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_size_field([
                    'name'    => '[list][font_size]',
                    'label'   => 'Font Size',
                    'default' => '16px'
                ]);

                echo self::get_select_field([
                    'name'    => '[list][font_weight]',
                    'label'   => 'Font Weight',
                    'default' => '400',
                    'options' => LocalHelper::get_font_weights()
                ]);

                echo self::get_size_field([
                    'name'    => '[list][line_height]',
                    'label'   => 'Line Height',
                    'default' => '20px'
                ]);

                echo self::get_size_field([
                    'name'    => '[list][margin_bottom]',
                    'label'   => 'Margin Bottom',
                    'default' => '5px'
                ]);

                echo self::get_grid_field([
                    'name'   => '[list][grouped][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[list][color]',
                            'label'   => 'Text Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[list][color_active]',
                            'label'   => 'Text Color Active',
                            'default' => '#0071F2'
                        ])
                    ]
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the select settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function select_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_grid_field([
                    'name'   => '[select][group][size]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][width]',
                            'label'   => 'Width',
                            'default' => '100%'
                        ]),
                        self::get_size_field([
                            'name'    => '[select][height]',
                            'label'   => 'Height',
                            'default' => '30px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][font]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][font_size]',
                            'label'   => 'Font Size',
                            'default' => '14px'
                        ]),
                        self::get_select_field([
                            'name'    => '[select][font_weight]',
                            'label'   => 'Font Weight',
                            'default' => '400',
                            'options' => LocalHelper::get_font_weights()
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][padding]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][padding_top]',
                            'label'   => 'Padding Top',
                            'default' => '0px'
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_right]',
                            'label'   => 'Padding Right',
                            'default' => '24px'
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_bottom]',
                            'label'   => 'Padding Bottom',
                            'default' => '0px'
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_left]',
                            'label'   => 'Padding Left',
                            'default' => '8px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[select][color]',
                            'label'   => 'Text Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[select][background_color]',
                            'label'   => 'Background Color',
                            'default' => '#ffffff'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][border_width]',
                            'label'   => 'Border Width',
                            'default' => '1px'
                        ]),
                        self::get_select_field([
                            'name'    => '[select][border_style]',
                            'label'   => 'Border Style',
                            'default' => 'solid',
                            'options' => LocalHelper::get_border_styles()
                        ]),
                        self::get_color_field([
                            'name'    => '[select][border_color]',
                            'label'   => 'Border Color',
                            'default' => '#000000'
                        ]),
                    ]
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the button settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function button_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[button][shape]',
                    'label'   => 'Shape',
                    'default' => 'square',
                    'options' => [ 'square', 'circle', 'custom' ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][size]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][width]',
                            'label'   => 'Width',
                            'default' => '40px'
                        ]),
                        self::get_size_field([
                            'name'    => '[button][height]',
                            'label'   => 'Height',
                            'default' => '40px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][font]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][font_size]',
                            'label'   => 'Font Size',
                            'default' => '14px'
                        ]),
                        self::get_select_field([
                            'name'    => '[button][font_weight]',
                            'label'   => 'Font Weight',
                            'default' => '400',
                            'options' => LocalHelper::get_font_weights()
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][padding]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][padding_top]',
                            'label'   => 'Padding Top',
                            'default' => '5px'
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_right]',
                            'label'   => 'Padding Right',
                            'default' => '5px'
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_bottom]',
                            'label'   => 'Padding Bottom',
                            'default' => '5px'
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_left]',
                            'label'   => 'Padding Left',
                            'default' => '5px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[button][text_color]',
                            'label'   => 'Text Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[button][text_active_color]',
                            'label'   => 'Text Color Active',
                            'default' => '#0071F2'
                        ]),
                        self::get_color_field([
                            'name'    => '[button][background_color]',
                            'label'   => 'Background Color',
                            'default' => '#ffffff'
                        ]),
                        self::get_color_field([
                            'name'    => '[button][background_color_active]',
                            'label'   => 'Background Color Active',
                            'default' => '#ffffff'
                        ]),
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][border_width]',
                            'label'   => 'Border Width',
                            'default' => '1px'
                        ]),
                        self::get_select_field([
                            'name'    => '[button][border_style]',
                            'label'   => 'Border Style',
                            'default' => 'solid',
                            'options' => LocalHelper::get_border_styles()
                        ]),
                        self::get_color_field([
                            'name'    => '[button][border_color]',
                            'label'   => 'Border Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[button][border_color_active]',
                            'label'   => 'Border Color Active',
                            'default' => '#0071F2'
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[button][border_radius]',
                    'label'   => 'Border Radius',
                    'default' => '0px',
                    'is_show' => self::is_show_field( '[button][shape]', 'custom', 'no', '==' )
                ]);

                echo self::get_size_field([
                    'name'    => '[button][gap]',
                    'label'   => 'Gap',
                    'default' => '10px'
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the color settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function color_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[color][shape]',
                    'label'   => 'Shape',
                    'default' => 'square',
                    'options' => [ 'square', 'circle', 'custom' ]
                ]);

                echo self::get_size_field([
                    'name'    => '[color][size]',
                    'label'   => 'Size',
                    'default' => '40px',
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'yes', '!=' )
                ]);

                echo self::get_grid_field([
                    'name'    => '[color][group][size]',
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' ),
                    'fields'  => [
                        self::get_size_field([
                            'name'    => '[color][width]',
                            'label'   => 'Width',
                            'default' => '40px'
                        ]),
                        self::get_size_field([
                            'name'    => '[color][height]',
                            'label'   => 'Height',
                            'default' => '40px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[color][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[color][border_width]',
                            'label'   => 'Border Width',
                            'default' => '1px'
                        ]),
                        self::get_select_field([
                            'name'    => '[color][border_style]',
                            'label'   => 'Border Style',
                            'default' => 'solid',
                            'options' => LocalHelper::get_border_styles()
                        ]),
                        self::get_color_field([
                            'name'    => '[color][border_color]',
                            'label'   => 'Border Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[color][border_color_active]',
                            'label'   => 'Border Color Active',
                            'default' => '#0071F2'
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[color][border_radius]',
                    'label'   => 'Border Radius',
                    'default' => '0px',
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' )
                ]);

                echo self::get_size_field([
                    'name'    => '[color][gap]',
                    'label'   => 'Gap',
                    'default' => '10px'
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the image settings form.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function image_form() {
        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[image][shape]',
                    'label'   => 'Shape',
                    'default' => 'square',
                    'options' => [ 'square', 'circle', 'custom' ]
                ]);

                echo self::get_size_field([
                    'name'    => '[image][size]',
                    'label'   => 'Size',
                    'default' => '40px',
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'yes', '!=' )
                ]);

                echo self::get_grid_field([
                    'name'    => '[image][group][size]',
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' ),
                    'fields'  => [
                        self::get_size_field([
                            'name'    => '[image][width]',
                            'label'   => 'Width',
                            'default' => '40px'
                        ]),
                        self::get_size_field([
                            'name'    => '[image][height]',
                            'label'   => 'Height',
                            'default' => '40px'
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[image][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[image][border_width]',
                            'label'   => 'Border Width',
                            'default' => '1px'
                        ]),
                        self::get_select_field([
                            'name'    => '[image][border_style]',
                            'label'   => 'Border Style',
                            'default' => 'solid',
                            'options' => LocalHelper::get_border_styles()
                        ]),
                        self::get_color_field([
                            'name'    => '[image][border_color]',
                            'label'   => 'Border Color',
                            'default' => '#000000'
                        ]),
                        self::get_color_field([
                            'name'    => '[image][border_color_active]',
                            'label'   => 'Border Color Active',
                            'default' => '#0071F2'
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[image][border_radius]',
                    'label'   => 'Border Radius',
                    'default' => '0px',
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' )
                ]);

                echo self::get_size_field([
                    'name'    => '[image][gap]',
                    'label'   => 'Gap',
                    'default' => '10px'
                ]);
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the attribute field.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_attribute_field() {
        $name       = '[general][attribute]';
        $value      = self::get_value( $name );
        $field_id   = self::field_id( $name );
        $field_name = self::field_name( $name );
        $attributes = Utility::get_available_attributes();
        
        ob_start();
        ?>
        <div class="hvsfw-vf-form__field" data-field="<?php echo $name; ?>" data-show="yes">
            <label for="<?php echo $field_id; ?>">Product Attributes</label>
            <select class="hvsfw-vf-select" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" data-input="<?php echo $name; ?>" data-type="<?php echo self::$display_type; ?>"/>
                <option value="" data-type="">Select Attribute</option>
                <?php if ( ! empty( $attributes ) ): ?>
                    <?php foreach ( $attributes as $attribute ): ?>
                        <option value="<?php echo esc_attr( $attribute['attribute_name'] ); ?>" data-type="<?php echo esc_attr( $attribute['attribute_type'] ) ?>" <?php selected( $attribute['attribute_name'], $value ) ?>>
                            <?php echo esc_html( $attribute['attribute_label'] ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            <select>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the text field.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for creating size field.
     * $args = [
     *     'name'    => (string) The name of the size field.
     *     'default' => (string) The default value of the size field. 
     *     'label'   => (string) The label of the size field.
     *     'class'   => (string) The additional class of size field.
     *     'is_show' => (string) The visibility state of the size field [yes, no].
     * ]
     * @return HTMLElement
     */
    private static function get_text_field( $args = [] ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) ) {
            return;
        }

        $name       = $args['name'];
        $default    = ( isset( $args['default'] ) ? $args['default'] : '' );
        $label      = ( isset( $args['label'] ) ? $args['label'] : '' );
        $is_show    = ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' );
        $class      = ( isset( $args['class'] ) ? $args['class'] : '' );
        $value      = self::get_value( $name, $default );
        $field_id   = self::field_id( $name );
        $field_name = self::field_name( $name );

        ob_start();
        ?>
        <div class="hvsfw-vf-form__field" data-field="<?php echo $name; ?>" data-show="<?php echo $is_show; ?>">
            <label for="<?php echo $field_id; ?>"><?php echo esc_html( $label ) ?></label>
            <input type="text" class="hvsfw-vf-input <?php echo $class; ?>" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="<?php echo esc_attr( $value ); ?>" data-input="<?php echo $name; ?>"/>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the select field.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for creating select field.
     * $args = [
     *     'name'        => (string) The name of the select field.
     *     'default'     => (string) The default value of the select field. 
     *     'options'     => (array)  The options value of the select field.
     *     'label'       => (string) The label of the select field.
     *     'is_show'     => (string) The visibility state of the input field [yes, no].
     *     'placeholder' => (string) The placeholder of the select field.
     * ]
     * @return HTMLElement
     */
    private static function get_select_field( $args = [] ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) || ! isset( $args['options'] ) ) {
            return;
        }

        $name        = $args['name'];
        $options     = ( ! empty( $args['options'] ) ? $args['options'] : [] );
        $default     = ( isset( $args['default'] ) ? $args['default'] : '' );
        $label       = ( isset( $args['label'] ) ? $args['label'] : '' );
        $is_show     = ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' );
        $placeholder = ( isset( $args['placeholder'] ) ? $args['placeholder'] : '' );
        $value       = self::get_value( $name, $default );
        $field_id    = self::field_id( $name );
        $field_name  = self::field_name( $name );

        ob_start();
        ?>
        <div class="hvsfw-vf-form__field" data-field="<?php echo $name; ?>" data-show="<?php echo $is_show; ?>">
            <label for="<?php echo $field_id; ?>"><?php echo esc_html( $label ) ?></label>
            <select class="hvsfw-vf-select" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" data-input="<?php echo $name; ?>"/>
                <?php if ( ! empty( $placeholder ) ): ?>
                    <option><?php echo esc_html( $placeholder ); ?></option>
                <?php endif; ?>
                <?php if ( ! empty( $options ) ): ?>
                    <?php foreach ( $options as $option ): ?>
                        <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, $value ) ?>>
                            <?php echo esc_html( $option ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            <select>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the size field.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for creating size field.
     * $args = [
     *     'name'    => (string) The name of the size field.
     *     'default' => (string) The default value of the size field. 
     *     'label'   => (string) The label of the size field.
     *     'class'   => (string) The additional class of size element.
     *     'is_show' => (string) The visibility state of the size field [yes, no].
     * ]
     * @return HTMLElement
     */
    private static function get_size_field( $args = [] ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) ) {
            return;
        }

        return self::get_text_field([
            'name'    => $args['name'],
            'default' => ( isset( $args['default'] ) ? $args['default'] : '' ),
            'label'   => ( isset( $args['label'] ) ? $args['label'] : '' ),
            'is_show' => ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' ),
            'class'   => 'hvsfw-vf-size'
        ]);
    }

    /**
     * Return the color picker field.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for creating color picker field.
     * $args = [
     *     'name'    => (string) The name of the color picker field.
     *     'default' => (string) The default value of the color picker field. 
     *     'label'   => (string) The label of the color picker field.
     *     'class'   => (string) The additional class of color picker element.
     *     'is_show' => (string) The visibility state of the color picker field [yes, no].
     * ]
     * @return HTMLElement
     */
    private static function get_color_field( $args = [] ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) ) {
            return;
        }
        
        return self::get_text_field([
            'name'    => $args['name'],
            'default' => ( isset( $args['default'] ) ? $args['default'] : '' ),
            'label'   => ( isset( $args['label'] ) ? $args['label'] : '' ),
            'is_show' => ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' ),
            'class'   => 'hvsfw-vf-color'
        ]);
    }

    /**
     * Return a wrapped sub fields into two columns.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Containing the arguments for creating grid field.
     * $args = [
     *     'name'    => (string) The name of the grid field.
     *     'is_show' => (string) The visibility state of the grid field [yes, no].
     *     'fields'  => (array)  Contains the sub fields to be rendered.
     * ]
     * @return HTMLElement
     * @return HTMLElement
     */
    private static function get_grid_field( $args = [] ) {
        $no_name   = ( ! isset( $args['name'] ) || empty( $args['name'] ) );
        $no_fields = ( ! isset( $args['fields'] ) || empty( $args['fields'] ) );
        if ( $no_name || $no_fields ) {
            return;
        }

        $is_show  = ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' );

        ob_start();
        ?>
        <div class="hvsfw-vf-form__field hvsfw-vf-form__grid" data-field="<?php echo $args['name']; ?>" data-show="<?php echo $is_show; ?>">
            <?php foreach ( $args['fields'] as $field ): ?>
                <div class="hvsfw-vf-form__grid__child">
                    <?php echo $field; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the accordion component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains the arguments for rendering accordion.
     * $args = [
     *     'title'   => (string) The title or label of the accordion.
     *     'content' => (string) The content or form to be render.
     *     'class'   => (string) Contains the additional class.
     *     'is_show' => (string) The visibility state of the accordion [yes, no].
     * ]
     * @return HTMLElement
     */
    private static function get_accordion( $args = [] ) {
        $title   = ( isset( $args['title'] ) ? $args['title'] : '' );
        $content = ( isset( $args['content'] ) ? $args['content'] : '' );
        $class   = ( isset( $args['class'] ) ? $args['class'] : '' );
        $is_show = ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' );

        ob_start();
        ?>
        <div class="hvsfw-vf-accordion <?php echo esc_attr( $class ); ?>" data-title="<?php echo $title; ?>" data-show="<?php echo $is_show; ?>">
            <div class="hvsfw-vf-accordion__header">
                <div class="hvsfw-vf-accordion__left">
                    <b class="hvsfw-vf-accordion__title">
                        <?php echo esc_html( $title ); ?>
                    </b>
                </div>
                <div class="hvsfw-vf-accordion__right">
                    <button type="button" class="hvsfw-vf-accordion__toggle-btn" data-state="close">
                        <?php echo Helper::get_icon( 'bs-caret-down' ); ?>
                    </button>
                </div>
            </div>
            <div class="hvsfw-vf-accordion__body" data-state="close">
                <div class="hvsfw-vf-accordion__content">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the value of a field from widget form instance.
     * 
     * @since 1.0.0
     *
     * @param  string  $name     The name of the field.
     * @param  string  $default  The default value of the field.
     * @return string
     */
    private static function get_value( $name, $default = '' ) {
        if ( empty( $name ) ) {
            return $default;
        }

        $keys = explode( ']', $name );
        if ( empty( $keys ) ) {
            return $default;
        }

        $keys = array_map( function( $key ) {
            return substr( $key, 1 );
        }, $keys );

        $value    = self::$instance;
        $is_found = ( isset( $value[ $keys[0] ][ $keys[1] ] ) && ! empty( $value[ $keys[0] ][ $keys[1] ] ) );
        return ( $is_found ? $value[ $keys[0] ][ $keys[1] ] : $default );
    }

    /**
     * Return the final display type based on block display_type and
	 * product attribute_type.
     * 
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_display_type() {
        $attribute_name = self::get_value( '[general][attribute]' );
        if ( empty( $attribute_name ) ) {
            return '';
        }

        $attribute = Utility::get_attribute( $attribute_name );
        if ( empty( $attribute ) ) {
            return '';
        }

        $display_type = self::get_value( '[general][display_type]' );
        if ( empty( $display_type ) ) {
            return '';
        }

        if ( $display_type !== 'swatch' ) {
            return $display_type;
        }

        if ( in_array( $attribute['attribute_type'], [ 'button', 'color', 'image' ] ) ) {
            return $attribute['attribute_type'];
        }

        return 'select';
    }

    /**
     * Return a flag whether the current attribute exist.
     * 
     * @since 1.0.0
     *
     * @return boolean
     */
    private static function is_found_attribute() {
        $attribute_name = self::get_value( '[general][attribute]' );
        if ( empty( $attribute_name ) ) {
            return false;
        }

        $attribute = Utility::get_attribute( $attribute_name );
        if ( empty( $attribute ) ) {
            return false;
        }

        return true;
    }

    /**
     * Return a flag whether to display a certain accordion.
     * 
     * @since 1.0.0
     *
     * @param  string  $display_type  The final display type.
     * @return string
     */
    private static function is_show_accordion( $display_type ) {
        if ( empty( $display_type ) ) {
            return 'no';
        }

        $attribute_name = self::get_value( '[general][attribute]' );
        if ( empty( $attribute_name ) ) {
            return 'no';
        }
        
        if ( ! self::is_found_attribute() ) {
            return 'no';
        }

        if ( $display_type !== self::$display_type ) {
            return 'no';
        }

        return 'yes';
    }

    /**
     * Return a flag whether to display a certain field.
     * 
     * @since 1.0.0
     *
     * @param  string  $field     The name of the field.
     * @param  mixed   $value     The expected value of field to return true.
     * @param  string  $default   The default value if field_value is empty.
     * @param  string  $operator  The condition operator.
     * @return string
     */
    private static function is_show_field( $field, $value, $default, $operator ) {
        if ( empty( $field ) || empty( $value ) ) {
            return 'no';
        }

        $field_value = self::get_value( $field );
        if ( empty( $field_value ) ) {
            return $default;
        }

        switch ( $operator ) {
            case '==':
                return ( $field_value == $value ? 'yes' : 'no' );
                break;
            case '!=':
                return ( $field_value != $value ? 'yes' : 'no' );
                break;
        }

        return 'no';
    }

    /**
     * Return the field id with unique widget prefix.
     * 
     * @since 1.0.0
     *
     * @param  string  $field  The name of the field.
     * @return string
     */
    private static function field_id( $field ) {
        if ( empty( $field ) ) {
            return '';
        }

        return esc_attr( self::$field_id . $field );
    }

    /**
     * Return the input name attribute.
     * 
     * @since 1.0.0
     *
     * @param  string  $name  The name of the field.
     * @return string
     */
    private static function field_name( $name ) {
        $prefix = substr( self::$field_name, 0, -2 );

        return $prefix . $name;
    }
}