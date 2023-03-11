<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Swatch.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Swatch {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Holds the settings.
     *
     * @since 1.0.0
     *
     * @var array
     */
    private $settings;

	/**
     * Initialize.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Set global setting property.
        $this->settings = get_option( '_hvsfw_main_settings' );

        // Render the variation attributes in product single page.
        if ( $this->settings['gn_pp_enable'] == true ) {
            add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'render_product_single_page_swatches' ], 100, 2 );
        }
    }

    /**
     * Render the swatches in product single page.
     *
     * @since 1.0.0
     * 
     * @param  string  $html  The current variation html representation.
     * @param  array   $args  Containing the default arguments from a filter hook.
     * @return string
     */
    public function render_product_single_page_swatches( $html, $args ) {
        global $product;
        $select_html = $html;

        $attribute = $this->get_attribute( $product, $args['attribute'] );
        if ( empty( $attribute ) ) {
            return $select_html;
        }

        $saved_swatches = Utility::get_product_swatches( $product->get_id() );
        if ( ! in_array( $attribute['slug'], array_keys( $saved_swatches ) ) ) {
            return $select_html;
        }

        //Helper::log( $saved_swatches );

        $swatch = $saved_swatches[ $attribute['slug'] ];

        if ( $swatch['custom'] === 'yes' && in_array( $swatch['type'], [ 'default', 'select' ] ) ) {
            return $select_html;
        }

        if ( $swatch['custom'] === 'no' ) {
            if ( $swatch['type'] === 'select' ) {
                return $select_html;
            }

            if ( $swatch['type'] === 'default' ) {
                $setting = Utility::get_swatch_settings( $attribute['id'] );
                if ( empty( $setting ) || $setting['type'] === 'select' ) {
                    return $select_html;
                }
            }
        }

        $html  = '<div class="hvsfw hvsfw-swatch-container">';
        $html .= '<div class="hvsfw-ds-none">'. $select_html .'</div>';
        $html .= $this->get_variation_attribute([
            'attribute' => $attribute,
            'swatch'    => $swatch
        ]);
        $html .= '</div>';

        return $html; 
    }

    /**
     * Return the variation attributes html.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for variation attributes.
     * $args = [
     *     'attribute' => (array) The attribute value from $this->get_attribute().
     *     'swatch'    => (array) The current setting of the swatch.
     * ]
     * @return string
     */
    private function get_variation_attribute( $args = [] ) {
        if ( ! isset( $args['attribute'] ) || ! isset( $args['swatch'] ) ) {
            return '';
        }

        $swatch         = $args['swatch'];
        $style          = $swatch['style'];
        $attribute      = $args['attribute'];
        $attribute_type = $swatch['type'];
        if ( $attribute['id'] !== 0 ) {
            if ( $attribute_type === 'default' ) {
                $setting        = Utility::get_swatch_settings( $attribute['id'] );
                $attribute_type = $setting['type'];

                unset( $setting['type'] );
                $style = $setting;
            }
        }

        // Set is_default and style for button, color, image type.
        $is_default = 'no';
        if ( in_array( $attribute_type, [ 'button', 'color', 'image' ] ) ) {
            if ( isset( $style['style'] ) && $style['style'] === 'default' ) {
                $is_default = 'yes';
                $style      = $this->get_default_style( $attribute_type );
            }
        }

        ob_start();
        ?>
        <div class="hvsfw-attribute" data-attribute="<?php echo esc_attr( $attribute['slug'] ); ?>" data-type="<?php echo esc_attr( $attribute_type ); ?>">
            <?php
                if ( ! empty( $attribute['options'] ) ) {
                    foreach ( $attribute['options'] as $option ) {
                        // Set term.
                        $term = ( isset( $swatch['term'][ $option['slug'] ] ) ? $swatch['term'][ $option['slug'] ] : [] );

                        // Set term_type.
                        $term_type = $attribute_type;
                        if ( ! empty( $term ) ) {
                            if ( isset( $term['type'] ) && $term['type'] !== 'default' ) {
                                $term_type = $term['type'];
                            }
                        } else {
                            if ( $attribute_type === 'assorted' ) {
                                $term_type = 'button';
                            }
                        }

                        // Set is_default and style to assorted type.
                        if ( $attribute_type === 'assorted' ) {
                            $is_default = 'yes';
                            $style      = $this->get_default_style( $term_type );

                            if ( ! empty( $term ) ) {
                                if ( isset( $term['style']['style'] ) && $term['style']['style'] !== 'default' ) {
                                    $is_default = 'no';
                                    $style      = $term['style'];
                                }
                            }
                        }

                        // Set option style and is_default.
                        $option['style']      = $style;
                        $option['is_default'] = $is_default;

                        // Render term type.
                        switch ( $term_type ) {
                            case 'button':
                                echo $this->get_term_button([
                                    'term'       => $term,
                                    'option'     => $option,
                                    'attribute'  => $attribute
                                ]);
                                break;
                            case 'color':
                                echo $this->get_term_color([

                                ]);
                                break;
                            case 'image':
                                echo $this->get_term_image([

                                ]);
                                break;
                        }
                    }
                }
            ?>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Render the term button type.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for term button requirements.
     * $args = [
     *     'term'       => (array)  The term id, value, style, tooltip from saved swatch in post meta.
     *     'option'     => (array)  The term name, slug, value, is_default and style.
     *     'attribute'  => (array)  The attribute value from $this->get_attribute().
     * ]
     * @return string
     */
    private function get_term_button( $args = [] ) {
        $parameters = [ 'term', 'option', 'attribute' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return '';
        }

        $term      = $args['term'];
        $option    = $args['option'];
        $attribute = $args['attribute'];

        // Set value.
        if ( ! isset( $term['value'] ) ) {
            $term['value'] = [
                'button_label' => $option['name']
            ];
        }

        // Set tooltip.
        $tooltip = $this->get_tooltip([
            'id'      => $term['id'],
            'label'   => $term['value']['button_label'],
            'tooltip' => $term['tooltip']
        ]);

        // Set style and css
        $css   = "";
        $style = $option['style'];
        if ( $option['is_default'] === 'no' ) {
            $css .= "width: {$style['width']};";
            $css .= "height: {$style['height']};";
            $css .= "font-size: {$style['font_size']};";
            $css .= "font-weight: {$style['font_weight']};";
            $css .= "line-height: {$style['font_size']};";
            $css .= "color: {$style['font_color']};";
            $css .= "background-color: {$style['background_color']};";
            $css .= "padding-top: {$style['padding_top']};";
            $css .= "padding-bottom: {$style['padding_bottom']};";
            $css .= "padding-left: {$style['padding_left']};";
            $css .= "padding-right: {$style['padding_right']};";
            $css .= "border-style: {$style['border_style']};";
            $css .= "border-width: {$style['border_width']};";
            $css .= "border-color: {$style['border_color']};";
            $css .= "margin-right: {$style['gap']};";

            if ( $style['shape'] === 'custom' ) {
                $css .= "border-radius: {$style['border_radius']};";
            }
        }

        // Set data style.
        $data_style = htmlspecialchars( json_encode( [
            'leave' => [
                'color'            => $style['font_color'],
                'background-color' => $style['background_color'],
                'border-color'     => $style['border_color']
            ],
            'enter' => [
                'color'            => $style['font_hover_color'],
                'background-color' => $style['background_hover_color'],
                'border-color'     => $style['border_hover_color']
            ],
        ]));

        ob_start();
        ?>
        <div class="hvsfw-term"
             data-type="button"
             data-default="<?php echo esc_attr( $option['is_default'] ); ?>"
             data-tooltip="<?php echo esc_attr( $tooltip['is_enabled'] ); ?>"
             data-style="<?php echo esc_attr( $data_style ); ?>"
             style="<?php echo $css; ?>">
            <?php 
                echo esc_html( $term['value']['button_label'] );

                if ( $tooltip['is_enabled'] === 'yes' && ! empty( $tooltip['html'] ) ) {
                    echo $tooltip['html'];
                }
            ?>
        </div>
        <?php

        return ob_get_clean();
    }

    private function get_term_color( $args = [] ) {

    }

    private function get_term_image( $args = [] ) {

    }

    /**
     * Return the tooltip component.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for tooltip component.
     * $args = [
     *     'id'      => (Integer) The term id.
     *     'label'   => (String)  The term label or name.
     *     'tooltip' => (Array)   The tooltip from saved swatch post meta.
     * ]
     * @return array
     */
    private function get_tooltip( $args = [] ) {
        $output = [
            'is_enabled' => 'no',
            'html'       => ''
        ];

        $parameters = [ 'id', 'label', 'tooltip' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return $output;
        }

        if ( $args['tooltip']['type'] === 'none' ) {
            return $output;
        }

        $type    = 'text';
        $content = '';
        if ( in_array( $args['tooltip']['type'], [ 'text', 'html', 'image' ] ) ) {
            $type    = $args['tooltip']['type'];
            $content = $args['tooltip']['content'];
        }

        if ( $args['tooltip']['type'] === 'default' && $args['id'] != 0 ) {
            $default_tooltip = Utility::get_swatch_tooltip( $args['id'] );
            if ( $default_tooltip['type'] === 'none' ) {
                return $output;
            }

            $type    = $default_tooltip['type'];
            $content = $default_tooltip['content'];
        }

        if ( $type === 'image' ) {
            if ( ! empty( $content ) ) {
                $image = wp_get_attachment_image_src( $content, $this->settings['tl_image_src_wd'] );
                if ( $image ) {
                    $image_alt   = get_post_meta( $content, '_wp_attachment_image_alt', true );
                    $image_title = get_the_title( $content );
                } else {
                    $content = '';
                }
            }
        }

        if ( $content === '' || ( $type === 'image' && empty( $content ) ) ) {
            $type    = 'text';
            $content = $args['label'];
        }

        ob_start();
        ?>
        <div class="hvsfw-tooltip" data-type="<?php echo esc_attr( $type ); ?>" data-visibility="hidden">
            <div class="hvsfw-tooltip__box">
                <?php if ( $type === 'text' ): ?>
                    <?php echo esc_html( $content ); ?>
                <?php elseif ( $type === 'html' ): ?>
                    <?php echo $content; ?>
                <?php elseif ( $type === 'image' ): ?>
                    <div class="hvsfw-tooltip__image">
                        <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php echo esc_attr( $image_title ); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php

        $output['html']       = ob_get_clean();
        $output['is_enabled'] = 'yes';

        return $output;
    }

    /**
     * Return the variation attribute details.
     *
     * @since 1.0.0
     * 
     * @param  object  $product    The wc_get_product object.
     * @param  string  $attribute  The attribute name or index.
     * @return array
     */
    private function get_attribute( $product, $attribute ) {
        if ( empty( $product ) || empty( $attribute ) ) {
            return [];
        }

        $attr                 = [];
        $attr_slug            = str_replace( ' ', '-', strtolower( $attribute ) );
        $attributes           = Utility::get_attributes( $product );
        $variation_attributes = $product->get_variation_attributes();

        // Check if attribute exists.
        $in_var_attributes = ( ! in_array( $attribute, array_keys( $variation_attributes ) ) );
        $in_attributes     = ( ! in_array( $attr_slug, array_keys( $attributes ) ) );
        if ( $in_var_attributes || $in_attributes ) {
            return [];
        }

        // Set current attribute value.
        $current_attribute = $attributes[ $attr_slug ];
        $attribute_terms   = $variation_attributes[ $attribute ];

        // Set new attribute value.
        $attr['id']      = $current_attribute->get_id();
        $attr['name']    = $current_attribute->get_name();
        $attr['slug']    = $attr_slug;
        $attr['options'] = [];
        foreach ( $current_attribute->get_options() as $key => $option ) {
            if ( $attr['id'] !== 0 ) {
                $term = get_term( $option );
                if ( $term ) {
                    if ( in_array( $term->slug, $attribute_terms ) ) {
                        array_push( $attr['options'], [
                            'name'  => $term->name,
                            'slug'  => $term->slug,
                            'value' => $term->slug
                        ]);
                    }
                }
            } else {
                if ( in_array( $option, $attribute_terms ) ) {
                    array_push( $attr['options'], [
                        'name'  => $option,
                        'slug'  => Utility::get_converted_slug( $option ),
                        'value' => $option
                    ]);
                }
            }
        }

        return $attr;
    }

    /**
     * Return style and is_default class.
     *
     * @since 1.0.0
     * 
     * @param  array  $swatch  The swatch setting.
     * @return array
     */
    private function get_style( $swatch = [] ) {
        if ( empty( $swatch ) ) {
            return [];
        }


    }

    /**
     * Return the default style of each swatch type from global settings.
     *
     * @since 1.0.0
     * 
     * @param  string  $type  The swatch type |button|color|image.
     * @return array
     */
    private function get_default_style( $type ) {
        if ( ! in_array( $type, [ 'button', 'color', 'image' ] ) ) {
            return [];
        }

        $prefix = ( $type === 'button' ? 'bn' : ( $type === 'color' ? 'cr' : 'im' ) );
        $schema = [
            'shape'                  => [ 'shape',      'square'              ],
            'size'                   => [ 'size',       '40px'                ],
            'width'                  => [ 'wd',         '40px'                ],
            'height'                 => [ 'ht',         '40px'                ],
            'font_size'              => [ 'fs',         '14px'                ],
            'font_weight'            => [ 'fw',         '500'                 ],
            'font_color'             => [ 'txt_clr',    'rgba(0,0,0,1)'       ],
            'font_hover_color'       => [ 'txt_hv_clr', 'rgba(0,113,242,1)'   ],
            'background_color'       => [ 'bg_clr',     'rgba(255,255,255,1)' ],
            'background_hover_color' => [ 'bg_hv_clr',  'rgba(255,255,255,1)' ],
            'padding_top'            => [ 'pt',         '5px'                 ],
            'padding_bottom'         => [ 'pb',         '5px'                 ],
            'padding_left'           => [ 'pl',         '5px'                 ],
            'padding_right'          => [ 'pr',         '5px'                 ],
            'border_style'           => [ 'bs',         'solid'               ],
            'border_width'           => [ 'bw',         '1px'                 ],
            'border_color'           => [ 'b_clr',      'rgba(0,0,0,1)'       ],
            'border_hover_color'     => [ 'b_hv_clr',   'rgba(0,113,242,1)'   ],
            'border_radius'          => [ 'br',         '0px'                 ],
            'gap'                    => [ 'gap',        '0px'                 ]
        ];

        $style = [];
        foreach ( $schema as $key => $value ) {
            $index         = $prefix .'_'. $value[0];
            $style[ $key ] = ( isset( $this->settings[ $index ] ) ? $this->settings[ $index ] : $value[1] );
        }

        return $style;
    }
}