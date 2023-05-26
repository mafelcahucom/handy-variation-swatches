<?php
namespace HVSFW\Client\Widgets\VariationFilter;

use WP_Widget;
use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Widgets\VariationFilter\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Register Variation Filter Widget.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
class VariationFilter extends WP_Widget {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the product attributes.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private $attributes = [];

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        $id   	  = 'hvsfw-variation-filter-widget';
		$name 	  = 'Handy Variation Filter';
		$options  = [
			'classname'	  => 'hvsfw-variation-filter-widget',
			'description' => 'Show a list of variation swatches on the shop page to filter the products.',
			'customize_selective_refresh' => true
		];
		$controls = [
			'width'	 => 400,
			'height' => 350
		];

        // Register widget.
		parent::__construct( $id, $name, $options, $controls );
		add_action( 'widgets_init', [ $this, 'registerWidget' ] );

        // Register styles and scripts.
        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );
    }

    /**
	 * Register widget in widget dashboard.
	 *
	 * @since 1.0.0
	 */
	public function registerWidget() {
		register_widget( $this );
	}

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'widgets.php' ) {
            return;
        }

        wp_register_style( 'hvsfw-variation-filter-css', $this->get_asset_src( 'css/main.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'hvsfw-variation-filter-css' );
    }

    /**
     * Register all scripts.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'widgets.php' ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];
        wp_register_script( 'hvsfw-variation-filter-js', $this->get_asset_src( 'js/main.min.js' ), $dependency, '1.0.0', true );

        wp_enqueue_script( 'hvsfw-variation-filter-js' );
    }

    /**
	 * Widget's Form.
	 *
	 * @since 1.0.0
	 * 
	 * @param  array  $instance  The available instance of the form.
	 */
	public function form( $instance ) {
        echo Form::render([
            'instance'   => $instance, 
            'field_id'   => $this->get_field_id(''),
            'field_name' => $this->get_field_name('')
        ]);
    }

    /**
	 * Update Widget.
	 *
	 * @since 1.0.0
	 * 
	 * @param  array  $new_instance  Holds all new instances.
	 * @param  array  $old_instance  Holds all old instances.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
        Helper::log( $new_instance );

        return $new_instance;
    }

    /**
	 * Widget.
	 *
	 * @since 1.0.0
	 * 
	 * @param  array  $args      Holds the define arguments.
	 * @param  array  $instance  Holds all the instances.
	 */
	public function widget( $args, $instance ) {
        echo '<H1>Hello</h1>';
    }

    /**
     * Returns the base url.
     *
     * @since 1.0.0
     * 
     * @param string  $file  Target filename.
     * @return string
     */
    private function get_asset_src( $file ) {
        return HVSFW_PLUGIN_URL . 'app/Client/Widgets/VariationFilter/assets/dist/' . $file;
    }
}