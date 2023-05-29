<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Security;
use HVSFW\Inc\Utility;
use HVSFW\Inc\Plugins;
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
     * Inherit Security.
     */
    use Security;

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

        // Override the default dropdown variation to swatches.
        add_filter( 'woocommerce_dropdown_variation_attribute_options_html', [ $this, 'custom_swatch_variation_attribute' ], 100, 2 );

        // Modify the product's available variation.
        add_filter( 'woocommerce_available_variation', [ $this, 'modify_available_variations' ], 100, 3 );

        // Render the variation attributes in shop page.
        if ( $this->settings['gn_sp_enable'] == true ) {
            add_action( 'woocommerce_after_shop_loop_item', [ $this, 'render_shop_page_swatches' ], 10 );

            // Shop page add to cart button.
            if ( ! Plugins::is_active( 'handy-add-to-cart' ) ) {
                add_action( 'wp_ajax_hvsfw_variation_add_to_cart', [ $this, 'variation_add_to_cart' ] );
                add_action( 'wp_ajax_nopriv_hvsfw_variation_add_to_cart', [ $this, 'variation_add_to_cart' ] );

                add_filter( 'woocommerce_loop_add_to_cart_args', [ $this, 'modify_add_to_cart_args' ], 10, 2 );
            }
        }
    }


    /**
     * Override the default dropdown variation attribute to swatches.
     *
     * @since 1.0.0
     * 
     * @param  string  $html  The current variation html representation.
     * @param  array   $args  Containing the default arguments from a filter hook.
     * @return string
     */
    public function custom_swatch_variation_attribute( $html, $args ) {
        $product     = $args['product'];
        $select_html = $html;

        $template = 'single-product';
        if ( property_exists( $product, 'hvsfw_template' ) ) {
            $template = $product->hvsfw_template;
        }

        if ( $template === 'single-product' && $this->settings['gn_pp_enable'] == false ) {
            return $select_html;
        } 

        $attribute = $this->get_attribute( $product, $args['attribute'] );
        if ( empty( $attribute ) ) {
            return $select_html;
        }

        $saved_swatches = Utility::get_product_swatches( $product->get_id() );
        if ( ! in_array( $attribute['slug'], array_keys( $saved_swatches ) ) ) {
            return $select_html;
        }

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

        $variation_html = $this->get_variation_attribute([
            'product_id' => $product->get_id(),
            'attribute'  => $attribute,
            'swatch'     => $swatch,
            'template'   => $template
        ]);

        $html  = '<div class="hvsfw hvsfw-swatch">';
        $html .= '<div class="hvsfw-select" data-attribute="'. esc_attr( $attribute['slug'] ) .'">';
        $html .= $select_html;
        $html .= '</div>';
        $html .= $variation_html;
        $html .= '</div>';

        return $html; 
    }

    /**
     * Render the variation swatches in shop page.
     *
     * @since 1.0.0
     */
    public function render_shop_page_swatches() {
        global $product;
        
        if ( ! $product->is_type( 'variable' ) ) {
            return;
        }

        $variations = $product->get_available_variations();
        if ( ! $variations ) {
            return;
        }
        
        $product_id              = $product->get_id();
        $attributes              = $product->get_variation_attributes();
        $attribute_keys          = array_keys( $attributes );
        $encoded_variations      = wp_json_encode( $variations );
        $product->hvsfw_template = 'archive-product';
        ?>
        <div class="hvsfw-variations-form variations_form"
             data-product_id="<?php echo absint( $product_id ); ?>"
             data-product_variations="<?php echo esc_attr( $encoded_variations ); ?>">
            <table class="hvsfw-variations-table variations" cellspacing="0" role="presentation">
                <tbody>
                    <?php foreach ( $attributes as $attribute_name => $options ): ?>
                        <tr>
                            <?php if ( $this->settings['gs_sp_sw_label_position'] !== 'hidden' ): ?>
                                <th class="label">
                                    <label for="<?php echo esc_attr( $attribute_name ); ?>">
                                        <?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?>
                                    </label>
                                </th>
                            <?php endif; ?>
                            <td class="value">
                                <?php
                                    wc_dropdown_variation_attribute_options(
                                        array(
                                            'options'   => $options,
                                            'attribute' => $attribute_name,
                                            'product'   => $product,
                                        )
                                    );
                                ?>
                                <?php if ( end( $attribute_keys ) === $attribute_name ): ?>
                                    <div class="hvsfw-variations-reset">
                                        <?php
                                            echo wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) );
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    /**
     * Return the variation attributes html.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for variation attributes.
     * $args = [
     *     'product_id' => (integer) The target product's id.
     *     'attribute'  => (array)   The attribute value from $this->get_attribute().
     *     'swatch'     => (array)   The current setting of the swatch.
     *     'template'   => (string)  The type of product page template.
     * ]
     * @return string
     */
    private function get_variation_attribute( $args = [] ) {
        $parameters = [ 'product_id', 'attribute', 'swatch', 'template' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
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

        // Set attribute_limit and is_limited.
        $attribute_limit = $this->settings['gn_sp_attribute_limit'];
        $is_limited      = ( $args['template'] === 'archive-product' && $attribute_limit > 0 ? true : false );

        ob_start();
        ?>
        <div class="hvsfw-attribute" data-attribute="<?php echo esc_attr( $attribute['slug'] ); ?>" data-type="<?php echo esc_attr( $attribute_type ); ?>">
            <?php
                if ( ! empty( $attribute['options'] ) ) {
                    foreach ( $attribute['options'] as $key => $option ) {
                        // Implement limit.
                        if ( $is_limited && ( $key + 1 ) > $attribute_limit ) {
                            break;
                        }

                        // Set term.
                        $term = ( isset( $swatch['term'][ $option['slug'] ] ) ? $swatch['term'][ $option['slug'] ] : [] );
                        if ( ! empty( $term ) ) {

                            // Set term_type.
                            $term_type = $attribute_type;
                            if ( isset( $term['type'] ) && $term['type'] !== 'default' ) {
                                $term_type = $term['type'];
                            } else {
                                if ( $attribute_type === 'assorted' ) {
                                    $term_type = 'button';
                                }
                            }

                            // Set is_default and style to assorted type.
                            if ( $attribute_type === 'assorted' ) {
                                $is_default = 'yes';
                                $style      = $this->get_default_style( $term_type );

                                if ( isset( $term['style']['style'] ) && $term['style']['style'] !== 'default' ) {
                                    $is_default = 'no';
                                    $style      = $term['style'];
                                }
                            }

                            // Set option style and is_default.
                            $option['style']      = $style;
                            $option['is_default'] = $is_default;

                            // Render term type.
                            switch ( $term_type ) {
                                case 'button':
                                    echo $this->get_term_button([
                                        'term'      => $term,
                                        'option'    => $option,
                                        'attribute' => $attribute
                                    ]);
                                    break;
                                case 'color':
                                    echo $this->get_term_color([
                                        'term'      => $term,
                                        'option'    => $option,
                                        'attribute' => $attribute
                                    ]);
                                    break;
                                case 'image':
                                    echo $this->get_term_image([
                                        'term'      => $term,
                                        'option'    => $option,
                                        'attribute' => $attribute
                                    ]);
                                    break;
                            }
                        }
                    }

                    // Render more link.
                    if ( $is_limited && ( count( $attribute['options'] ) > $attribute_limit ) ) {
                        echo $this->get_more_link( $args['product_id'], count( $attribute['options'] ) );
                    }
                }
            ?>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Render the swatch button type.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for swatch button type requirements.
     * $args = [
     *     'term'      => (array)  The term id, value, style, tooltip from saved swatch in post meta.
     *     'option'    => (array)  The term name, slug, value, is_default and style.
     *     'attribute' => (array)  The attribute value from $this->get_attribute().
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
            $term['value']['button_label'] = $option['name'];
        }

        // Set tooltip.
        $tooltip = $this->get_tooltip([
            'term'  => $term,
            'label' => $term['value']['button_label']
        ]);

        // Set CSS.
        $css   = "";
        $style = $option['style'];
        if ( $option['is_default'] === 'no' ) {
            $css .= Helper::minify_css("
                min-width:        {$style['width']};
                min-height:       {$style['height']};
                font-size:        {$style['font_size']};
                font-weight:      {$style['font_weight']};
                line-height:      {$style['font_size']};
                color:            {$style['font_color']};
                background-color: {$style['background_color']};
                padding-top:      {$style['padding_top']};
                padding-bottom:   {$style['padding_bottom']};
                padding-left:     {$style['padding_left']};
                padding-right:    {$style['padding_right']};
                border-style:     {$style['border_style']};
                border-width:     {$style['border_width']};
                border-color:     {$style['border_color']};
            ");
            

            if ( $style['shape'] === 'custom' ) {
                $css .= Helper::minify_css("
                    border-radius: {$style['border_radius']};
                ");
            }
        }

        // Set data-style attribute.
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
        <div class="hvsfw-term" data-type="button" data-enable="yes" data-state="default" data-attribute="<?php echo esc_attr( $attribute['slug'] ); ?>" data-value="<?php echo esc_attr( $option['value'] ); ?>" data-default="<?php echo esc_attr( $option['is_default'] ); ?>" data-shape="<?php echo esc_attr( $style['shape'] ); ?>" data-tooltip="<?php echo esc_attr( $tooltip['is_enabled'] ); ?>" data-style="<?php echo esc_attr( $data_style ); ?>" style="<?php echo esc_attr( $css ); ?>">
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

    /**
     * Render the swatch color type.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for swatch color type requirements.
     * $args = [
     *     'term'      => (array)  The term id, value, style, tooltip from saved swatch in post meta.
     *     'option'    => (array)  The term name, slug, value, is_default and style.
     *     'attribute' => (array)  The attribute value from $this->get_attribute().
     * ]
     * @return string
     */
    private function get_term_color( $args = [] ) {
        $parameters = [ 'term', 'option', 'attribute' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return '';
        }

        $term      = $args['term'];
        $option    = $args['option'];
        $attribute = $args['attribute'];

        // Set background color.
        if ( ! isset( $term['value'] ) ) {
            $term['value']['color'] = Utility::get_swatch_color( $term['id'] );
        }
        $background_color = Utility::get_linear_color( $term['value']['color'] );

        // Set tooltip.
        $tooltip = $this->get_tooltip([
            'term'  => $term,
            'label' => $option['name'],
        ]);

        // Set CSS.
        $css   = "";
        $style = $option['style'];
        if ( $option['is_default'] === 'no' ) {
            $css .= Helper::minify_css("
                border-style: {$style['border_style']};
                border-width: {$style['border_width']};
                border-color: {$style['border_color']};
            ");

            if ( $style['shape'] === 'custom' ) {
                $css .= Helper::minify_css("
                    width:         {$style['width']};
                    height:        {$style['height']};
                    border-radius: {$style['border_radius']};
                ");
            } else {
                $css .= Helper::minify_css("
                    width:  {$style['size']};
                    height: {$style['size']};
                ");
            }
        }

        // Set data-style attribute.
        $data_style = htmlspecialchars( json_encode( [
            'leave' => [
                'border-color' => $style['border_color']
            ],
            'enter' => [
                'border-color' => $style['border_hover_color']
            ],
        ]));
        
        ob_start();
        ?>
        <div class="hvsfw-term" data-type="color" data-enable="yes" data-state="default" data-attribute="<?php echo esc_attr( $attribute['slug'] ); ?>" data-value="<?php echo esc_attr( $option['value'] ); ?>" data-default="<?php echo esc_attr( $option['is_default'] ); ?>" data-shape="<?php echo esc_attr( $style['shape'] ); ?>" data-tooltip="<?php echo esc_attr( $tooltip['is_enabled'] ); ?>" data-style="<?php echo esc_attr( $data_style ); ?>" style="<?php echo esc_attr( $css ); ?>">
            <?php
                if ( $tooltip['is_enabled'] === 'yes' && ! empty( $tooltip['html'] ) ) {
                    echo $tooltip['html'];
                }
            ?>
            <div class="hvsfw-color" style="background: <?php echo esc_attr( $background_color ) ?>;"></div>
        </div>

        <?php

        return ob_get_clean();
    }

    /**
     * Render the swatch image type.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for swatch image type requirements.
     * $args = [
     *     'term'      => (array)  The term id, value, style, tooltip from saved swatch in post meta.
     *     'option'    => (array)  The term name, slug, value, is_default and style.
     *     'attribute' => (array)  The attribute value from $this->get_attribute().
     * ]
     * @return string
     */
    private function get_term_image( $args = [] ) {
        $parameters = [ 'term', 'option', 'attribute' ];
        if ( Utility::has_array_unset( $args, $parameters ) ) {
            return '';
        }

        $term      = $args['term'];
        $option    = $args['option'];
        $attribute = $args['attribute'];

        // Set image source and size.
        if ( ! isset( $term['value'] ) ) {
            $term['value']['image']      = Utility::get_swatch_image( $term['id'] );
            $term['value']['image_size'] = Utility::get_swatch_image_size( $term['id'] );
        }
        $image = Utility::get_swatch_image_by_attachment_id( $term['value']['image'], $term['value']['image_size'] );

        // Set tooltip.
        $tooltip = $this->get_tooltip([
            'term'  => $term,
            'label' => $option['name'],
        ]);
        
        // Set CSS.
        $css   = "";
        $style = $option['style'];
        if ( $option['is_default'] === 'no' ) {
            $css .= Helper::minify_css("
                border-style: {$style['border_style']};
                border-width: {$style['border_width']};
                border-color: {$style['border_color']};
            ");

            if ( $style['shape'] === 'custom' ) {
                $css .= Helper::minify_css("
                    width:         {$style['width']};
                    height:        {$style['height']};
                    border-radius: {$style['border_radius']};
                ");
            } else {
                $css .= Helper::minify_css("
                    width:  {$style['size']};
                    height: {$style['size']};
                ");
            }
        }

        // Set data-style attribute.
        $data_style = htmlspecialchars( json_encode( [
            'leave' => [
                'border-color' => $style['border_color']
            ],
            'enter' => [
                'border-color' => $style['border_hover_color']
            ],
        ]));

        ob_start();
        ?>
        <div class="hvsfw-term" data-type="image" data-enable="yes" data-state="default" data-attribute="<?php echo esc_attr( $attribute['slug'] ); ?>" data-value="<?php echo esc_attr( $option['value'] ); ?>" data-default="<?php echo esc_attr( $option['is_default'] ); ?>" data-shape="<?php echo esc_attr( $style['shape'] ); ?>" data-tooltip="<?php echo esc_attr( $tooltip['is_enabled'] ); ?>" data-style="<?php echo esc_attr( $data_style ); ?>" style="<?php echo esc_attr( $css ); ?>">
            <?php
                if ( $tooltip['is_enabled'] === 'yes' && ! empty( $tooltip['html'] ) ) {
                    echo $tooltip['html'];
                }
            ?>
            <div class="hvsfw-image" style="background-image: url('<?php echo esc_url( $image['src'] ); ?>');"></div>
        </div>
        <?php

        return ob_get_clean();
    }

    /**
     * Return the tooltip component.
     *
     * @since 1.0.0
     * 
     * @param  array  $args  Containing the necessary arguments for tooltip component.
     * $args = [
     *     'term'  => (array)  The term id, value, style, tooltip from saved swatch in post meta.
     *     'label' => (String) The tooltip default label.
     * ]
     * @return array
     */
    private function get_tooltip( $args = [] ) {
        $output = [
            'is_enabled' => 'no',
            'html'       => ''
        ];

        if ( ! $this->settings['gn_enable_tooltip'] ) {
            return $output;
        }

        if ( ! isset( $args['term'] ) || ! isset( $args['label'] ) ) {
            return $output;
        }

        if ( $args['term']['type'] === 'default' && $args['term']['id'] != 0 ) {
            $args['term']['tooltip'] = Utility::get_swatch_tooltip( $args['term']['id'] );
        }

        if ( $args['term']['tooltip']['type'] === 'none' ) {
            return $output;
        }

        $type    = 'text';
        $content = '';
        if ( in_array( $args['term']['tooltip']['type'], [ 'text', 'html', 'image' ] ) ) {
            $type    = $args['term']['tooltip']['type'];
            $content = $args['term']['tooltip']['content'];
        }

        if ( $args['term']['tooltip']['type'] === 'default' && $args['term']['id'] != 0 ) {
            $default_tooltip = Utility::get_swatch_tooltip( $args['term']['id'] );
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
     * Return the more link html.
     *
     * @since 1.0.0
     * 
     * @param  integer  $product_id     The target product's id.
     * @param  integer  $total_options  The total attribute options.
     * @return string
     */
    private function get_more_link( $product_id, $total_options ) {
        if ( empty( $product_id ) || empty( $total_options ) ) {
            return;
        }

        $text       = '';
        $label      = $this->settings['gs_ml_label'];
        $difference = '('. ( $total_options - $this->settings['gn_sp_attribute_limit'] ) .')';
        switch ( $this->settings['gs_ml_format'] ) {
            case 'label':
                $text = $label;
                break;
            case 'number':
                $text = $difference;
                break;
            case 'label-number':
                $text = $label .' '. $difference;
                break;
        }

        ob_start();
        ?>
        <div class="hvsfw-flex hvsfw-flex-ai-c">
            <a class="hvsfw-more-link" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
                <?php echo esc_html( $text ); ?>
            </a>
        </div>
        <?php

        return ob_get_clean();
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
        ];

        $style = [];
        foreach ( $schema as $key => $value ) {
            $index         = $prefix .'_'. $value[0];
            $style[ $key ] = ( isset( $this->settings[ $index ] ) ? $this->settings[ $index ] : $value[1] );
        }

        return $style;
    }

    /**
     * Modify the woocommerce add to cart button in archive or shop page.
     *
     * @since 1.0.0
     * 
     * @param  array   $args     The current wp parse arguments.
     * @param  object  $product  The wc_product object.
     * @return array
     */
    public function modify_add_to_cart_args( $args, $product ) {
        if ( $product->is_type( 'variable' ) ) {
            $args['class']                               .= ' hvsfw-js-loop-add-to-cart-btn';
            $args['attributes']['data-is-available']     = 'no';
            $args['attributes']['data-available-text']   = 'Add To Cart';
            $args['attributes']['data-unavailable-text'] = esc_attr( $product->add_to_cart_text() );
        }

        return $args;
    }

    /**
     * Modify the woocommerce product's available variations.
     *
     * @since 1.0.0
     * 
     * @param  array   $fields     Contain the fields used in add to cart form variation.
     * @param  object  $product    The current target product.
     * @param  object  $variation  The current target product's available variations.
     * @return array
     */
    public function modify_available_variations( $fields, $product, $variation ) {
        // Remove out of stock product variation.
        if ( $this->settings['gn_disable_item_oos'] ) {
            return $variation->is_in_stock() ? $fields : false;
        }

        return $fields;
    }

    /**
     * Adding product variation to cart.
     *
     * @since 1.0.0
     *
     * @return json
     */
    public function variation_add_to_cart() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'productId', 'variationId', 'quantity' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        $product_id           = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['productId'] ) );
        $quantity             = ( absint( $_POST['quantity'] ) <= 0 ? 1 : absint( $_POST['quantity'] ) );
        $variation_id         = absint( $_POST['variationId'] );
        $variation_attributes = [];

        // Validate product.
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            wc_add_notice( 'The product you are trying to add to the cart is not found.', 'error' );
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }

        // Validate product status.
        if ( get_post_status( $product_id ) !== 'publish' ) {
            wc_add_notice( 'The product you are trying to add is not yet publish.', 'error' );
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }

        // Validate product type.
        if ( ! $product->is_type( 'variable' ) ) {
            wc_add_notice( 'The product you are trying to add is not a variable product type.', 'error' );
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }

        // Validate product variation.
        if ( ! Helper::is_valid_variation_id( $variation_id, $product ) ) {
            wc_add_notice( 'The product variation you are trying to add to the cart is not found.', 'error' );
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }

        // Get product variation.
        $variation = wc_get_product( $variation_id );
        if ( ! $variation ) {
            wc_add_notice( 'The product variation you are trying to add to the cart is not found.', 'error' );
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }

        // Get product variation attributes.
        $variation_attributes = wc_get_product_variation_attributes( $variation_id );

        // Adding to cart.
        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation_attributes );
        $is_added_to_cart  = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation_attributes );
        if ( $passed_validation && $is_added_to_cart ) {
            $product_thumbnail = Helper::get_product_small_thumbnail( 'variable', $product, $variation );
            Helper::custom_add_to_cart_message_success( $variation->get_name() );
            wp_send_json_success([
                'response'          => 'SUCCESSFULLY_ADDED_TO_CART',
                'notice'            => wc_print_notices( true ),
                'product_name'      => $variation->get_name(),
                'product_thumbnail' => $product_thumbnail,
                'cart_hash'         => WC()->cart->get_cart_hash(),
                'fragments'         => apply_filters( 'woocommerce_add_to_cart_fragments', [] )
            ]);
        } else {
            wp_send_json_success([
                'response' => 'FAILED_ADDING_TO_CART',
                'notice'   => wc_print_notices( true )
            ]);
        }
    }
}