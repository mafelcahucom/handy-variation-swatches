<?php
/**
 * App > Client > Widgets > Variation Filter > Variation Filter.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Client\Widgets\VariationFilter;

use WP_Widget;
use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Validator;
use HVSFW\Client\Widgets\VariationFilter\Inc\LocalHelper;
use HVSFW\Client\Widgets\VariationFilter\Form;
use HVSFW\Client\Widgets\VariationFilter\Widget;

defined( 'ABSPATH' ) || exit;

/**
 * The `VariationFilter` class contains the Variation Filter
 * main class.
 *
 * @since 1.0.0
 */
class VariationFilter extends WP_Widget {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Holds the product attributes.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $attributes = array();

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        $id   	  = 'hvsfw-variation-filter-widget';
		$name 	  = 'Handy Variation Filter';
		$options  = array(
			'classname'	  => 'hvsfw-variation-filter-widget',
			'description' => 'Show a list of variation swatches on the shop page to filter the products.',
			'customize_selective_refresh' => true,
		);
		$controls = array(
			'width'	 => 400,
			'height' => 350,
		);

        /**
         * Register or load widget.
         */
		parent::__construct( $id, $name, $options, $controls );
		add_action( 'widgets_init', array( $this, 'registerWidget' ) );

        /**
         * Register styles and scripts.
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
    }

    /**
	 * Register widget in widget dashboard.
	 *
	 * @since 1.0.0
     *
     * @return void
	 */
	public function registerWidget() {
		register_widget( $this );
	}

    /**
     * Register all styles.
     *
     * @since 1.0.0
     *
     * @param  string $hook_suffix Contains the hook suffix for the current admin page.
     * @return void
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'widgets.php' ) {
            return;
        }

        wp_enqueue_style( 'wp-color-picker' );

        wp_register_style( 'hvsfw-variation-filter', LocalHelper::get_asset_src( 'css/main.min.css' ), array(), '1.0.0', 'all' );
        wp_enqueue_style( 'hvsfw-variation-filter' );
    }

    /**
     * Register all scripts.
     *
     * @since 1.0.0
     *
     * @param  string $hook_suffix Contains the hook suffix for the current admin page.
     * @return void
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'widgets.php' ) {
            return;
        }

        $dependency = array( 'jquery', 'wp-color-picker' );
        wp_register_script( 'hvsfw-variation-filter', LocalHelper::get_asset_src( 'js/main.min.js' ), $dependency, '1.0.0', true );
        wp_enqueue_script( 'hvsfw-variation-filter' );
    }

    /**
	 * Widget's Form.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $instance Contains the available instance of the form.
     * @return void
	 */
	public function form( $instance ) {
        echo Form::render(array(
            'instance'   => $instance,
            'field_id'   => $this->get_field_id( '' ),
            'field_name' => $this->get_field_name( '' ),
        ));
    }

    /**
	 * Update Widget.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $new_instance Contains the all new instances.
	 * @param  array $old_instance Contains the all old instances.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        $schemas      = LocalHelper::get_fields_schema();
        $display_type = LocalHelper::get_display_type( $new_instance );
        $to_store     = array( 'general', 'title', $display_type );

        // Validate all fields.
        foreach ( $schemas as $parent_key => $fields ) {
            foreach ( $fields as $child_key => $schema ) {
                $new_value = '';
                // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
                $is_to_save = ( in_array( $parent_key, $to_store ) && isset( $new_instance[ $parent_key ][ $child_key ] ) ? true : false );
                if ( $is_to_save ) {
                    $current_value = $new_instance[ $parent_key ][ $child_key ];
                    switch ( $schema['type'] ) {
                        case 'text':
                            $new_value = Validator::validate_text(array(
                                'value'   => $current_value,
                                'default' => $schema['default'],
                                'empty'   => $schema['empty'],
                            ));
                            break;
                        case 'select':
                            $new_value = Validator::validate_select(array(
                                'value'   => $current_value,
                                'default' => $schema['default'],
                                'choices' => $schema['choices'],
                            ));
                            break;
                        case 'size':
                            $new_value = Validator::validate_size(array(
                                'value'   => $current_value,
                                'default' => $schema['default'],
                            ));
                            break;
                        case 'color':
                            $new_value = Validator::validate_color(array(
                                'value'   => $current_value,
                                'default' => $schema['default'],
                            ));
                            break;
                    }
                } else {
                    $new_value = $schema['default'];
                }

                $new_instance[ $parent_key ][ $child_key ] = $new_value;
            }
        }

        // Validate attribute field.
        $attribute_choices = LocalHelper::get_attribute_choices();
        if ( ! empty( $attribute_choices ) ) {
            $new_instance['general']['attribute'] = Validator::validate_select(array(
                'value'   => $new_instance['general']['attribute'],
                'default' => '',
                'choices' => $attribute_choices,
            ));
        }

        return $new_instance;
    }

    /**
	 * Widget.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $args     Contains the define arguments.
	 * @param  array $instance Contains the all the instances.
     * @return void
	 */
	public function widget( $args, $instance ) {
        echo $args['before_widget'];
		echo Widget::render(array(
            'instance' => $instance,
        ));
		echo $args['after_widget'];
    }
}
