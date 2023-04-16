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

        // Select.
        $class .= "
            .hvsfw-select {
                display: none;
            }
        ";

        // Attribute.
        $class .= "
            .hvsfw-attribute {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
            }
        ";

        // Term.
        $class .= "
            .hvsfw-term {
                position: relative;
                cursor: pointer;
            }
            .hvsfw-term > * {
                pointer-events: none;
            }
            .hvsfw-term:last-child {
                margin-right: 0 !important;
            }
            .hvsfw-term[data-shape='square'] {
                border-radius: 0px;
            }
            .hvsfw-term[data-shape='circle'] {
                border-radius: 100%;
            }
            
        ";

        // Term Disable Style.
        if ( ! empty( $settings['gn_disable_item_style'] ) ) {
            $disable_item_style   = $settings['gn_disable_item_style'];
            $is_crossed           = in_array( $disable_item_style, [ 'crossed-out', 'blurred-crossed' ] );
            $is_blurred           = in_array( $disable_item_style, [ 'blurred', 'blurred-crossed' ] );
            $disable_item_opacity = ( $is_blurred ? 0.7 : 1 );

            $class .= "
                .hvsfw-term[data-enable='no'] {
                    cursor: not-allowed;
                    opacity: {$disable_item_opacity};
                    overflow: hidden;
                }
            ";

            if ( $disable_item_style === 'hidden' ) {
                $class .= "
                    .hvsfw-term[data-enable='no'] {
                        display: none !important;
                    }
                ";
            }

            if ( $is_crossed ) {
                $class .= "
                    .hvsfw-term[data-enable='no']:before,
                    .hvsfw-term[data-enable='no']:after {
                        content: '';
                        position: absolute;
                        top: 50%;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        width: 100%;
                        height: 1px;
                        background-color: #cb3b3b;
                        opacity: 1;
                        
                    }
                    .hvsfw-term[data-enable='no']:before {
                        -webkit-transform: rotate(45deg);
                        -ms-transform: rotate(45deg);
                        transform: rotate(45deg);
                    }
                    .hvsfw-term[data-enable='no']:after {
                        -webkit-transform: rotate(-45deg);
                        -ms-transform: rotate(-45deg);
                        transform: rotate(-45deg);
                    }
                ";
            }
        }

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
                line-height: 1.2em;
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
            .hvsfw-term[data-type='button'][data-default='yes'][data-shape='custom'] {
                border-radius: {$settings['bn_br']};
            }
        ";

        // Color.
        $class .= "
            .hvsfw-term[data-type='color'] {
                padding: 3px;
            }
            .hvsfw-term[data-type='color'] .hvsfw-color {
                width: 100%;
                height: 100%;
                border: 1px solid #e1e1e1;
                border-radius: inherit;
            }
            .hvsfw-term[data-type='color'][data-default='yes'] {
                width: {$settings['cr_size']};
                height: {$settings['cr_size']};
                border: {$this->get_border( $settings, 'cr' )};
            }
            .hvsfw-term[data-type='color'][data-default='yes'][data-shape='custom'] {
                width: {$settings['cr_wd']};
                height: {$settings['cr_ht']};
                border-radius: {$settings['cr_br']};
            }
        ";

        // Image.
        $class .= "
            .hvsfw-term[data-type='image'] {
                padding: 3px;
            }
            .hvsfw-term[data-type='image'] .hvsfw-image {
                width: 100%;
                height: 100%;
                background-size: cover;
                border-radius: inherit;
            }
            .hvsfw-term[data-type='image'][data-default='yes'] {
                width: {$settings['im_size']};
                height: {$settings['im_size']};
                border: {$this->get_border( $settings, 'im' )};
            }
            .hvsfw-term[data-type='image'][data-default='yes'][data-shape='custom'] {
                width: {$settings['im_wd']};
                height: {$settings['im_ht']};
                border-radius: {$settings['im_br']};
            }
        ";

        // Product Page.
        if ( $settings['gn_pp_enable'] ) {
            $class .= "
                form.variations_form .hvsfw-attribute {
                    grid-row-gap: {$settings['gs_pp_sw_item_gap_row']};
                    grid-column-gap: {$settings['gs_pp_sw_item_gap_col']};
                }
                form.variations_form table.variations tr {
                    display: block;
                    margin-bottom: 15px;
                }
                form.variations_form table.variations tr:last-child {
                    margin-bottom: 0px;
                }
            ";

            if ( $settings['gs_pp_sw_label_position'] === 'hidden' ) {
                $class .= "
                    form.variations_form table.variations th.label {
                        display: none !important;
                    }
                ";
            }

            if ( $settings['gs_pp_sw_label_position'] !== 'hidden' ) {
                $class .= "
                    form.variations_form table.variations {
                        width: 100%;
                    }
                    form.variations_form table.variations th.label {
                        text-align: left !important;
                    }
                    form.variations_form table.variations th.label > label {
                        font-size: {$settings['gs_pp_sw_label_fs']} !important;
                        font-weight: {$settings['gs_pp_sw_label_fw']} !important;
                        line-height: {$settings['gs_pp_sw_label_ln']} !important;
                        color: {$settings['gs_pp_sw_label_clr']} !important;
                    }
                ";
                
                if ( $settings['gs_pp_sw_label_position'] === 'inline' ) {
                    $class .= "
                        form.variations_form table.variations tr {
                            display: table-row;
                            margin-bottom: 0px;
                        }
                        form.variations_form table.variations tr > td {
                            padding-bottom: 15px;
                        }
                        form.variations_form table.variations tr:last-child > td {
                            padding-bottom: 0px;
                        }
                        form.variations_form table.variations th.label {
                            display: table-cell;
                            margin-bottom: 0px;
                            padding-right: {$settings['gs_pp_sw_label_m']};
                        }
                        form.variations_form table.variations td.value {
                            display: table-cell;
                        }
                    ";
                }

                if ( $settings['gs_pp_sw_label_position'] === 'block' ) {
                    $class .= "
                        form.variations_form table.variations tr {
                            display: block;
                        }
                        form.variations_form table.variations th.label {
                            display: block;
                            line-height: 0px !important;
                            margin-bottom: {$settings['gs_pp_sw_label_m']};
                        }
                    ";
                }
            }
        }

        // Shop Page.
        if ( $settings['gn_sp_enable'] ) {
            $class .= "
                .hvsfw-variations-form .hvsfw-attribute {
                    grid-row-gap: {$settings['gs_sp_sw_item_gap_row']};
                    grid-column-gap: {$settings['gs_sp_sw_item_gap_col']};
                }
                .hvsfw-variations-form table.variations tr {
                    display: block;
                    margin-bottom: 10px;
                }
                .hvsfw-variations-form table.variations tr:last-child {
                    margin-bottom: 0px;
                }
                .hvsfw-variations-reset {
                    display: block;
                    margin-top: 10px;
                }
            ";

            if ( $settings['gs_sp_sw_label_position'] !== 'hidden' ) {
                $class .= "
                    .hvsfw-variations-form table.variations {
                        width: 100%;
                    }
                    .hvsfw-variations-form table.variations th.label {
                        text-align: left !important;
                    }
                    .hvsfw-variations-form table.variations th.label > label {
                        font-size: {$settings['gs_sp_sw_label_fs']} !important;
                        font-weight: {$settings['gs_sp_sw_label_fw']} !important;
                        line-height: {$settings['gs_sp_sw_label_ln']} !important;
                        color: {$settings['gs_sp_sw_label_clr']} !important;
                    }
                ";

                if ( $settings['gs_sp_sw_label_position'] === 'inline' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations tr {
                            display: table-row;
                            margin-bottom: 0px;
                        }
                        .hvsfw-variations-form table.variations tr > td {
                            padding-bottom: 10px;
                        }
                        .hvsfw-variations-form table.variations tr:last-child > td {
                            padding-bottom: 0px;
                        }
                        .hvsfw-variations-form table.variations th.label {
                            display: table-cell;
                            margin-bottom: 0px;
                            padding-right: {$settings['gs_sp_sw_label_m']};
                        }
                        .hvsfw-variations-form table.variations td.value {
                            display: table-cell;
                        }
                    ";
                }

                if ( $settings['gs_sp_sw_label_position'] === 'block' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations tr {
                            display: block;
                        }
                        .hvsfw-variations-form table.variations th.label {
                            display: block;
                            line-height: 0px !important;
                            margin-bottom: {$settings['gs_sp_sw_label_m']};
                        }
                    ";
                }
            }

            if ( $settings['gs_sp_sw_alignment'] === 'center' ) {
                $class .= "
                    .hvsfw-variations-form {
                        display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-box-pack: center;
                        -ms-flex-pack: center;
                        justify-content: center;
                    }
                    .hvsfw-variations-form table.variations {
                        width: auto;
                    }
                ";

                if ( $settings['gs_sp_sw_label_position'] === 'hidden' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations tr {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                        }
                        .hvsfw-variations-reset {
                            text-align: center;
                        }
                    ";
                }

                if ( $settings['gs_sp_sw_label_position'] === 'block' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations th.label {
                            text-align: center !important;
                        }
                        .hvsfw-variations-form table.variations td.value {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-align: center;
                            -ms-flex-align: center;
                            align-items: center;
                            -webkit-box-pack: center;
                            -ms-flex-pack: center;
                            justify-content: center;
                            -webkit-box-orient: vertical;
                            -webkit-box-direction: normal;
                            -ms-flex-direction: column;
                            flex-direction: column;
                        }
                    ";
                }
            }

            if ( $settings['gs_sp_sw_alignment'] === 'right' ) {
                $class .= "
                    .hvsfw-variations-form {
                        display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-box-pack: right;
                        -ms-flex-pack: right;
                        justify-content: right;
                    }
                    .hvsfw-variations-form table.variations {
                        width: auto;
                    }
                ";

                if ( $settings['gs_sp_sw_label_position'] === 'hidden' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations tr {
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-pack: right;
                            -ms-flex-pack: right;
                            justify-content: right;
                        }
                        .hvsfw-variations-reset {
                            text-align: right;
                        }
                    ";
                }

                if ( $settings['gs_sp_sw_label_position'] === 'block' ) {
                    $class .= "
                        .hvsfw-variations-form table.variations th.label {
                            text-align: right !important;
                        }
                        .hvsfw-variations-form table.variations td.value {
                            width: 100%;
                            display: -webkit-box;
                            display: -ms-flexbox;
                            display: flex;
                            -webkit-box-align: end;
                            -ms-flex-align: end;
                            align-items: end;
                            -webkit-box-pack: end;
                            -ms-flex-pack: end;
                            justify-content: end;
                            -webkit-box-orient: vertical;
                            -webkit-box-direction: normal;
                            -ms-flex-direction: column;
                            flex-direction: column;
                        }
                    ";
                }
            }

            if ( $settings['gn_sp_attribute_limit'] > 0 ) {
                $class .= "
                    .hvsfw-more-link {
                        font-size: {$settings['gs_ml_fs']};
                        font-weight: {$settings['gs_ml_fw']};
                        line-height: {$settings['gs_ml_ln']};
                        color: {$settings['gs_ml_txt_clr']};
                        text-decoration: none;
                    }
                    .hvsfw-more-link:hover,
                    .hvsfw-more-link:focus {
                        color: {$settings['gs_ml_txt_hv_clr']};
                    }
                ";
            }
        }

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

        // Add To Cart Button.
        $class .= "
            .hvsfw-js-loop-add-to-cart-btn.loading {
                cursor: wait !important;
            }
            .hvsfw-js-loop-add-to-cart-btn.added {
                cursor: not-allowed !important;
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