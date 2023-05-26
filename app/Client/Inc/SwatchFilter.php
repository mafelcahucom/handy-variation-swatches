<?php
namespace HVSFW\Client\Inc;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Utility;
use HVSFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Swatch Filter Components.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SwatchFilter {

    /**
	 * Inherit Singleton.
	 */
	use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Return the variation swatch filter title component.
     *
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating title component.
     * $args = [
     *     'text'  => (string) The title text or content.
     *     'style' => (string) Contains the inline style.
     * ]
     * @return HTMLElement
     */
    public static function get_title_component( $args = [] ) {
        if ( ! isset( $args['text'] ) ) {
            return '';
        }
        
        $text  = $args['text'];
        $style = ( isset( $args['style'] ) ? $args['style'] : '' );

        ob_start();
        ?>
        <?php if ( $text !== '' ): ?>
            <label class="hvsfw-vf-title" style="<?php echo esc_attr( $style ); ?>">
                <?php echo esc_html( $text ); ?>
            </label>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter swatch list version component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating swatch list component.
     * $args = [
     *      'attribute'  => (object)  The target variation attribute.
     *      'query_type' => (string)  The filter query type 'and, or'.
     *      'show_count' => (boolean) Contains the  flag to display product count.
     *      'styles'     => (array)   Contains the inline styles.
     * ]
     * @return HTMLElement
     */
    public static function get_swatch_list_component( $args = [] ) {
        if ( ! isset( $args['attribute'] ) ) {
            return '';
        }
        
        $attribute  = $args['attribute'];
        $query_type = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $show_count = ( isset( $args['show_count'] ) ? $args['show_count'] : false );
        $styles     = [
            'li'       => ( isset( $args['styles']['li'] ) ? $args['styles']['li'] : '' ),
            'a'        => ( isset( $args['styles']['a'] ) ? $args['styles']['a'] : '' ),
            'a:active' => ( isset( $args['styles']['a:active'] ) ? $args['styles']['a:active'] : '' ),
        ];

        $terms = [];
        foreach ( $attribute['terms'] as $key => $term ) {
            $terms[ $key ]['label']   = $term->name . ( $show_count ? " ({$term->count})" : '' );
            $terms[ $key ]['style_a'] = ( self::is_filter_found( $term ) ? $styles['a:active'] : $styles['a'] );
            $terms[ $key ]['url']     = self::get_filter_url([
                'term'        => $term,
                'query_type'  => $query_type,
                'is_multiple' => true
            ]);
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-swatch-list">
            <ul class="hvsfw-vf-swatch-list__ul">
                <?php foreach ( $terms as $term ): ?>
                    <li class="hvsfw-vf-swatch-list__li" style="<?php echo esc_attr( $styles['li'] ); ?>">
                        <div class="hvsfw-vf-swatch-list__a hvsfw-vf-link" data-url="<?php echo esc_url( $term['url'] ); ?>" style="<?php echo esc_attr( $term['style_a'] ) ?>">
                            <?php echo esc_html( $term['label'] ); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter swatch select version component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating swatch select component.
     * $args = [
     *      'attribute'  => (object)  The target variation attribute.
     *      'query_type' => (string)  The filter query type 'and, or'.
     *      'show_count' => (boolean) Contains the  flag to display product count.
     *      'styles'     => (array)   Contains the inline styles.
     * ]
     * @return HTMLElement
     */
    public static function get_swatch_select_component( $args = [] ) {
        if ( ! isset( $args['attribute'] ) ) {
            return '';
        }

        $attribute  = $args['attribute'];
        $query_type = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $show_count = ( isset( $args['show_count'] ) ? $args['show_count'] : false );
        $styles     = [
            'parent' => ( isset( $args['styles']['parent'] ) ? $args['styles']['parent'] : '' ),
            'select' => ( isset( $args['styles']['select'] ) ? $args['styles']['select'] : '' ),
            'button' => ( isset( $args['styles']['button'] ) ? $args['styles']['button'] : '' ),
        ];

        $placeholder = "Select {$attribute['attribute_label']}";
        $clear_url   = '';
        $state       = 'default';
        $terms       = [];
        foreach ( $attribute['terms'] as $key => $term ) {
            $terms[ $key ]['label'] = $term->name . ( $show_count ? " ({$term->count})" : '' );
            $terms[ $key ]['url']   = self::get_filter_url([
                'term'        => $term,
                'query_type'  => $query_type,
                'is_multiple' => false
            ]);

            $terms[ $key ]['selected'] = '';
            if ( self::is_filter_found( $term ) ) {
                $state                     = 'active';
                $clear_url                 = self::get_filter_empty_url( $term );
                $terms[ $key ]['selected'] = 'selected="selected"';
            }
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-swatch-select" data-state="<?php echo $state; ?>" style="<?php echo esc_attr( $styles['parent'] ); ?>">
            <select class="hvsfw-vf-swatch-select__select" style="<?php echo esc_attr( $styles['select'] ); ?>">
                <?php if ( $state !== 'active' ): ?>
                    <option>
                        <?php echo esc_html( $placeholder ); ?>
                    </option>
                <?php endif; ?>
                <?php foreach ( $terms as $term ): ?>
                    <option value="<?php echo esc_url( $term['url'] ); ?>" <?php echo $term['selected']; ?>>
                        <?php echo esc_attr( $term['label'] ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="hvsfw-vf-swatch-select__clear-btn" data-url="<?php echo esc_url( $clear_url ); ?>" style="<?php echo esc_attr( $styles['button'] ); ?>">
                <?php echo Helper::get_icon( 'close-filled' ); ?>
            </button>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter swatch button version component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating swatch button component.
     * $args = [
     *      'attribute'  => (object)  The target variation attribute.
     *      'query_type' => (string)  The filter query type 'and, or'.
     *      'show_count' => (boolean) Contains the  flag to display product count.
     *      'styles'     => (array)   Contains the inline styles.
     * ]
     * @return HTMLElement
     */
    public static function get_swatch_button_component( $args = [] ) {
        if ( ! isset( $args['attribute'] ) ) {
            return '';
        }

        $attribute  = $args['attribute'];
        $query_type = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $show_count = ( isset( $args['show_count'] ) ? $args['show_count'] : false );
        $styles     = [
            'parent'     => ( isset( $args['styles']['parent'] ) ? $args['styles']['parent'] : '' ),
            'box'        => ( isset( $args['styles']['box'] ) ? $args['styles']['box'] : '' ),
            'box:active' => ( isset( $args['styles']['box:active'] ) ? $args['styles']['box:active'] : '' ),
        ];

        $terms = [];
        foreach ( $attribute['terms'] as $key => $term ) {
            $terms[ $key ]['label']     = $term->name . ( $show_count ? " ({$term->count})" : '' );
            $terms[ $key ]['style_box'] = ( self::is_filter_found( $term ) ? $styles['box:active'] : $styles['box'] );
            $terms[ $key ]['url']       = self::get_filter_url([
                'term'        => $term,
                'query_type'  => $query_type,
                'is_multiple' => true
            ]);
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-swatch-button" style="<?php echo esc_attr( $styles['parent'] ); ?>">
            <?php foreach ( $terms as $term ): ?>
                <div class="hvsfw-vf-swatch-button__box hvsfw-vf-link" data-url="<?php echo esc_url( $term['url'] ); ?>" style="<?php echo esc_attr( $term['style_box'] ); ?>">
                    <?php echo esc_html( $term['label'] ); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter swatch color version component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating swatch color component.
     * $args = [
     *      'attribute'  => (object) The target variation attribute.
     *      'query_type' => (string) The filter query type 'and, or'.
     *      'styles'     => (array)  Contains the inline styles.
     * ]
     * @return HTMLElement
     */
    public static function get_swatch_color_component( $args = [] ) {
        if ( ! isset( $args['attribute'] ) ) {
            return '';
        }

        $attribute  = $args['attribute'];
        $query_type = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $styles     = [
            'parent'     => ( isset( $args['styles']['parent'] ) ? $args['styles']['parent'] : '' ),
            'box'        => ( isset( $args['styles']['box'] ) ? $args['styles']['box'] : '' ),
            'box:active' => ( isset( $args['styles']['box:active'] ) ? $args['styles']['box:active'] : '' ),
        ];

        $terms = [];
        foreach ( $attribute['terms'] as $key => $term ) {
            $terms[ $key ]['color']     = Utility::get_linear_color( $term->meta );
            $terms[ $key ]['style_box'] = ( self::is_filter_found( $term ) ? $styles['box:active'] : $styles['box'] );
            $terms[ $key ]['url']       = self::get_filter_url([
                'term'        => $term,
                'query_type'  => $query_type,
                'is_multiple' => true
            ]);
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-swatch-color" style="<?php echo esc_attr( $styles['parent'] ); ?>">
            <?php foreach ( $terms as $term ): ?>
                <div class="hvsfw-vf-swatch-color__box hvsfw-vf-link" data-url="<?php echo esc_url( $term['url'] ); ?>" style="<?php echo esc_attr( $term['style_box'] ); ?>">
                    <div class="hvsfw-vf-swatch-color__color" style="background: <?php echo esc_attr( $term['color'] ); ?>"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter swatch image version component.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for creating image color component.
     * $args = [
     *      'attribute'  => (object) The target variation attribute.
     *      'query_type' => (string) The filter query type 'and, or'.
     *      'styles'     => (array)  Contains the inline styles.
     * ]
     * @return HTMLElement
     */
    public static function get_swatch_image_component( $args = [] ) {
        if ( ! isset( $args['attribute'] ) ) {
            return '';
        }

        $attribute  = $args['attribute'];
        $query_type = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $styles     = [
            'parent'     => ( isset( $args['styles']['parent'] ) ? $args['styles']['parent'] : '' ),
            'box'        => ( isset( $args['styles']['box'] ) ? $args['styles']['box'] : '' ),
            'box:active' => ( isset( $args['styles']['box:active'] ) ? $args['styles']['box:active'] : '' ),
        ];

        $terms = [];
        foreach ( $attribute['terms'] as $key => $term ) {
            $terms[ $key ]['image']     = $term->meta['src'];
            $terms[ $key ]['style_box'] = ( self::is_filter_found( $term ) ? $styles['box:active'] : $styles['box'] );
            $terms[ $key ]['url']       = self::get_filter_url([
                'term'        => $term,
                'query_type'  => $query_type,
                'is_multiple' => true
            ]);
        }

        ob_start();
        ?>
        <div class="hvsfw-vf-swatch-image" style="<?php echo esc_attr( $styles['parent'] ); ?>">
            <?php foreach ( $terms as $term ): ?>
                <div class="hvsfw-vf-swatch-image__box hvsfw-vf-link" data-url="<?php echo esc_url( $term['url'] ); ?>" style="<?php echo esc_attr( $term['style_box'] ); ?>">
                    <div class="hvsfw-vf-swatch-image__image" style="background-image: url('<?php echo esc_url( $term['image'] ); ?>')"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the filter url by attribute term.
     * 
     * @since 1.0.0
     *
     * @param  array  $args  Contains all data for generating filter url.
     * $args = [
     *      'term'        => (object)  Contains the attribute term.
     *      'query_type'  => (string)  The filter query type 'and, or'.
     *      'is_multiple' => (boolean) The flag if parameter accepts multiple value.
     * ]
     * @return string
     */
    private static function get_filter_url( $args = [] ) {
        $url = self::get_current_url();
        if ( ! isset( $args['term'] ) || ! $args['term'] ) {
            return $url;
        }
        
        $term          = $args['term'];
        $query_type    = ( isset( $args['query_type'] ) ? $args['query_type'] : 'and' );
        $is_multiple   = ( isset( $args['is_multiple'] ) ? $args['is_multiple'] : true );
        $query_vars    = $_GET;
        $taxonomy_name = substr( $term->taxonomy, 3 );
        $filter        = [
            'name'  => "filter_attr_{$taxonomy_name}",
            'value' => $term->slug
        ];
        $type          = [
            'name'  => "query_type_attr_{$taxonomy_name}",
            'value' => $query_type
        ];

        if ( $is_multiple === true ) {
            if ( self::is_filter_found( $term ) ) {
                $exploded = explode( ',', $query_vars[ $filter['name'] ] );
                if ( ( $key = array_search( $filter['value'], $exploded ) ) !== false ) {
                    unset( $exploded[ $key ] );
                }

                $imploded = implode( ',', $exploded );
                if ( $imploded == '' ) {
                    unset( $query_vars[ $filter['name'] ] );
                } else {
                    $query_vars[ $filter['name'] ] = $imploded;
                }
            } else {
                $values = [];
                if ( isset( $query_vars[ $filter['name'] ] ) ) {
                    $values = explode( ',', $query_vars[ $filter['name'] ] );
                }

                array_push( $values, $filter['value'] );
                $query_vars[ $filter['name'] ] = implode( ',', $values );
            }
        } else {
            $query_vars[ $filter['name'] ] = $filter['value'];
        }

        if ( $query_type === 'or' ) {
            if ( isset( $query_vars[ $type['name'] ] ) ) {
                unset( $query_vars[ $type['name'] ] );
            }
        } else {
            $query_vars[ $type['name'] ] = 'and';
            if ( ! isset( $query_vars[ $filter['name'] ] ) ) {
                unset( $query_vars[ $type['name'] ] );
            }
        }
    
        $url = self::get_current_page_base_url();
        if ( ! empty( $query_vars ) ) {
            $url = urldecode( self::get_current_page_base_url() .'?'. http_build_query( $query_vars ) );
        }
        
        return $url;
    }

    /**
     * Return the filter empty url by attribute term.
     * 
     * @since 1.0.0
     *
     * @param  object  $term  Contains the attribute term.
     * @return string
     */
    private static function get_filter_empty_url( $term ) {
        $url = self::get_current_url();
        if ( ! $term ) {
            return $url;
        }

        $query_vars    = $_GET;
        $taxonomy_name = substr( $term->taxonomy, 3 );
        $type_name     = "query_type_attr_{$taxonomy_name}";
        $filter_name   = "filter_attr_{$taxonomy_name}";

        if ( isset( $query_vars[ $filter_name ] ) ) {
            unset( $query_vars[ $filter_name ] );
        }

        if ( isset( $query_vars[ $type_name ] ) ) {
            unset( $query_vars[ $type_name ] );
        }

        $url = self::get_current_page_base_url();
        if ( ! empty( $query_vars ) ) {
            $url = urldecode( self::get_current_page_base_url() .'?'. http_build_query( $query_vars ) );
        }

        return $url;
    }

    /**
     * Return the current url.
     * 
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_current_url() {
        $url  = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://' );
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['REQUEST_URI'];
        
        return $url;
    }

    /**
     * Return the current page base url.
     * 
     * @since 1.0.0
     *
     * @return string
     */
    private static function get_current_page_base_url() {
        return strtok( self::get_current_url(), '?' );
    }

    /**
     * Checks if the filter parameter and it's value found in url.
     * 
     * @since 1.0.0
     *
     * @param  object  $term  Contains the attribute term.
     * @return boolean
     */
    private static function is_filter_found( $term ) {
        if ( ! $term ) {
            return false;
        }

        $filter = [
            'name'  => 'filter_attr_' . substr( $term->taxonomy, 3 ),
            'value' => $term->slug
        ];

        if ( isset( $_GET[ $filter['name'] ] ) ) {
            $current_value = $_GET[ $filter['name'] ];
            if ( $current_value != '' ) {
                return in_array( $filter['value'], explode( ',', $current_value ) );
            }
        }

        return false;
    }
}