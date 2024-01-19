<?php
namespace HVSFW\Client\Widgets\VariationFilter;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Inc\SwatchFilter;
Use HVSFW\Client\Widgets\VariationFilter\Inc\LocalHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Variation Filter Widget.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Widget {

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
     * Holds general setting show count.
     * 
     * @since 1.0.0
     *
     * @var boolean
     */
    private static $show_count = true;

    /**
     * Holds general setting display type.
     * 
     * @since 1.0.0
     *
     * @var string
     */
    private static $display_type = '';
    
    /**
     * Holds general setting query type.
     * 
     * @since 1.0.0
     *
     * @var string
     */
    private static $query_type = 'or';

    /**
     * Holds the selected variation attribute.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private static $attribute = [];

	/**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Render Variation Filter Widget.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains the arguments for rendering widget.
     * $args = [
     *     'instance' => (array) Contains the available instance of the widget.
     * ]
     * @return HTMLElement
     */
    public static function render( $args = [] ) {
        if ( ! isset( $args['instance'] ) || empty( $args['instance'] ) ) {
            return;
        }

        self::$instance     = $args['instance'];
        self::$show_count   = LocalHelper::get_show_count( self::$instance );
        self::$query_type   = LocalHelper::get_query_type( self::$instance );
        self::$display_type = LocalHelper::get_display_type( self::$instance );

        $selected_attribute = self::$instance['general']['attribute'];
        if ( empty( $selected_attribute ) ) {
            return;
        }

        self::$attribute = Utility::get_attribute( $selected_attribute );
        if ( empty( self::$attribute ) ) {
            return;
        }

        ob_start();
        ?>
        <div class="hvsfw-vf">
            <?php echo self::get_title(); ?>
            <div class="hvsfw-vf-swatch">
                <?php
                    $swatch_method = 'get_swatch_'. self::$display_type;
                    if ( method_exists( __CLASS__, $swatch_method ) ) {
                        echo call_user_func( [ __CLASS__, $swatch_method ] );
                    }
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the title component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_title() {
        $setting = self::$instance['title'];
        $style   = Helper::minify_css("
            color:         {$setting['color']};
            font-size:     {$setting['font_size']};
            font-weight:   {$setting['font_weight']};
            line-height:   {$setting['line_height']};
            margin-bottom: {$setting['margin_bottom']};
        ");

        return SwatchFilter::get_title_component([
            'text'  => $setting['text'],
            'style' => $style
        ]);
    }

    /**
     * Return the swatch list component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_swatch_list() {
        $setting      = self::$instance['list'];
        $styles['li'] = Helper::minify_css("
            margin-bottom: {$setting['margin_bottom']};
        ");

        $styles['a'] = Helper::minify_css("
            font-size:   {$setting['font_size']};
            font-weight: {$setting['font_weight']};
            line-height: {$setting['line_height']};
        ");

        $styles['a:active'] = Helper::minify_css("
            {$styles['a']}
            color: {$setting['color_active']};
        ");

        $styles['a'] .= Helper::minify_css("
            color: {$setting['color']};
        ");

        return SwatchFilter::get_swatch_list_component([
            'attribute'  => self::$attribute,
            'query_type' => self::$query_type,
            'show_count' => self::$show_count,
            'styles'     => $styles
        ]);
    }

    /**
     * Return the swatch select component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_swatch_select() {
        $setting = self::$instance['select'];
        $padding = self::get_padding( $setting );
        $border  = self::get_border( $setting );

        $styles  = [
            'parent' => Helper::minify_css("
                width:  {$setting['width']};
                height: {$setting['height']};
            "),
            'select' => Helper::minify_css("
                color:            {$setting['color']};
                font-size:        {$setting['font_size']};
                font-weight:      {$setting['font_weight']};
                background-color: {$setting['background_color']};
                padding:          {$padding};
                border:           {$border};
            "),
            'button' => Helper::minify_css("
                fill: {$setting['color']};
            ")
        ];

        return SwatchFilter::get_swatch_select_component([
            'attribute'  => self::$attribute,
            'query_type' => self::$query_type,
            'show_count' => self::$show_count,
            'styles'     => $styles
        ]);
    }

    /**
     * Return the swatch button component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_swatch_button() {
        $setting       = self::$instance['button'];
        $padding       = self::get_padding( $setting );
        $border        = self::get_border( $setting );
        $border_active = self::get_border( $setting, 'active' );

        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        $styles['box'] = Helper::minify_css("
            min-width:   {$setting['width']};
            min-height:  {$setting['height']};
            color:       {$setting['text_color']};
            font-size:   {$setting['font_size']};
            font-weight: {$setting['font_weight']};
            background:  {$setting['background_color']};
            padding:     {$padding};
            border:      {$border};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] .= Helper::minify_css("
                border-radius: {$setting['border_radius']};
            ");
        } else {
            $radius         = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] .= Helper::minify_css("
                border-radius: {$radius};
            ");
        }

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
            color:      {$setting['text_color_active']} !important;
            background: {$setting['background_color_active']} !important;
            border:     {$border_active} !important;
        ");

        return SwatchFilter::get_swatch_button_component([
            'attribute'  => self::$attribute,
            'query_type' => self::$query_type,
            'show_count' => self::$show_count,
            'styles'     => $styles
        ]);
    }

    /**
     * Return the swatch color component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_swatch_color() {
        $setting       = self::$instance['color'];
        $border        = self::get_border( $setting );
        $border_active = self::get_border( $setting, 'active' );

        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] = Helper::minify_css("
                width:         {$setting['width']};
                height:        {$setting['height']};
                border-radius: {$setting['border_radius']};
            ");
        } else {
            $radius = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] = Helper::minify_css("
                width:         {$setting['size']};
                height:        {$setting['size']};
                border-radius: {$radius};
            ");
        }

        $styles['box'] .= Helper::minify_css("
            border: {$border};
        ");

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
            border: {$border_active} !important;
        ");

        return SwatchFilter::get_swatch_color_component([
            'attribute'  => self::$attribute,
            'query_type' => self::$query_type,
            'styles'     => $styles
        ]);
    }

    /**
     * Return the swatch image component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private static function get_swatch_image() {
        $setting       = self::$instance['image'];
        $border        = self::get_border( $setting );
        $border_active = self::get_border( $setting, 'active' );

        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] = Helper::minify_css("
                width:         {$setting['width']};
                height:        {$setting['height']};
                border-radius: {$setting['border_radius']};
            ");
        } else {
            $radius = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] = Helper::minify_css("
                width:         {$setting['size']};
                height:        {$setting['size']};
                border-radius: {$radius};
            ");
        }

        $styles['box'] .= Helper::minify_css("
            border: {$border};
        ");

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
            border: {$border_active} !important;
        ");

        return SwatchFilter::get_swatch_image_component([
            'attribute'  => self::$attribute,
            'query_type' => self::$query_type,
            'styles'     => $styles
        ]);
    }

    /**
     * Return a single line padding value.
     * 
     * @since 1.0.0
     *
     * @param  array  $setting  Contains the style settings.
     * @return string
     */
    private static function get_padding( $setting ) {
        if ( empty( $setting ) ) {
            return '0px 0px 0px 0px';
        }

        $top    = ( isset( $setting['padding_top'] ) ? $setting['padding_top'] : '0px' );
        $right  = ( isset( $setting['padding_right'] ) ? $setting['padding_right'] : '0px' );
        $bottom = ( isset( $setting['padding_bottom'] ) ? $setting['padding_bottom'] : '0px' );
        $left   = ( isset( $setting['padding_left'] ) ? $setting['padding_left'] : '0px' );

        return "{$top} {$right} {$bottom} {$left}";
    }

    /**
     * Return a single line border value.
     * 
     * @since 1.0.0
     *
     * @param  array   $setting  Contains the style setting.
     * @param  string  $state    Contains the state for border color selection [defaut, active].
     * @return string
     */
    private static function get_border( $setting, $state = 'default' ) {
        if ( empty( $setting ) ) {
            return '0px none #000000';
        }

        $width = ( isset( $setting['border_width'] ) ? $setting['border_width'] : '0px' );
        $style = ( isset( $setting['border_style'] ) ? $setting['border_style'] : 'none' );
        $color = ( isset( $setting['border_color'] ) ? $setting['border_color'] : '#000000' );
        if ( $state === 'active' ) {
            $color = ( isset( $setting['border_color_active'] ) ? $setting['border_color_active'] : '#0071f2' );
        }

        return "{$width} {$style} {$color}";
    }
}