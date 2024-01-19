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
 * @author  Mafel John Cahucom
 */
final class Form {

	/**
	 * Inherit Singleton.
     * 
     * @since 1.0.0
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
     * Holds the field's schema.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private static $schema = [];

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
     * @param  array  $args  Contains the arguments for rendering form.
     * $args = [
     *     'instance'   => (array)  Contains the available instance of the form.
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
        self::$schema       = LocalHelper::get_fields_schema();
        self::$display_type = LocalHelper::get_display_type( self::$instance );

        ob_start();
        ?>
            <div class="hvsfw-vf">
                <?php 
                    echo self::get_accordion([
                        'title'   => __( 'General', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mt-10 hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::general_form(),
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'Title', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::title_form()
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'List Style', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::list_form(),
                        'is_show' => self::is_show_accordion( 'list' )
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'Select Style', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::select_form(),
                        'is_show' => self::is_show_accordion( 'select' )
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'Button Style', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::button_form(),
                        'is_show' => self::is_show_accordion( 'button' )
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'Color Style', HVSFW_PLUGIN_DOMAIN ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::color_form(),
                        'is_show' => self::is_show_accordion( 'color' )
                    ]);

                    echo self::get_accordion([
                        'title'   => __( 'Image Style', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['general'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_attribute_field();

                echo self::get_select_field([
                    'name'    => '[general][show_count]',
                    'default' => $schema['show_count']['default'],
                    'options' => $schema['show_count']['choices'],
                    'label'   => __( 'Show Product Count', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_select_field([
                    'name'    => '[general][display_type]',
                    'default' => $schema['display_type']['default'],
                    'options' => $schema['display_type']['choices'],
                    'label'   => __( 'Display Type', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_select_field([
                    'name'    => '[general][query_type]',
                    'default' => $schema['query_type']['default'],
                    'options' => $schema['query_type']['choices'],
                    'label'   => __( 'Query Type', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['title'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_text_field([
                    'name'    => '[title][text]',
                    'default' => $schema['text']['default'],
                    'label'   => __( 'Title', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[title][font_size]',
                    'default' => $schema['font_size']['default'],
                    'label'   => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_select_field([
                    'name'    => '[title][font_weight]',
                    'default' => $schema['font_weight']['default'],
                    'options' => $schema['font_weight']['choices'],
                    'label'   => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[title][line_height]',
                    'default' => $schema['line_height']['default'],
                    'label'   => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[title][margin_bottom]',
                    'default' => $schema['margin_bottom']['default'],
                    'label'   => __( 'Margin Bottom', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_color_field([
                    'name'    => '[title][color]',
                    'default' => $schema['color']['default'],
                    'label'   => __( 'Color', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['list'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_size_field([
                    'name'    => '[list][font_size]',
                    'default' => $schema['font_size']['default'],
                    'label'   => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_select_field([
                    'name'    => '[list][font_weight]',
                    'default' => $schema['font_weight']['default'],
                    'options' => $schema['font_weight']['choices'],
                    'label'   => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[list][line_height]',
                    'default' => $schema['line_height']['default'],
                    'label'   => __( 'Line Height', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[list][margin_bottom]',
                    'default' => $schema['margin_bottom']['default'],
                    'label'   => __( 'Margin Bottom', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_grid_field([
                    'name'   => '[list][grouped][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[list][color]',
                            'default' => $schema['color']['default'],
                            'label'   => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[list][color_active]',
                            'default' => $schema['color_active']['default'],
                            'label'   => __( 'Text Color Active', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['select'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_grid_field([
                    'name'   => '[select][group][size]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[select][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][font]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][font_size]',
                            'default' => $schema['font_size']['default'],
                            'label'   => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[select][font_weight]',
                            'default' => $schema['font_weight']['default'],
                            'options' => $schema['font_weight']['choices'],
                            'label'   => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][padding]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][padding_top]',
                            'default' => $schema['padding_top']['default'],
                            'label'   => __( 'Padding Top', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_right]',
                            'default' => $schema['padding_right']['default'],
                            'label'   => __( 'Padding Right', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_bottom]',
                            'default' => $schema['padding_bottom']['default'],
                            'label'   => __( 'Padding Bottom', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[select][padding_left]',
                            'default' => $schema['padding_left']['default'],
                            'label'   => __( 'Padding Left', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[select][color]',
                            'default' => $schema['color']['default'],
                            'label'   => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[select][background_color]',
                            'default' => $schema['background_color']['default'],
                            'label'   => __( 'Background Color', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[select][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[select][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[select][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[select][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['button'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[button][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][size]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[button][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][font]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][font_size]',
                            'default' => $schema['font_size']['default'],
                            'label'   => __( 'Font Size', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[button][font_weight]',
                            'default' => $schema['font_weight']['default'],
                            'options' => $schema['font_weight']['choices'],
                            'label'   => __( 'Font Weight', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][padding]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][padding_top]',
                            'default' => $schema['padding_top']['default'],
                            'label'   => __( 'Padding Top', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_right]',
                            'default' => $schema['padding_right']['default'],
                            'label'   => __( 'Padding Right', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_bottom]',
                            'default' => $schema['padding_bottom']['default'],
                            'label'   => __( 'Padding Bottom', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[button][padding_left]',
                            'default' => $schema['padding_left']['default'],
                            'label'   => __( 'Padding Left', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][colors]',
                    'fields' => [
                        self::get_color_field([
                            'name'    => '[button][text_color]',
                            'default' => $schema['text_color']['default'],
                            'label'   => __( 'Text Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[button][text_color_active]',
                            'default' => $schema['text_color_active']['default'],
                            'label'   => __( 'Text Color Active', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[button][background_color]',
                            'default' => $schema['background_color']['default'],
                            'label'   => __( 'Background Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[button][background_color_active]',
                            'default' => $schema['background_color_active']['default'],
                            'label'   => __( 'Background Color Active', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[button][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[button][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[button][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[button][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[button][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[button][border_radius]',
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[button][shape]', 'custom', 'no', '==' ),
                    'label'   => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[button][gap]',
                    'default' => $schema['gap']['default'],
                    'label'   => __( 'Gap', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['color'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[color][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[color][size]',
                    'default' => $schema['size']['default'],
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'yes', '!=' ),
                    'label'   => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_grid_field([
                    'name'    => '[color][group][size]',
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' ),
                    'fields'  => [
                        self::get_size_field([
                            'name'    => '[color][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[color][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[color][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[color][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[color][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[color][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[color][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[color][border_radius]',
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' ),
                    'label'   => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[color][gap]',
                    'default' => $schema['gap']['default'],
                    'label'   => __( 'Gap', HVSFW_PLUGIN_DOMAIN ),
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
        $schema = self::$schema['image'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field([
                    'name'    => '[image][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_size_field([
                    'name'    => '[image][size]',
                    'default' => $schema['size']['default'],
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'yes', '!=' ),
                    'label'   => __( 'Size', HVSFW_PLUGIN_DOMAIN ),
                ]);

                echo self::get_grid_field([
                    'name'    => '[image][group][size]',
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' ),
                    'fields'  => [
                        self::get_size_field([
                            'name'    => '[image][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_size_field([
                            'name'    => '[image][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', HVSFW_PLUGIN_DOMAIN ),
                        ])
                    ]
                ]);

                echo self::get_grid_field([
                    'name'   => '[image][group][border]',
                    'fields' => [
                        self::get_size_field([
                            'name'    => '[image][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_select_field([
                            'name'    => '[image][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[image][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                        self::get_color_field([
                            'name'    => '[image][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', HVSFW_PLUGIN_DOMAIN ),
                        ]),
                    ]
                ]);

                echo self::get_size_field([
                    'name'    => '[image][border_radius]',
                    'label'   => __( 'Border Radius', HVSFW_PLUGIN_DOMAIN ),
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' )
                ]);

                echo self::get_size_field([
                    'name'    => '[image][gap]',
                    'label'   => __( 'Gap', HVSFW_PLUGIN_DOMAIN ),
                    'default' => $schema['gap']['default']
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
            <label for="<?php echo $field_id; ?>">
                <?php echo __( 'Product Attributes', HVSFW_PLUGIN_DOMAIN ); ?>
            </label>
            <select class="hvsfw-vf-select" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" data-input="<?php echo $name; ?>" data-type="<?php echo self::$display_type; ?>"/>
                <option value="" data-type="">
                    <?php echo __( 'Select Attribute', HVSFW_PLUGIN_DOMAIN ); ?>
                </option>
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
     * @param  array  $args  Contains the arguments for creating size field.
     * $args = [
     *     'name'    => (string) Contains the name of the size field.
     *     'default' => (string) Contains the default value of the size field. 
     *     'label'   => (string) Contains the label of the size field.
     *     'class'   => (string) Contains the additional class of size field.
     *     'is_show' => (string) Contains the visibility state of the size field [yes, no].
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

        // For [title][text] only.
        if ( $name === '[title][text]' ) {
            if ( ! isset( self::$instance['title']['text'] ) ) {
                $value = $default;
            } else {
                $value = self::get_value( $name );
            }
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-form__field" data-field="<?php echo $name; ?>" data-show="<?php echo $is_show; ?>">
            <label for="<?php echo $field_id; ?>">
                <?php echo esc_html( $label ) ?>
            </label>
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
     * @param  array  $args  Contains the arguments for creating select field.
     * $args = [
     *     'name'        => (string) Contains the name of the select field.
     *     'default'     => (string) Contains the default value of the select field. 
     *     'options'     => (array)  Contains the options value of the select field.
     *     'label'       => (string) Contains the label of the select field.
     *     'is_show'     => (string) Contains the visibility state of the input field [yes, no].
     *     'placeholder' => (string) Contains the placeholder of the select field.
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
            <label for="<?php echo $field_id; ?>">
                <?php echo esc_html( $label ) ?>
            </label>
            <select class="hvsfw-vf-select" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" data-input="<?php echo $name; ?>"/>
                <?php if ( ! empty( $placeholder ) ): ?>
                    <option>
                        <?php echo esc_html( $placeholder ); ?>
                    </option>
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
     * @param  array  $args  Contains the arguments for creating size field.
     * $args = [
     *     'name'    => (string) Contains the name of the size field.
     *     'default' => (string) Contains the default value of the size field. 
     *     'label'   => (string) Contains the label of the size field.
     *     'class'   => (string) Contains the additional class of size element.
     *     'is_show' => (string) Contains the visibility state of the size field [yes, no].
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
     * @param  array  $args  Contains the arguments for creating color picker field.
     * $args = [
     *     'name'    => (string) Contains the name of the color picker field.
     *     'default' => (string) Contains the default value of the color picker field. 
     *     'label'   => (string) Contains the label of the color picker field.
     *     'class'   => (string) Contains the additional class of color picker element.
     *     'is_show' => (string) Contains the visibility state of the color picker field [yes, no].
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
     * @param  array  $args  Contains the arguments for creating grid field.
     * $args = [
     *     'name'    => (string) Contains the name of the grid field.
     *     'is_show' => (string) Contains the visibility state of the grid field [yes, no].
     *     'fields'  => (array)  Contains the sub fields to be rendered.
     * ]
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
     *     'title'   => (string) Contains the title or label of the accordion.
     *     'content' => (string) Contains the content or form to be render.
     *     'class'   => (string) Contains the additional class.
     *     'is_show' => (string) Contains the visibility state of the accordion [yes, no].
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
     * @param  string  $name     Contains the name of the field.
     * @param  string  $default  Contains the default value of the field.
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
     * @param  string  $display_type  Contains the final display type.
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
     * @param  string  $field     Contains the name of the field.
     * @param  mixed   $value     Contains the expected value of field to return true.
     * @param  string  $default   Contains the default value if field_value is empty.
     * @param  string  $operator  Contains the condition operator.
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
     * @param  string  $field  Contains the name of the field.
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
     * @param  string  $name  Contains the name of the field.
     * @return string
     */
    private static function field_name( $name ) {
        $prefix = substr( self::$field_name, 0, -2 );

        return $prefix . $name;
    }
}