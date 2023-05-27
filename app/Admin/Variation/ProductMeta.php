<?php
namespace HVSFW\Admin\Variation;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Inc\Traits\Security;
use HVSFW\Inc\Validator;
use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\SwatchHelper;
use HVSFW\Admin\Variation\ProductMetaView;

defined( 'ABSPATH' ) || exit;

/**
 * Product Swatch Meta Box.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class ProductMeta {

    /**
     * Inherit Singleton.
     */
    use Singleton;

    /**
     * Inherit Security.
     */
    use Security;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        // Register styles and scripts.
        add_action( 'admin_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_scripts' ] );

         // Add swatch setting product tab.
        add_filter( 'woocommerce_product_data_tabs', [ $this, 'custom_product_tab' ] );

        // Add swatch setting product panel.
        add_filter( 'woocommerce_product_data_panels', [ $this, 'custom_product_panel' ] );

        // Save swatch settings event.
        add_action( 'wp_ajax_hvsfw_save_swatch_settings', [ $this, 'save_swatch_settings' ] );

        // Update swatch settings event.
        add_action( 'wp_ajax_hvsfw_update_swatch_settings', [ $this, 'update_swatch_settings' ] );

        // Reset swatch settings event.
        add_action( 'wp_ajax_hvsfw_reset_swatch_settings', [ $this, 'reset_swatch_settings' ] );
    }

    /**
     * Checks if the page is in post product edit page.
     *
     * @since 1.0.0
     * 
     * @return boolean
     */
    private function is_correct_page() {
        $current_screen = get_current_screen();
        return ( isset( $current_screen->id ) && $current_screen->id === 'product' );
    }

    /**
     * Register all styles.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_styles( $hook_suffix ) {
        if ( $hook_suffix !== 'post.php' && ! $this->is_correct_page() ) {
            return;
        }

        wp_register_style( 'hvsfw-product-css', Helper::get_asset_src( 'css/hvsfw-product.min.css' ), [], '1.0.0', 'all' );

        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'hvsfw-product-css' );
    }

    /**
     * Register all scripts.
     *
     * @param string  $hook_suffix  Hook suffix for the current admin page.
     *
     * @since 1.0.0
     */
    public function register_scripts( $hook_suffix ) {
        if ( $hook_suffix !== 'post.php' && ! $this->is_correct_page() ) {
            return;
        }

        $dependency = [ 'jquery', 'wp-color-picker' ];

        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        wp_register_script( 'hvsfw-product-js', Helper::get_asset_src( 'js/hvsfw-product.min.js' ), $dependency, '1.0.0', true );

        wp_enqueue_script( 'hvsfw-product-js' );

        // Localize variables.
        wp_localize_script( 'hvsfw-product-js', 'hvsfwLocal', [
            'url'       => admin_url( 'admin-ajax.php' ),
            'variation' => [
                'product' => [
                    'nonce' => [
                        'saveSwatchSettings'   => wp_create_nonce( 'hvsfw_save_swatch_settings' ),
                        'updateSwatchSettings' => wp_create_nonce( 'hvsfw_update_swatch_settings' ),
                        'resetSwatchSettings'  => wp_create_nonce( 'hvsfw_reset_swatch_settings' ),
                    ]
                ]
            ]
        ]);
    }

    /**
     * Add product swatches tab.
     *
     * @since 1.0.0
     * 
     * @param  array  $tabs  Containing all the current registered tabs.
     * @return array
     */
    public function custom_product_tab( $tabs ) {
        $tabs['hvsfw_swatch_tab'] = [
            'label'    => 'Swatches',
            'target'   => 'hvsfw_swatch_panel',
            'class'    => [ 'show_if_variable' ],
            'priority' => 100,
        ];

        return $tabs;
    }

    /**
     * Add product swatches panel
     *
     * @since 1.0.0
     */
    public function custom_product_panel() {
        global $post;

        // Render swatch panel.
        ProductMetaView::swatches_panel( $post->ID );
    }

    /**
     * Save swatch settings in post meta via AJAX.
     *
     * @since 1.0.0
     * 
     * @return json
     */
    public function save_swatch_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'formData' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        $data       = $this->parse_query_string( $_POST['formData'] );
        $no_post_id = ( ! isset( $data['post_ID'] ) || empty( $data['post_ID'] ) );
        $no_value   = ( ! isset( $data['_hvsfw_value'] ) || empty( $data['_hvsfw_value'] ) );
        if ( $no_post_id || $no_value ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR',
            ]);
        }

        $validated = $this->validate_swatches( $data['_hvsfw_value'] );
        if ( empty( $validated ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        $product = wc_get_product( $data['post_ID'] );
        if ( empty( $product ) ) {
            wp_send_json_error([
                'error' => 'INVALID_PRODUCT_ID'
            ]);
        }

        if ( $product->get_type() !== 'variable' ) {
            wp_send_json_error([
                'error' => 'NOT_VARIABLE_PRODUCT',
            ]);
        }

        update_post_meta( $data['post_ID'], '_hvsfw_swatches', $validated );

        wp_send_json_success([
            'response' => 'SUCCESSFULLY_SAVED'
        ]);
    }

    /**
     * Update swatch settings in post meta via AJAX.
     *
     * @since 1.0.0
     * 
     * @return json
     */
    public function update_swatch_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'postId' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        ob_start();
        ProductMetaView::swatch_attributes( $_POST['postId'] );
        $content = ob_get_clean();

        wp_send_json_success([
            'response' => 'SUCCESSFULLY_UPDATED',
            'content'  => $content
        ]);
    }

    /**
     * Reset swatch settings in post meta via AJAX.
     *
     * @since 1.0.0
     * 
     * @return json
     */
    public function reset_swatch_settings() {
        if ( ! self::is_security_passed( $_POST ) ) {
            wp_send_json_error([
                'error' => 'SECURITY_ERROR'
            ]);
        }

        if ( self::has_post_empty_data( $_POST, [ 'postId' ] ) ) {
            wp_send_json_error([
                'error' => 'MISSING_DATA_ERROR'
            ]);
        }

        update_post_meta( $_POST['postId'], '_hvsfw_swatches', [] );

        wp_send_json_success([
            'response' => 'SUCCESSFULLY_SAVED'
        ]);
    }
    
    /**
     * Parse string query into an associative array.
     *
     * @since 1.0.0
     * 
     * @param  string  $query_string   The query string to be parse.
     * @param  string  $arg_separator  The query arguments separator.
     * @param  string  $dec_type       The decoding type.
     * @return array
     */
    private function parse_query_string( $query_string, $arg_separator = '&', $dec_type = PHP_QUERY_RFC1738 ) {
        $result = array();
        $parts  = explode( $arg_separator, $query_string );

        foreach ( $parts as $part ) {
            list( $param_name, $param_value ) = explode( '=', $part, 2 );

            switch ( $dec_type ) {
                case PHP_QUERY_RFC3986:
                    $param_name  = rawurldecode( $param_name );
                    $param_value = rawurldecode( $param_value );
                    break;
                case PHP_QUERY_RFC1738:
                default:
                    $param_name  = urldecode( $param_name );
                    $param_value = urldecode( $param_value );
                    break;
            }


            if ( preg_match_all( '/\[([^\]]*)\]/m', $param_name, $matches ) ) {
                $param_name = substr( $param_name, 0, strpos( $param_name, '[' ) );
                $keys       = array_merge( array( $param_name ), $matches[1] );
            } else {
                $keys       = array( $param_name );
            }

            $target = &$result;
            foreach ( $keys as $index ) {
                if ( $index === '' ) {
                    if ( isset( $target ) ) {
                        if ( is_array( $target ) ) {
                            $int_keys = array_filter( array_keys( $target ), 'is_int' );
                            $index    = count( $int_keys ) ? max( $int_keys ) + 1 : 0;
                        } else {
                            $target   = array( $target );
                            $index    = 1;
                        }
                    } else {
                        $target = array();
                        $index  = 0;
                    }
                } elseif ( isset( $target[ $index ] ) && ! is_array( $target[ $index ] ) ) {
                    $target[ $index ] = array( $target[ $index ] );
                }

                $target = &$target[ $index ];
            }

            if ( is_array( $target ) ) {
                $target[] = $param_value;
            } else {
                $target   = $param_value;
            }
        }

        return $result;
    }

    /**
     * Return validated and sanitized value in each swatches.
     *
     * @since 1.0.0
     * 
     * @param  array  $swatches  Containing the swatches value.
     * @return array
     */
    private function validate_swatches( $swatches ) {
        if ( empty( $swatches ) ) {
            return [];
        }

        $validated = []; // Stores the validated swatch.
        foreach ( $swatches as $attr => $swatch ) {

            // Store attribute type.
            $validated[ $attr ]['type'] = 'select';
            if ( isset( $swatch['type'] ) ) {
                $validated[ $attr ]['type'] = Validator::validate_select([
                    'value'   => $swatch['type'],
                    'default' => 'select',
                    'choices' => [ 'default', 'select', 'button', 'color', 'image', 'assorted' ]
                ]);
            }

            $attribute_type = $validated[ $attr ]['type'];

            // Store attribute custom.
            $validated[ $attr ]['custom'] = 'yes';
            if ( isset( $swatch['custom'] ) ) {
                $validated[ $attr ]['custom'] = Validator::validate_select([
                    'value'   => $swatch['custom'],
                    'default' => 'yes',
                    'choices' => [ 'yes', 'no' ]
                ]);
            }

            // Store global style.
            $validated[ $attr ]['style'] = [];
            if ( in_array( $attribute_type, [ 'button', 'color', 'image' ] ) ) {
                $validated[ $attr ]['style'] = SwatchHelper::validate_swatch_setting_value([
                    'type'    => $attribute_type,
                    'setting' => $swatch['style']
                ]);
            }

            // Iterate term.
            $validated[ $attr ]['term'] = [];
            if ( isset( $swatch['term'] ) && ! empty( $swatch['term'] ) ) {
                foreach ( $swatch['term'] as $key => $term ) {

                    // Store ID.
                    $validated[ $attr ]['term'][ $key ]['id'] = 0;
                    if ( isset( $term['id'] ) && is_numeric( $term['id'] ) ) {
                        $validated[ $attr ]['term'][ $key ]['id'] = sanitize_text_field( $term['id'] );
                    }

                    // Store type and style.
                    $validated[ $attr ]['term'][ $key ]['type']  = $attribute_type;
                    $validated[ $attr ]['term'][ $key ]['style'] = [];
                    if ( $attribute_type === 'assorted' ) {
                        // Type.
                        $validated[ $attr ]['term'][ $key ]['type'] = Validator::validate_select([
                            'value'   => $term['type'],
                            'default' => 'button',
                            'choices' => [ 'button', 'color', 'image' ]
                        ]);

                        // Style.
                        $validated[ $attr ]['term'][ $key ]['style'] = SwatchHelper::validate_swatch_setting_value([
                            'type'    => $validated[ $attr ]['term'][ $key ]['type'],
                            'setting' => $term['style']
                        ]);
                    }

                    $term_type = $validated[ $attr ]['term'][ $key ]['type'];

                    // Store value.
                    if ( isset( $term['value'] ) ) {
                        $term_value = $term['value'];

                        // Button.
                        if ( $term_type === 'button' ) {
                            if ( isset( $term_value['button_label'] ) && isset( $term_value['button_default'] ) ) {
                                $button_label = ( ! empty( $term_value['button_label'] ) ? $term_value['button_label'] : $term_value['button_default'] );
                                $validated[ $attr ]['term'][ $key ]['value']['button_label'] = sanitize_text_field( $button_label );
                            }
                        }

                        // Color.
                        if ( $term_type === 'color' ) {
                            if ( isset( $term_value['color'] ) && ! empty( $term_value['color'] ) && is_array( $term_value['color'] ) ) {
                                foreach ( $term_value['color'] as $color ) {
                                    $validated[ $attr ]['term'][ $key ]['value']['color'][] = Validator::validate_color([
                                        'value'   => $color,
                                        'default' => '#ffffff'
                                    ]);
                                }
                            }
                        }

                        // Image.
                        if ( $term_type === 'image' ) {
                            if ( isset( $term_value['image'] ) ) {
                                $image_id = sanitize_text_field( $term_value['image'] );
                                $image_id = ( is_numeric( $image_id ) ? $image_id : 0 );
                                $validated[ $attr ]['term'][ $key ]['value']['image'] = $image_id;
                            }

                            $validated[ $attr ]['term'][ $key ]['value']['image_size'] = 'thumbnail';
                            if ( isset( $term_value['image_size'] ) ) {
                                $validated[ $attr ]['term'][ $key ]['value']['image_size'] = Validator::validate_select([
                                    'value'   => $term_value['image_size'],
                                    'default' => 'thumbnail',
                                    'choices' => array_column( Helper::get_image_sizes(), 'value' )
                                ]);
                            }
                        }
                    }

                    // Store tooltip.
                    if ( isset( $term['tooltip'] ) ) {
                        $term_tooltip = $term['tooltip'];

                        // Type.
                        $validated[ $attr ]['term'][ $key ]['tooltip']['type'] = 'none';
                        if ( isset( $term_tooltip['type'] ) ) {
                            // Set tooltip type choices.
                            $tooltip_choices = [ 'none', 'default', 'text', 'html', 'image' ];
                            if ( $validated[ $attr ]['custom'] === 'yes' ) {
                                // Remove default in tooltip choices.
                                unset( $tooltip_choices[1] );
                            }

                            $validated[ $attr ]['term'][ $key ]['tooltip']['type'] = Validator::validate_select([
                                'value'   => $term_tooltip['type'],
                                'default' => 'none',
                                'choices' => $tooltip_choices
                            ]);
                        }

                        $tooltip_type    = $validated[ $attr ]['term'][ $key ]['tooltip']['type'];
                        $tooltip_content = '';

                        // Content text.
                        if ( $tooltip_type === 'text' ) {
                            if ( isset( $term_tooltip['content_text'] ) ) {
                                $tooltip_content = sanitize_text_field( $term_tooltip['content_text'] );
                            }
                        }

                        // Content html.
                        if ( $tooltip_type === 'html' ) {
                            if ( isset( $term_tooltip['content_html'] ) ) {
                                $tooltip_content = wp_kses_post( $term_tooltip['content_html'] );
                            }
                        }

                        // Content image.
                        if ( $tooltip_type === 'image' ) {
                            $tooltip_content = 0;
                            if ( isset( $term_tooltip['content_image'] ) ) {
                                $tooltip_image_id = sanitize_text_field( $term_tooltip['content_image'] );
                                $tooltip_content  = ( is_numeric( $tooltip_image_id ) ? $tooltip_image_id : 0 );
                            }
                        }

                        $validated[ $attr ]['term'][ $key ]['tooltip']['content'] = $tooltip_content;
                    }
                }
            }
        }

        return $validated;
    }
}