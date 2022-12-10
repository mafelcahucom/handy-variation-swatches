<?php
namespace HVSFW\Client;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Client\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Style.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Style {

	/**
	 * Inherit Singleton.
	 */
	use Singleton;

	/**
     * Print internal css in wp_head.
     *
     * @since 1.0.0
     */
    protected function __construct() {
        add_action( 'wp_head', [ $this, 'custom_internal_css' ], 100 );
    }

    /**
     * Return the validated property values.
     *
     * @since 1.0.0
     *
     * @param  array   $settings  Contains all the settings from _hvsfw_main_settings.
     * @param  arrray  $rules     Contains the rule of the property key & default value.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_properties( $settings, $rules, $prefix ) {
        if ( empty( $settings ) || empty( $rules ) || empty( $prefix ) ) {
            return;
        }

        $output = '';
        foreach ( $rules as $key => $default ) {
            $index   = $prefix .'_'. $key;
            $output .= ' '. ( isset( $settings[ $index ] ) ? $settings[ $index ] : $default );
        }
        return $output;
    }

    /**
     * Return property values of padding in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hvsfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_padding( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'pt' => '0px',
            'pr' => '0px',
            'pb' => '0px',
            'pl' => '0px'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of margin in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hvsfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_margin( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'mt' => '0px',
            'mr' => '0px',
            'mb' => '0px',
            'ml' => '0px'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Return property values of border in single line.
     *
     * @since 1.0.0
     * 
     * @param  array   $settings  Contains all the settings from _hvsfw_main_settings.
     * @param  string  $prefix    The prefix of the class name.
     * @return string
     */
    private function get_border( $settings, $prefix ) {
        if ( empty( $settings ) || empty( $prefix ) ) {
            return;
        }

        $rules = [
            'bw'    => '0px',
            'bs'    => 'none',
            'b_clr' => '#000000'
        ];

        return $this->get_properties( $settings, $rules, $prefix );
    }

    /**
     * Minify the internal css.
     *
     * @since 1.0.0
     * 
     * @param  string  $css  The internal css to be minify.
     * @return string
     */
    private function minify_internal_css( $css ) {
        $css = preg_replace( '/\s+/', ' ', $css );
        $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
        $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        return trim( $css );
    }

    /**
     * Custom Internal Css.
     *
     * @since 1.0.0
     * 
     * @return string
     */
    public function custom_internal_css() {
        $settings = get_option( '_hvsfw_main_settings' );

        // Global
        $class = "
            .hvsfw * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .hvsfw p,
            .hvsfw figure {
                margin: 0;
            }
            .hvsfw ul {
                padding: 0;
                margin: 0;
                list-style: none;
            }
            .hvsfw a {
                text-decoration: none;
            }
            .hvsfw button {
                cursor: pointer;
                outline: none;
            }
            .hvsfw button[data-state='loading'] {
                cursor: loading;
            }
            .hvsfw button[data-state='disabled'] {
                cursor: not-allowed;
            }
            .hvsfw button > * {
                pointer-events: none;
            }
            .hvsfw svg {
                display: block;
            }
            .hvsfw-flex {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
            }
            .hvsfw-flex-ai-c {
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }
            .hvsfw-flex-jc-c {
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }
            .hvsfw-flex-jc-sb {
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
            }
            .hvsfw-flex-jc-ed {
                -webkit-box-pack: end;
                -ms-flex-pack: end;
                justify-content: flex-end
            }
            .hvsfw-flex-c {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }
            .hvsfw-hover:hover,
            .hvsfw-hover:focus {
                -webkit-transition: all 320ms ease-in-out 0s;
                -o-transition: all 320ms ease-in-out 0s;
                transition: all 320ms ease-in-out 0s;
            }
        ";
        
        // Additional CSS.
        if ( ! empty( $settings['ad_stg_additional_css'] ) ) {
            $class .= $settings['ad_stg_additional_css'];
        }

        $style = '<style id="hvsfw-internal-style">'. $class .'</style>';
        echo $this->minify_internal_css( $style );
    }
}