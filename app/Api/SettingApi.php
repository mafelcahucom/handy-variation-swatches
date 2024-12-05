<?php
/**
 * App > Api > Setting API.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

namespace HVSFW\Api;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * The `SettingApi` class contains the all available
 * APIs for setting.
 *
 * @since 1.0.0
 */
final class SettingApi {

	/**
	 * Inherit Singleton.
     *
     * @since 1.0.0
	 */
	use Singleton;

    /**
     * Protected class constructor to prevent direct object creation.
     *
     * @since 1.0.0
     */
    protected function __construct() {}

    /**
     * Return the set of setting fields with each schema or rules. There
     * are 3 types of format to return the raw, schemas and fields.
     *
     * @since 1.0.0
     *
     * @param  string $type Contains the format of data to be returned.
     * @return array
     */
    public static function get_settings( $type = 'raw' ) {
        $settings = array(
            'GEN' => array(
                'gn_enable'                     => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_enable_tooltip'             => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_disable_item_oos'           => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_disable_item_style'         => array(
                    'type'     => 'select',
                    'default'  => 'blurred-crossed',
                    'choices'  => array( 'hidden', 'blurred', 'crossed-out', 'blurred-crossed' ),
                ),
                'gn_pp_enable'                  => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_sp_enable'                  => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_sp_attribute_limit'         => array(
                    'type'     => 'number',
                    'default'  => 0,
                ),
                'gn_vf_enable_widget'           => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_vf_enable_block'            => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_nc_enable_notice'           => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_nc_auto_hide'               => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'gn_nc_duration'                => array(
                    'type'    => 'number',
                    'default' => 5000,
                ),
            ),
            'GST' => array(
                'gs_pp_sw_label_position'       => array(
                    'type'     => 'select',
                    'default'  => 'block',
                    'choices'  => array( 'hidden', 'inline', 'block' ),
                ),
                'gs_pp_sw_label_fs'             => array(
                    'type'     => 'size',
                    'default'  => '16px',
                ),
                'gs_pp_sw_label_fw'             => array(
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' ),
                ),
                'gs_pp_sw_label_ln'             => array(
                    'type'     => 'size',
                    'default'  => '20px',
                ),
                'gs_pp_sw_label_m'              => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'gs_pp_sw_label_clr'            => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'gs_pp_sw_item_gap_row'         => array(
                    'type'     => 'size',
                    'default'  => '10px',
                ),
                'gs_pp_sw_item_gap_col'         => array(
                    'type'     => 'size',
                    'default'  => '10px',
                ),
                'gs_sp_sw_alignment'            => array(
                    'type'     => 'select',
                    'default'  => 'left',
                    'choices'  => array( 'left', 'center', 'right' ),
                ),
                'gs_sp_sw_label_position'       => array(
                    'type'     => 'select',
                    'default'  => 'block',
                    'choices'  => array( 'hidden', 'inline', 'block' ),
                ),
                'gs_sp_sw_label_fs'             => array(
                    'type'     => 'size',
                    'default'  => '16px',
                ),
                'gs_sp_sw_label_fw'             => array(
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' ),
                ),
                'gs_sp_sw_label_ln'             => array(
                    'type'     => 'size',
                    'default'  => '20px',
                ),
                'gs_sp_sw_label_m'              => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'gs_sp_sw_label_clr'            => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'gs_sp_sw_item_gap_row'         => array(
                    'type'     => 'size',
                    'default'  => '10px',
                ),
                'gs_sp_sw_item_gap_col'         => array(
                    'type'     => 'size',
                    'default'  => '10px',
                ),
                'gs_ml_format'                  => array(
                    'type'     => 'select',
                    'default'  => 'label-number',
                    'choices'  => array( 'label', 'number', 'label-number' ),
                ),
                'gs_ml_label'                   => array(
                    'type'     => 'text',
                    'default'  => 'More',
                    'max'      => 50,
                ),
                'gs_ml_fs'                      => array(
                    'type'     => 'size',
                    'default'  => '14px',
                ),
                'gs_ml_fw'                      => array(
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' ),
                ),
                'gs_ml_ln'                      => array(
                    'type'     => 'size',
                    'default'  => '21px',
                ),
                'gs_ml_txt_clr'                 => array(
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)',
                ),
                'gs_ml_txt_hv_clr'              => array(
                    'type'     => 'color',
                    'default'  => 'rgba(2,97,205,1)',
                ),
            ),
            'BTS' => array(
                'bn_shape'                      => array(
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => array( 'square', 'circle', 'custom' ),
                ),
                'bn_wd'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'bn_ht'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'bn_fs'                         => array(
                    'type'     => 'size',
                    'default'  => '14px',
                ),
                'bn_fw'                         => array(
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' ),
                ),
                'bn_txt_clr'                    => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'bn_txt_hv_clr'                 => array(
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)',
                ),
                'bn_bg_clr'                     => array(
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)',
                ),
                'bn_bg_hv_clr'                  => array(
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)',
                ),
                'bn_pt'                         => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'bn_pb'                         => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'bn_pl'                         => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'bn_pr'                         => array(
                    'type'     => 'size',
                    'default'  => '5px',
                ),
                'bn_bs'                        => array(
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' ),
                ),
                'bn_bw'                         => array(
                    'type'     => 'size',
                    'default'  => '1px',
                ),
                'bn_b_clr'                      => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'bn_b_hv_clr'                   => array(
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)',
                ),
                'bn_br'                         => array(
                    'type'     => 'size',
                    'default'  => '0px',
                ),
            ),
            'CRS' => array(
                'cr_shape'                      => array(
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => array( 'square', 'circle', 'custom' ),
                ),
                'cr_size'                       => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'cr_wd'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'cr_ht'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'cr_bs'                         => array(
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' ),
                ),
                'cr_bw'                         => array(
                    'type'     => 'size',
                    'default'  => '1px',
                ),
                'cr_b_clr'                      => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'cr_b_hv_clr'                   => array(
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)',
                ),
                'cr_br'                         => array(
                    'type'     => 'size',
                    'default'  => '0px',
                ),
            ),
            'IMS' => array(
                'im_shape'                      => array(
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => array( 'square', 'circle', 'custom' ),
                ),
                'im_size'                       => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'im_wd'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'im_ht'                         => array(
                    'type'     => 'size',
                    'default'  => '40px',
                ),
                'im_bs'                         => array(
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' ),
                ),
                'im_bw'                         => array(
                    'type'     => 'size',
                    'default'  => '1px',
                ),
                'im_b_clr'                      => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'im_b_hv_clr'                   => array(
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)',
                ),
                'im_br'                         => array(
                    'type'     => 'size',
                    'default'  => '0px',
                ),
            ),
            'TOT' => array(
                'tl_mn_wd'                      => array(
                    'type'     => 'size',
                    'default'  => '100px',
                ),
                'tl_mx_wd'                      => array(
                    'type'     => 'size',
                    'default'  => '200px',
                ),
                'tl_mn_ht'                      => array(
                    'type'     => 'size',
                    'default'  => 'auto',
                ),
                'tl_mx_ht'                      => array(
                    'type'     => 'size',
                    'default'  => 'auto',
                ),
                'tl_fs'                         => array(
                    'type'     => 'size',
                    'default'  => '12px',
                ),
                'tl_fw'                         => array(
                    'type'     => 'select',
                    'default'  => '400',
                    'choices'  => Helper::get_font_weight_choices( 'value' ),
                ),
                'tl_ln'                         => array(
                    'type'     => 'size',
                    'default'  => '18px',
                ),
                'tl_txt_clr'                    => array(
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)',
                ),
                'tl_bg_clr'                     => array(
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)',
                ),
                'tl_pt'                         => array(
                    'type'     => 'size',
                    'default'  => '8px',
                ),
                'tl_pb'                         => array(
                    'type'     => 'size',
                    'default'  => '8px',
                ),
                'tl_pl'                         => array(
                    'type'     => 'size',
                    'default'  => '8px',
                ),
                'tl_pr'                         => array(
                    'type'     => 'size',
                    'default'  => '8px',
                ),
                'tl_br'                         => array(
                    'type'     => 'size',
                    'default'  => '4px',
                ),
                'tl_image_src_wd'               => array(
                    'type'     => 'select',
                    'default'  => 'thumbnail',
                    'choices'  => array_column( Helper::get_image_sizes(), 'value' ),
                ),
                'tl_image_mx_wd'                => array(
                    'type'     => 'size',
                    'default'  => '150px',
                ),
                'tl_image_mx_ht'                => array(
                    'type'     => 'size',
                    'default'  => 'auto',
                ),
                'tl_image_br'                   => array(
                    'type'     => 'size',
                    'default'  => '4px',
                ),
            ),
            'ADV' => array(
                'ad_add_custom_css'             => array(
                    'type'     => 'textarea',
                    'default'  => '',
                ),
                'ad_opt_enable_cache'           => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'ad_opt_enable_minify'          => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
                'ad_opt_enable_defer'           => array(
                    'type'    => 'switch',
                    'default' => 1,
                ),
            ),
        );

        $output = $settings;
        if ( in_array( $type, array( 'schemas', 'fields' ), true ) ) {
            $schemas = array();
            foreach ( $settings as $setting ) {
                $schemas = array_merge( $schemas, $setting );
            }

            $output = $schemas;

            if ( $type === 'fields' ) {
                $fields = array();
                foreach ( $schemas as $key => $schema ) {
                    $fields[ $key ] = $schema['default'];
                }

                $output = $fields;
            }
        }

        return $output;
    }

    /**
     * Return the settings from option _hvsfw_main_settings but if option is
     * empty it will be get the default settings values.
     *
     * @since 1.0.0
     *
     * @return array
     */
    public static function get_current_settings() {
        $settings = get_option( '_hvsfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = self::get_settings( 'fields' );
        }

        return $settings;
    }
}
