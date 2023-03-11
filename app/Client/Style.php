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

        // Keyframes.
        $class = "
            @-webkit-keyframes hvsfw-fade-in-bottom {
                0% {
                    -webkit-transform: translateY(5px);
                    transform: translateY(5px);
                    opacity: 0;
                }
                100% {
                    -webkit-transform: translateY(-5px);
                    transform: translateY(-5px);
                    opacity: 1;
                    }
                }
            }
            @keyframes hvsfw-fade-in-bottom {
                0% {
                    -webkit-transform: translateY(5px);
                    transform: translateY(5px);
                    opacity: 0;
                }
                100% {
                    -webkit-transform: translateY(-5px);
                    transform: translateY(-5px);
                    opacity: 1;
                    }
                }
            }
            @-webkit-keyframes hvsfw-fade-out-bottom {
                0% {
                    -webkit-transform: translateY(-5px);
                    transform: translateY(-5px);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateY(5px);
                    transform: translateY(5px);
                    opacity: 0;
                }
            }
            @keyframes hvsfw-fade-out-bottom {
                0% {
                    -webkit-transform: translateY(-5px);
                    transform: translateY(-5px);
                    opacity: 1;
                }
                100% {
                    -webkit-transform: translateY(5px);
                    transform: translateY(5px);
                    opacity: 0;
                }
            }
        ";

        // Global.
        $class .= "
            .hvsfw * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            .hvsfw button {
                cursor: pointer;
                outline: none;
            }
            .hvsfw button > * {
                pointer-events: none;
            }
            .hvsfw-ds-none {
                display: none;
            }
            .hvsfw-ds-block {
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

        // Attribute.
        $class .= '
            .hvsfw-attribute {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }
        ';

        // Term.
        $class .= '
            .hvsfw-term {
                position: relative;
                cursor: pointer;
            }
            .hvsfw-term > * {
                pointer-events: none;
            }
        ';

        // Button.
        $class .= "
            .hvsfw-term[data-type='button'] {
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
            .hvsfw-term[data-type='button'][data-default='yes'] {
                margin-right: {$settings['bn_gap']};
            }
            .hvsfw-term[data-type='button'][data-default='yes'] {
                min-width: {$settings['bn_wd']};
                min-height: {$settings['bn_ht']};
                font-size: {$settings['bn_fs']};
                font-weight: {$settings['bn_fw']};
                color: {$settings['bn_txt_clr']};
                background-color: {$settings['bn_bg_clr']};
                padding: {$this->get_padding( $settings, 'bn' )};
                border: {$this->get_border( $settings, 'bn' )};
            }
            .hvsfw-term[data-type='button'][data-default='yes']:hover,
            .hvsfw-term[data-type='button'][data-default='yes']:focus,
            .hvsfw-term[data-type='button'][data-default='yes'][data-active='yes'] {
                color: {$settings['bn_txt_hv_clr']};
                background-color: {$settings['bn_bg_hv_clr']};
                border-color: {$settings['bn_b_hv_clr']};
            }
            .hvsfw-term[data-type='button'][data-default='yes'][data-shape='square'] {
                border-radius: 0px;
            }
            .hvsfw-term[data-type='button'][data-default='yes'][data-shape='circle'] {
                border-radius: 100%;
            }
            .hvsfw-term[data-type='button'][data-default='yes'][data-shape='custom'] {
                border-radius: {$settings['bn_br']};
            }
        ";

        // Tooltip.
        $class .= "
            .hvsfw-tooltip {
                display: none;
                position: absolute;
                bottom: 100%;
                left: 50%;
                width: max-content;
                margin-bottom: 10px;
                -webkit-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                transform: translateX(-50%);
                z-index: 999999;
            }
            .hvsfw-tooltip[data-visibility='show'],
            .hvsfw-tooltip[data-visibility='hide'] {
                display: block;
                
            }
            .hvsfw-tooltip[data-visibility='show'] .hvsfw-tooltip__box {
                -webkit-animation: hvsfw-fade-in-bottom 0.5s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
                animation: hvsfw-fade-in-bottom 0.5s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
            }
            .hvsfw-tooltip[data-visibility='hide'] .hvsfw-tooltip__box {
                -webkit-animation: hvsfw-fade-out-bottom 0.3s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
                animation: hvsfw-fade-out-bottom 0.3s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            }
            .hvsfw-tooltip[data-type='text'] {
                text-align: center;
            }
            .hvsfw-tooltip[data-type='image'] .hvsfw-tooltip__box {
                min-width: unset;
            }
            .hvsfw-tooltip__box {
                position: relative;
                min-width: {$settings['tl_mn_wd']};
                max-width: {$settings['tl_mx_wd']};
                min-height: {$settings['tl_mn_ht']};
                max-height: {$settings['tl_mx_ht']};
                font-size: {$settings['tl_fs']};
                font-weight: {$settings['tl_fw']};
                line-height: {$settings['tl_ln']};
                color: {$settings['tl_txt_clr']};
                background-color: {$settings['tl_bg_clr']};
                padding: {$this->get_padding( $settings, 'tl' )};
                border-radius: {$settings['tl_br']};
            }
            .hvsfw-tooltip__box::after {
                content: '';
                display: block;
                position: absolute;
                bottom: -7px;
                left: 50%;
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 7px solid {$settings['tl_bg_clr']};
                -webkit-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                transform: translateX(-50%);
            }
            .hvsfw-tooltip__image {
                max-width: {$settings['tl_image_mx_wd']} !important;
                max-height: {$settings['tl_image_mx_ht']} !important;
            }
            .hvsfw-tooltip__image > img {
                display: block !important;
                max-width: 100% !important;
                border-radius: {$settings['tl_image_br']} !important;
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