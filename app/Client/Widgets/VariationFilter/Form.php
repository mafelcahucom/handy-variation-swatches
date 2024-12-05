<?php
/**
 * App > Client > Widgets > Variation Filter > Form.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Widgets\VariationFilter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Widgets\VariationFilter\Inc\LocalHelper;

defined( 'ABSPATH' ) || exit;

/**
 * The `Form` class contains the Variation Filter form.
 *
 * @since 1.0.0
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
    private static $instance = array();

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
    private static $schema = array();

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
     * @param  array $args Contains the necessary arguments for rendering form.
     * $args = [
     *    'instance'   => (array)  Contains the available instance of the form.
     *    'field_id'   => (string) Contains the unique widget prefix.
     *    'field_name' => (string) Contains the prefix for input name.
     * ]
     * @return string
     */
    public static function render( $args = array() ) {
        $parameters = array( 'instance', 'field_id', 'field_name' );
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return;
        }

        self::$instance     = ( ! empty( $args['instance'] ) ? $args['instance'] : array() );
        self::$field_id     = ( ! empty( $args['field_id'] ) ? $args['field_id'] : '' );
        self::$field_name   = ( ! empty( $args['field_name'] ) ? $args['field_name'] : '' );
        self::$schema       = LocalHelper::get_fields_schema();
        self::$display_type = LocalHelper::get_display_type( self::$instance );

        ob_start();
        ?>
            <div class="hvsfw-vf">
                <?php
                    echo self::get_accordion(array(
                        'title'   => __( 'General', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mt-10 hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::general_form(),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'Title', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'is_show' => 'yes',
                        'content' => self::title_form(),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'List Style', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::list_form(),
                        'is_show' => self::is_show_accordion( 'list' ),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'Select Style', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::select_form(),
                        'is_show' => self::is_show_accordion( 'select' ),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'Button Style', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::button_form(),
                        'is_show' => self::is_show_accordion( 'button' ),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'Color Style', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::color_form(),
                        'is_show' => self::is_show_accordion( 'color' ),
                    ));

                    echo self::get_accordion(array(
                        'title'   => __( 'Image Style', 'handy-variation-swatches' ),
                        'class'   => 'hvsfw-vf-mb-10',
                        'content' => self::image_form(),
                        'is_show' => self::is_show_accordion( 'image' ),
                    ));
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
     * @return string
     */
    private static function general_form() {
        $schema = self::$schema['general'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_attribute_field();

                echo self::get_select_field(array(
                    'name'    => '[general][show_count]',
                    'default' => $schema['show_count']['default'],
                    'options' => $schema['show_count']['choices'],
                    'label'   => __( 'Show Product Count', 'handy-variation-swatches' ),
                ));

                echo self::get_select_field(array(
                    'name'    => '[general][display_type]',
                    'default' => $schema['display_type']['default'],
                    'options' => $schema['display_type']['choices'],
                    'label'   => __( 'Display Type', 'handy-variation-swatches' ),
                ));

                echo self::get_select_field(array(
                    'name'    => '[general][query_type]',
                    'default' => $schema['query_type']['default'],
                    'options' => $schema['query_type']['choices'],
                    'label'   => __( 'Query Type', 'handy-variation-swatches' ),
                ));
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
     * @return string
     */
    private static function title_form() {
        $schema = self::$schema['title'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_text_field(array(
                    'name'    => '[title][text]',
                    'default' => $schema['text']['default'],
                    'label'   => __( 'Title', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[title][font_size]',
                    'default' => $schema['font_size']['default'],
                    'label'   => __( 'Font Size', 'handy-variation-swatches' ),
                ));

                echo self::get_select_field(array(
                    'name'    => '[title][font_weight]',
                    'default' => $schema['font_weight']['default'],
                    'options' => $schema['font_weight']['choices'],
                    'label'   => __( 'Font Weight', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[title][line_height]',
                    'default' => $schema['line_height']['default'],
                    'label'   => __( 'Line Height', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[title][margin_bottom]',
                    'default' => $schema['margin_bottom']['default'],
                    'label'   => __( 'Margin Bottom', 'handy-variation-swatches' ),
                ));

                echo self::get_color_field(array(
                    'name'    => '[title][color]',
                    'default' => $schema['color']['default'],
                    'label'   => __( 'Color', 'handy-variation-swatches' ),
                ));
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
     * @return string
     */
    private static function list_form() {
        $schema = self::$schema['list'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_size_field(array(
                    'name'    => '[list][font_size]',
                    'default' => $schema['font_size']['default'],
                    'label'   => __( 'Font Size', 'handy-variation-swatches' ),
                ));

                echo self::get_select_field(array(
                    'name'    => '[list][font_weight]',
                    'default' => $schema['font_weight']['default'],
                    'options' => $schema['font_weight']['choices'],
                    'label'   => __( 'Font Weight', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[list][line_height]',
                    'default' => $schema['line_height']['default'],
                    'label'   => __( 'Line Height', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[list][margin_bottom]',
                    'default' => $schema['margin_bottom']['default'],
                    'label'   => __( 'Margin Bottom', 'handy-variation-swatches' ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[list][grouped][colors]',
                    'fields' => array(
                        self::get_color_field(array(
                            'name'    => '[list][color]',
                            'default' => $schema['color']['default'],
                            'label'   => __( 'Text Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[list][color_active]',
                            'default' => $schema['color_active']['default'],
                            'label'   => __( 'Text Color Active', 'handy-variation-swatches' ),
                        )),
                    ),
                ));
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
     * @return string
     */
    private static function select_form() {
        $schema = self::$schema['select'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_grid_field(array(
                    'name'   => '[select][group][size]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[select][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[select][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[select][group][font]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[select][font_size]',
                            'default' => $schema['font_size']['default'],
                            'label'   => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[select][font_weight]',
                            'default' => $schema['font_weight']['default'],
                            'options' => $schema['font_weight']['choices'],
                            'label'   => __( 'Font Weight', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[select][group][padding]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[select][padding_top]',
                            'default' => $schema['padding_top']['default'],
                            'label'   => __( 'Padding Top', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[select][padding_right]',
                            'default' => $schema['padding_right']['default'],
                            'label'   => __( 'Padding Right', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[select][padding_bottom]',
                            'default' => $schema['padding_bottom']['default'],
                            'label'   => __( 'Padding Bottom', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[select][padding_left]',
                            'default' => $schema['padding_left']['default'],
                            'label'   => __( 'Padding Left', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[select][group][colors]',
                    'fields' => array(
                        self::get_color_field(array(
                            'name'    => '[select][color]',
                            'default' => $schema['color']['default'],
                            'label'   => __( 'Text Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[select][background_color]',
                            'default' => $schema['background_color']['default'],
                            'label'   => __( 'Background Color', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[select][group][border]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[select][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[select][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[select][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', 'handy-variation-swatches' ),
                        )),
                    ),
                ));
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
     * @return string
     */
    private static function button_form() {
        $schema = self::$schema['button'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field(array(
                    'name'    => '[button][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', 'handy-variation-swatches' ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[button][group][size]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[button][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[button][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[button][group][font]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[button][font_size]',
                            'default' => $schema['font_size']['default'],
                            'label'   => __( 'Font Size', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[button][font_weight]',
                            'default' => $schema['font_weight']['default'],
                            'options' => $schema['font_weight']['choices'],
                            'label'   => __( 'Font Weight', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[button][group][padding]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[button][padding_top]',
                            'default' => $schema['padding_top']['default'],
                            'label'   => __( 'Padding Top', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[button][padding_right]',
                            'default' => $schema['padding_right']['default'],
                            'label'   => __( 'Padding Right', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[button][padding_bottom]',
                            'default' => $schema['padding_bottom']['default'],
                            'label'   => __( 'Padding Bottom', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[button][padding_left]',
                            'default' => $schema['padding_left']['default'],
                            'label'   => __( 'Padding Left', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[button][group][colors]',
                    'fields' => array(
                        self::get_color_field(array(
                            'name'    => '[button][text_color]',
                            'default' => $schema['text_color']['default'],
                            'label'   => __( 'Text Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[button][text_color_active]',
                            'default' => $schema['text_color_active']['default'],
                            'label'   => __( 'Text Color Active', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[button][background_color]',
                            'default' => $schema['background_color']['default'],
                            'label'   => __( 'Background Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[button][background_color_active]',
                            'default' => $schema['background_color_active']['default'],
                            'label'   => __( 'Background Color Active', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[button][group][border]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[button][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[button][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[button][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[button][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[button][border_radius]',
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[button][shape]', 'custom', 'no', '==' ),
                    'label'   => __( 'Border Radius', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[button][gap]',
                    'default' => $schema['gap']['default'],
                    'label'   => __( 'Gap', 'handy-variation-swatches' ),
                ));
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
     * @return string
     */
    private static function color_form() {
        $schema = self::$schema['color'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field(array(
                    'name'    => '[color][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[color][size]',
                    'default' => $schema['size']['default'],
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'yes', '!=' ),
                    'label'   => __( 'Size', 'handy-variation-swatches' ),
                ));

                echo self::get_grid_field(array(
                    'name'    => '[color][group][size]',
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' ),
                    'fields'  => array(
                        self::get_size_field(array(
                            'name'    => '[color][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[color][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[color][group][border]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[color][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[color][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[color][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[color][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[color][border_radius]',
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[color][shape]', 'custom', 'no', '==' ),
                    'label'   => __( 'Border Radius', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[color][gap]',
                    'default' => $schema['gap']['default'],
                    'label'   => __( 'Gap', 'handy-variation-swatches' ),
                ));
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
     * @return string
     */
    private static function image_form() {
        $schema = self::$schema['image'];

        ob_start();
        ?>
        <div class="hvsfw-vf-form">
            <?php
                echo self::get_select_field(array(
                    'name'    => '[image][shape]',
                    'default' => $schema['shape']['default'],
                    'options' => $schema['shape']['choices'],
                    'label'   => __( 'Shape', 'handy-variation-swatches' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[image][size]',
                    'default' => $schema['size']['default'],
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'yes', '!=' ),
                    'label'   => __( 'Size', 'handy-variation-swatches' ),
                ));

                echo self::get_grid_field(array(
                    'name'    => '[image][group][size]',
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' ),
                    'fields'  => array(
                        self::get_size_field(array(
                            'name'    => '[image][width]',
                            'default' => $schema['width']['default'],
                            'label'   => __( 'Width', 'handy-variation-swatches' ),
                        )),
                        self::get_size_field(array(
                            'name'    => '[image][height]',
                            'default' => $schema['height']['default'],
                            'label'   => __( 'Height', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_grid_field(array(
                    'name'   => '[image][group][border]',
                    'fields' => array(
                        self::get_size_field(array(
                            'name'    => '[image][border_width]',
                            'default' => $schema['border_width']['default'],
                            'label'   => __( 'Border Width', 'handy-variation-swatches' ),
                        )),
                        self::get_select_field(array(
                            'name'    => '[image][border_style]',
                            'default' => $schema['border_style']['default'],
                            'options' => $schema['border_style']['choices'],
                            'label'   => __( 'Border Style', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[image][border_color]',
                            'default' => $schema['border_color']['default'],
                            'label'   => __( 'Border Color', 'handy-variation-swatches' ),
                        )),
                        self::get_color_field(array(
                            'name'    => '[image][border_color_active]',
                            'default' => $schema['border_color_active']['default'],
                            'label'   => __( 'Border Color Active', 'handy-variation-swatches' ),
                        )),
                    ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[image][border_radius]',
                    'label'   => __( 'Border Radius', 'handy-variation-swatches' ),
                    'default' => $schema['border_radius']['default'],
                    'is_show' => self::is_show_field( '[image][shape]', 'custom', 'no', '==' ),
                ));

                echo self::get_size_field(array(
                    'name'    => '[image][gap]',
                    'label'   => __( 'Gap', 'handy-variation-swatches' ),
                    'default' => $schema['gap']['default'],
                ));
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
     * @return string
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
                <?php echo __( 'Product Attributes', 'handy-variation-swatches' ); ?>
            </label>
            <select class="hvsfw-vf-select" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" data-input="<?php echo $name; ?>" data-type="<?php echo self::$display_type; ?>"/>
                <option value="" data-type="">
                    <?php echo __( 'Select Attribute', 'handy-variation-swatches' ); ?>
                </option>
                <?php if ( ! empty( $attributes ) ) : ?>
                    <?php foreach ( $attributes as $attribute ) : ?>
                        <option value="<?php echo esc_attr( $attribute['attribute_name'] ); ?>" data-type="<?php echo esc_attr( $attribute['attribute_type'] ) ?>" <?php selected( $attribute['attribute_name'], $value ) ?>>
                            <?php echo esc_html( $attribute['attribute_label'] ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Return the text field.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for creating size field.
     * $args = [
     *    'name'    => (string) Contains the name of the size field.
     *    'default' => (string) Contains the default value of the size field.
     *    'label'   => (string) Contains the label of the size field.
     *    'class'   => (string) Contains the additional class of size field.
     *    'is_show' => (string) Contains the visibility state of the size field [yes, no].
     * ]
     * @return string
     */
    private static function get_text_field( $args = array() ) {
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
     * @param  array $args Contains the necessary arguments for creating select field.
     * $args = [
     *    'name'        => (string) Contains the name of the select field.
     *    'default'     => (string) Contains the default value of the select field.
     *    'options'     => (array)  Contains the options value of the select field.
     *    'label'       => (string) Contains the label of the select field.
     *    'is_show'     => (string) Contains the visibility state of the input field [yes, no].
     *    'placeholder' => (string) Contains the placeholder of the select field.
     * ]
     * @return string
     */
    private static function get_select_field( $args = array() ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) || ! isset( $args['options'] ) ) {
            return;
        }

        $name        = $args['name'];
        $options     = ( ! empty( $args['options'] ) ? $args['options'] : array() );
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
                <?php if ( ! empty( $placeholder ) ) : ?>
                    <option>
                        <?php echo esc_html( $placeholder ); ?>
                    </option>
                <?php endif; ?>
                <?php if ( ! empty( $options ) ) : ?>
                    <?php foreach ( $options as $option ) : ?>
                        <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, $value ) ?>>
                            <?php echo esc_html( $option ); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Return the size field.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for creating size field.
     * $args = [
     *    'name'    => (string) Contains the name of the size field.
     *    'default' => (string) Contains the default value of the size field.
     *    'label'   => (string) Contains the label of the size field.
     *    'class'   => (string) Contains the additional class of size element.
     *    'is_show' => (string) Contains the visibility state of the size field [yes, no].
     * ]
     * @return string
     */
    private static function get_size_field( $args = array() ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) ) {
            return;
        }

        return self::get_text_field(array(
            'name'    => $args['name'],
            'default' => ( isset( $args['default'] ) ? $args['default'] : '' ),
            'label'   => ( isset( $args['label'] ) ? $args['label'] : '' ),
            'is_show' => ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' ),
            'class'   => 'hvsfw-vf-size',
        ));
    }

    /**
     * Return the color picker field.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for creating color picker field.
     * $args = [
     *    'name'    => (string) Contains the name of the color picker field.
     *    'default' => (string) Contains the default value of the color picker field.
     *    'label'   => (string) Contains the label of the color picker field.
     *    'class'   => (string) Contains the additional class of color picker element.
     *    'is_show' => (string) Contains the visibility state of the color picker field [yes, no].
     * ]
     * @return string
     */
    private static function get_color_field( $args = array() ) {
        if ( ! isset( $args['name'] ) || empty( $args['name'] ) ) {
            return;
        }

        return self::get_text_field(array(
            'name'    => $args['name'],
            'default' => ( isset( $args['default'] ) ? $args['default'] : '' ),
            'label'   => ( isset( $args['label'] ) ? $args['label'] : '' ),
            'is_show' => ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' ),
            'class'   => 'hvsfw-vf-color',
        ));
    }

    /**
     * Return a wrapped sub fields into two columns.
     *
     * @since 1.0.0
     *
     * @param  array $args Contains the necessary arguments for creating grid field.
     * $args = [
     *    'name'    => (string) Contains the name of the grid field.
     *    'is_show' => (string) Contains the visibility state of the grid field [yes, no].
     *    'fields'  => (array)  Contains the sub fields to be rendered.
     * ]
     * @return string
     */
    private static function get_grid_field( $args = array() ) {
        $no_name   = ( ! isset( $args['name'] ) || empty( $args['name'] ) );
        $no_fields = ( ! isset( $args['fields'] ) || empty( $args['fields'] ) );
        if ( $no_name || $no_fields ) {
            return;
        }

        $is_show = ( isset( $args['is_show'] ) ? $args['is_show'] : 'yes' );

        ob_start();
        ?>
        <div class="hvsfw-vf-form__field hvsfw-vf-form__grid" data-field="<?php echo $args['name']; ?>" data-show="<?php echo $is_show; ?>">
            <?php foreach ( $args['fields'] as $field ) : ?>
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
     * @param  array $args Contains the necessary arguments for rendering accordion.
     * $args = [
     *    'title'   => (string) Contains the title or label of the accordion.
     *    'content' => (string) Contains the content or form to be render.
     *    'class'   => (string) Contains the additional class.
     *    'is_show' => (string) Contains the visibility state of the accordion [yes, no].
     * ]
     * @return string
     */
    private static function get_accordion( $args = array() ) {
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
     * @param  string $name    Contains the name of the field.
     * @param  string $initial Contains the default value of the field.
     * @return string
     */
    private static function get_value( $name, $initial = '' ) {
        if ( empty( $name ) ) {
            return $initial;
        }

        $keys = explode( ']', $name );
        if ( empty( $keys ) ) {
            return $initial;
        }

        $keys = array_map( function( $key ) {
            return substr( $key, 1 );
        }, $keys );

        $value    = self::$instance;
        $is_found = ( isset( $value[ $keys[0] ][ $keys[1] ] ) && ! empty( $value[ $keys[0] ][ $keys[1] ] ) );

        return ( $is_found ? $value[ $keys[0] ][ $keys[1] ] : $initial );
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
     * @param  string $display_type Contains the final display type.
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
     * @param  string $field    Contains the name of the field.
     * @param  mixed  $value    Contains the expected value of field to return true.
     * @param  string $initial  Contains the default value if field_value is empty.
     * @param  string $operator Contains the condition operator.
     * @return string
     */
    private static function is_show_field( $field, $value, $initial, $operator ) {
        if ( empty( $field ) || empty( $value ) ) {
            return 'no';
        }

        $field_value = self::get_value( $field );
        if ( empty( $field_value ) ) {
            return $initial;
        }

        // phpcs:disable Squiz.PHP.NonExecutableCode.Unreachable, Universal.Operators.StrictComparisons.LooseNotEqual, Squiz.PHP.NonExecutableCode.Unreachable
        switch ( $operator ) {
            case '==':
                return ( $field_value == $value ? 'yes' : 'no' );
                break;
            case '!=':
                return ( $field_value != $value ? 'yes' : 'no' );
                break;
        }
        // phpcs:enable

        return 'no';
    }

    /**
     * Return the field id with unique widget prefix.
     *
     * @since 1.0.0
     *
     * @param  string $field Contains the name of the field.
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
     * @param  string $name Contains the name of the field.
     * @return string
     */
    private static function field_name( $name ) {
        $prefix = substr( self::$field_name, 0, -2 );

        return $prefix . $name;
    }
}
