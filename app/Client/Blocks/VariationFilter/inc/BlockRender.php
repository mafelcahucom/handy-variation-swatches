<?php
namespace HVSFW\Client\Blocks\VariationFilter\Inc;

use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;
use HVSFW\Client\Inc\SwatchFilter;

defined( 'ABSPATH' ) || exit;

/**
 * Block Render.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class BlockRender {

    /**
     * Holds the block attributes.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $attributes = [];

    /**
     * Holds the selected variation attribute.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private $attribute = [];

    /**
     * Holds the block wrapper.
     *
     * @var string
     */
    private $block_wrapper = '';

    /**
     * Initialize.
     * 
     * @since 1.0.0
     */
	public function __construct( $args = [] ) {
        $this->attributes    = $args['attributes'];
        $this->block_wrapper = $args['block_wrapper'];

        $selected_attribute = $this->attributes['settings']['attribute'];
        if ( ! empty( $selected_attribute ) ) {
            $this->attribute  = Utility::get_attribute( $selected_attribute );
            if ( ! empty( $this->attribute ) ) {
                echo $this->render();
            }
        }
    }

    /**
     * Return the block front-end component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private function render() {
        ob_start();
        ?>
        <div <?php echo $this->block_wrapper; ?>>
            <div class="hvsfw-vf">
                <?php echo $this->get_title(); ?>
                <div class="hvsfw-vf-swatch">
                    <?php
                        switch ( $this->get_display_type() ) {
                            case 'list':
                                echo $this->get_swatch_list();
                                break;
                            case 'select':
                                echo $this->get_swatch_select();
                                break;
                            case 'button':
                                echo $this->get_swatch_button();
                                break;
                            case 'color':
                                echo $this->get_swatch_color();
                                break;
                            case 'image':
                                echo $this->get_swatch_image();
                                break;
                        }
                    ?>
                </div>
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
    private function get_title() {
        $setting = $this->attributes['title'];
        $style   = Helper::minify_css("
            color:         {$setting['color']};
            font-size:     {$setting['fontSize']};
            font-weight:   {$setting['fontWeight']};
            margin-bottom: {$setting['marginBottom']};
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
    private function get_swatch_list() {
        $setting      = $this->attributes['list'];
        $styles['li'] = Helper::minify_css("
            margin-bottom: {$setting['marginBottom']};
        ");

        $styles['a'] = Helper::minify_css("
            font-size:   {$setting['fontSize']};
            font-weight: {$setting['fontWeight']};
            line-height: {$setting['lineHeight']};
        ");

        $styles['a:active'] = Helper::minify_css("
            {$styles['a']}
            color: {$setting['colorActive']};
        ");

        $styles['a'] .= Helper::minify_css("
            color: {$setting['color']};
        ");

        return SwatchFilter::get_swatch_list_component([
            'attribute'  => $this->attribute,
            'query_type' => $this->attributes['settings']['queryType'],
            'show_count' => $this->attributes['settings']['showCount'],
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
    private function get_swatch_select() {
        $setting = $this->attributes['select'];
        $styles  = [
            'parent' => Helper::minify_css("
                width:  {$setting['width']};
                height: {$setting['height']};
            "),
            'select' => Helper::minify_css("
                color:            {$setting['color']};
                font-size:        {$setting['fontSize']};
                font-weight:      {$setting['fontWeight']};
                background-color: {$setting['backgroundColor']};
                padding:          {$this->get_padding( $setting['padding'] )};
                {$this->get_borders( $setting['border'] )}
            "),
            'button' => Helper::minify_css("
                fill: {$setting['color']};
            ")
        ];

        return SwatchFilter::get_swatch_select_component([
            'attribute'  => $this->attribute,
            'query_type' => $this->attributes['settings']['queryType'],
            'show_count' => $this->attributes['settings']['showCount'],
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
    private function get_swatch_button() {
        $setting          = $this->attributes['button'];
        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        $styles['box'] = Helper::minify_css("
            min-width:   {$setting['width']};
            min-height:  {$setting['height']};
            color:       {$setting['color']};
            font-size:   {$setting['fontSize']};
            font-weight: {$setting['fontWeight']};
            background:  {$setting['backgroundColor']};
            padding:     {$this->get_padding( $setting['padding'] )};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] .= Helper::minify_css("
                border-radius: {$setting['borderRadius']};
            ");
        } else {
            $radius         = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] .= Helper::minify_css("
                border-radius: {$radius};
            ");
        }

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
            color:      {$setting['colorActive']} !important;
            background: {$setting['backgroundColorActive']} !important;
            {$this->get_borders( $setting['borderActive'] )}
        ");

        if ( ! empty( $setting['borderActive'] ) ) {
            $styles['box:active'] .= Helper::minify_css("
                {$this->get_borders( $setting['borderActive'] )}
            ");
        }

        if ( ! empty( $setting['border'] ) ) {
            $styles['box'] .= Helper::minify_css("
                {$this->get_borders( $setting['border'] )}
            ");
        }

        return SwatchFilter::get_swatch_button_component([
            'attribute'  => $this->attribute,
            'query_type' => $this->attributes['settings']['queryType'],
            'show_count' => $this->attributes['settings']['showCount'],
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
    private function get_swatch_color() {
        $setting          = $this->attributes['color'];
        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] = Helper::minify_css("
                width:         {$setting['width']};
                height:        {$setting['height']};
                border-radius: {$setting['borderRadius']};
            ");
        } else {
            $radius = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] = Helper::minify_css("
                width:         {$setting['size']};
                height:        {$setting['size']};
                border-radius: {$radius};
            ");
        }

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
        ");

        if ( ! empty( $setting['borderActive'] ) ) {
            $styles['box:active'] .= Helper::minify_css("
                {$this->get_borders( $setting['borderActive'] )}
            ");
        }

        if ( ! empty( $setting['border'] ) ) {
            $styles['box'] .= Helper::minify_css("
                {$this->get_borders( $setting['border'] )}
            ");
        }

        return SwatchFilter::get_swatch_color_component([
            'attribute'  => $this->attribute,
            'query_type' => $this->attributes['settings']['queryType'],
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
    private function get_swatch_image() {
        $setting          = $this->attributes['image'];
        $styles['parent'] = Helper::minify_css("
            gap: {$setting['gap']};
        ");

        if ( $setting['shape'] === 'custom' ) {
            $styles['box'] = Helper::minify_css("
                width:         {$setting['width']};
                height:        {$setting['height']};
                border-radius: {$setting['borderRadius']};
            ");
        } else {
            $radius = ( $setting['shape'] === 'circle' ? '100%' : '0px' );
            $styles['box'] = Helper::minify_css("
                width:         {$setting['size']};
                height:        {$setting['size']};
                border-radius: {$radius};
            ");
        }

        $styles['box:active'] = Helper::minify_css("
            {$styles['box']}
        ");

        if ( ! empty( $setting['borderActive'] ) ) {
            $styles['box:active'] .= Helper::minify_css("
                {$this->get_borders( $setting['borderActive'] )}
            ");
        }

        if ( ! empty( $setting['border'] ) ) {
            $styles['box'] .= Helper::minify_css("
                {$this->get_borders( $setting['border'] )}
            ");
        }

        return SwatchFilter::get_swatch_image_component([
            'attribute'  => $this->attribute,
            'query_type' => $this->attributes['settings']['queryType'],
            'styles'     => $styles
        ]);
    }

    /**
     * Return the final display type based on block displayType and
	 * product attribute_type.
     * 
     * @since 1.0.0
     *
     * @return string
     */
    private function get_display_type() {
        $display_type   = $this->attributes['settings']['displayType'];
        $attribute_type = $this->attribute['attribute_type'];

        if ( $display_type === 'swatch' ) {
            $types = [ 'button', 'color', 'image', 'select' ];
            if ( in_array( $attribute_type, $types ) ) {
                return $attribute_type;
            }
        }

        return ( $display_type !== 'swatch' ? $display_type : 'select' );
    }

    /**
     * Return a single line padding value.
     * 
     * @since 1.0.0
     *
     * @param  array  $padding  Contains the top, right, bottom and left value.
     * @return string
     */
    private function get_padding( $padding ) {
        if ( empty( $padding ) ) {
            return '0px 0px 0px 0px';
        }

        $top    = ( isset( $padding['top'] ) ? $padding['top'] : '0px' );
        $right  = ( isset( $padding['right'] ) ? $padding['right'] : '0px' );
        $bottom = ( isset( $padding['bottom'] ) ? $padding['bottom'] : '0px' );
        $left   = ( isset( $padding['left'] ) ? $padding['left'] : '0px' );

        return "{$top} {$right} {$bottom} {$left}";
    }
    
    /**
     * Return a single line border value.
     * 
     * @since 1.0.0
     *
     * @param  array  $border  Contains the width, style and color value.
     * @return string
     */
    private function get_border( $border ) {
        if ( empty( $border ) ) {
            return '0px none #000000';
        }

        $width = ( isset( $border['width'] ) ? $border['width'] : '0px' );
        $style = ( isset( $border['style'] ) ? $border['style'] : 'none' );
        $color = ( isset( $border['color'] ) ? $border['color'] : '#000000' );

        return "{$width} {$style} {$color}";
    }

    /**
     * Returns border top, right, bottom, left and its value in single line.
     * 
     * @since 1.0.0
     *
     * @param  array  $border  Contains the border top, right, bottom and left.
     * @return string
     */
    private function get_borders( $borders ) {
        if ( empty( $borders ) ) {
            return 'border: 0px none #000000;';
        }

        $value = '';
        if ( count( $borders ) === 4 ) {
            foreach ( $borders as $key => $border ) {
                $value .= "border-{$key}: {$this->get_border( $border )};";
            }
        } else {
            $value = "border: {$this->get_border( $borders )};";
        }

        return $value;
    }
}