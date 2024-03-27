<?php
namespace HVSFW\Api;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Setting API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
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
     * @param  string  $type  Contains the format of data to be returned.
     * @return array
     */
    public static function get_settings( $type = 'raw' ) {
        $settings = [
            'GEN' => [
                'gn_enable'                     => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_enable_tooltip'             => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_disable_item_oos'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_disable_item_style'         => [
                    'type'     => 'select',
                    'default'  => 'blurred-crossed',
                    'choices'  => [ 'hidden', 'blurred', 'crossed-out', 'blurred-crossed' ]
                ],
                'gn_pp_enable'                  => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_sp_enable'                  => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_sp_attribute_limit'         => [
                    'type'     => 'number',
                    'default'  => 0
                ],
                'gn_vf_enable_widget'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_vf_enable_block'            => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_nc_enable_notice'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_nc_auto_hide'               => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'gn_nc_duration'                => [
                    'type'    => 'number',
                    'default' => 5000
                ],
            ],
            'GST' => [
                'gs_pp_sw_label_position'       => [
                    'type'     => 'select',
                    'default'  => 'block',
                    'choices'  => [ 'hidden', 'inline', 'block' ]
                ],
                'gs_pp_sw_label_fs'             => [
                    'type'     => 'size',
                    'default'  => '16px'
                ],
                'gs_pp_sw_label_fw'             => [
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' )
                ],
                'gs_pp_sw_label_ln'             => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'gs_pp_sw_label_m'              => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'gs_pp_sw_label_clr'            => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'gs_pp_sw_item_gap_row'         => [
                    'type'     => 'size',
                    'default'  => '10px'
                ],
                'gs_pp_sw_item_gap_col'         => [
                    'type'     => 'size',
                    'default'  => '10px'
                ],
                'gs_sp_sw_alignment'            => [
                    'type'     => 'select',
                    'default'  => 'left',
                    'choices'  => [ 'left', 'center', 'right' ]
                ],
                'gs_sp_sw_label_position'       => [
                    'type'     => 'select',
                    'default'  => 'block',
                    'choices'  => [ 'hidden', 'inline', 'block' ]
                ],
                'gs_sp_sw_label_fs'             => [
                    'type'     => 'size',
                    'default'  => '16px'
                ],
                'gs_sp_sw_label_fw'             => [
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' )
                ],
                'gs_sp_sw_label_ln'             => [
                    'type'     => 'size',
                    'default'  => '20px'
                ],
                'gs_sp_sw_label_m'              => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'gs_sp_sw_label_clr'            => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'gs_sp_sw_item_gap_row'         => [
                    'type'     => 'size',
                    'default'  => '10px'
                ],
                'gs_sp_sw_item_gap_col'         => [
                    'type'     => 'size',
                    'default'  => '10px'
                ],
                'gs_ml_format'                  => [
                    'type'     => 'select',
                    'default'  => 'label-number',
                    'choices'  => [ 'label', 'number', 'label-number' ]
                ],
                'gs_ml_label'                   => [
                    'type'     => 'text',
                    'default'  => 'More',
                    'max'      => 50
                ],
                'gs_ml_fs'                      => [
                    'type'     => 'size',
                    'default'  => '14px'
                ],
                'gs_ml_fw'                      => [
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' )
                ],
                'gs_ml_ln'                      => [
                    'type'     => 'size',
                    'default'  => '21px'
                ],
                'gs_ml_txt_clr'                 => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)'
                ],
                'gs_ml_txt_hv_clr'              => [
                    'type'     => 'color',
                    'default'  => 'rgba(2,97,205,1)'
                ],
            ],
            'BTS' => [
                'bn_shape'                      => [
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => [ 'square', 'circle', 'custom' ]
                ],
                'bn_wd'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'bn_ht'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'bn_fs'                         => [
                    'type'     => 'size',
                    'default'  => '14px'
                ],
                'bn_fw'                         => [
                    'type'     => 'select',
                    'default'  => '500',
                    'choices'  => Helper::get_font_weight_choices( 'value' )
                ],
                'bn_txt_clr'                    => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'bn_txt_hv_clr'                 => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)'
                ],
                'bn_bg_clr'                     => [
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)'
                ],
                'bn_bg_hv_clr'                  => [
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)'
                ],
                'bn_pt'                         => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'bn_pb'                         => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'bn_pl'                         => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'bn_pr'                         => [
                    'type'     => 'size',
                    'default'  => '5px'
                ],
                'bn_bs'                        => [
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' )
                ],
                'bn_bw'                         => [
                    'type'     => 'size',
                    'default'  => '1px'
                ],
                'bn_b_clr'                      => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'bn_b_hv_clr'                   => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)'
                ],
                'bn_br'                         => [
                    'type'     => 'size',
                    'default'  => '0px'
                ],
            ],
            'CRS' => [
                'cr_shape'                      => [
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => [ 'square', 'circle', 'custom' ]
                ],
                'cr_size'                       => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'cr_wd'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'cr_ht'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'cr_bs'                         => [
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' )
                ],
                'cr_bw'                         => [
                    'type'     => 'size',
                    'default'  => '1px'
                ],
                'cr_b_clr'                      => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'cr_b_hv_clr'                   => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)'
                ],
                'cr_br'                         => [
                    'type'     => 'size',
                    'default'  => '0px'
                ],
            ],
            'IMS' => [
                'im_shape'                      => [
                    'type'     => 'select',
                    'default'  => 'square',
                    'choices'  => [ 'square', 'circle', 'custom' ]
                ],
                'im_size'                       => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'im_wd'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'im_ht'                         => [
                    'type'     => 'size',
                    'default'  => '40px'
                ],
                'im_bs'                         => [
                    'type'     => 'select',
                    'default'  => 'solid',
                    'choices'  => Helper::get_border_style_choices( 'value' )
                ],
                'im_bw'                         => [
                    'type'     => 'size',
                    'default'  => '1px'
                ],
                'im_b_clr'                      => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'im_b_hv_clr'                   => [
                    'type'     => 'color',
                    'default'  => 'rgba(0,113,242,1)'
                ],
                'im_br'                         => [
                    'type'     => 'size',
                    'default'  => '0px'
                ],
            ],
            'TOT' => [
                'tl_mn_wd'                      => [
                    'type'     => 'size',
                    'default'  => '100px'
                ],
                'tl_mx_wd'                      => [
                    'type'     => 'size',
                    'default'  => '200px'
                ],
                'tl_mn_ht'                      => [
                    'type'     => 'size',
                    'default'  => 'auto'
                ],
                'tl_mx_ht'                      => [
                    'type'     => 'size',
                    'default'  => 'auto'
                ],
                'tl_fs'                         => [
                    'type'     => 'size',
                    'default'  => '12px'
                ],
                'tl_fw'                         => [
                    'type'     => 'select',
                    'default'  => '400',
                    'choices'  => Helper::get_font_weight_choices( 'value' )
                ],
                'tl_ln'                         => [
                    'type'     => 'size',
                    'default'  => '18px'
                ],
                'tl_txt_clr'                    => [
                    'type'     => 'color',
                    'default'  => 'rgba(255,255,255,1)'
                ],
                'tl_bg_clr'                     => [
                    'type'     => 'color',
                    'default'  => 'rgba(17,14,39,1)'
                ],
                'tl_pt'                         => [
                    'type'     => 'size',
                    'default'  => '8px'
                ],
                'tl_pb'                         => [
                    'type'     => 'size',
                    'default'  => '8px'
                ],
                'tl_pl'                         => [
                    'type'     => 'size',
                    'default'  => '8px'
                ],
                'tl_pr'                         => [
                    'type'     => 'size',
                    'default'  => '8px'
                ],
                'tl_br'                         => [
                    'type'     => 'size',
                    'default'  => '4px'
                ],
                'tl_image_src_wd'               => [
                    'type'     => 'select',
                    'default'  => 'thumbnail',
                    'choices'  => array_column( Helper::get_image_sizes(), 'value' )
                ],
                'tl_image_mx_wd'                => [
                    'type'     => 'size',
                    'default'  => '150px'
                ],
                'tl_image_mx_ht'                => [
                    'type'     => 'size',
                    'default'  => 'auto'
                ],
                'tl_image_br'                   => [
                    'type'     => 'size',
                    'default'  => '4px'
                ],
            ],
            'ADV' => [
                'ad_add_custom_css'             => [
                    'type'     => 'textarea',
                    'default'  => ''
                ],
                'ad_opt_enable_cache'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'ad_opt_enable_minify'          => [
                    'type'    => 'switch',
                    'default' => 1
                ],
                'ad_opt_enable_defer'           => [
                    'type'    => 'switch',
                    'default' => 1
                ],
            ]
        ];

        $output = $settings;
        if ( in_array( $type, [ 'schemas', 'fields' ] ) ) {
            $schemas = [];
            foreach ( $settings as $setting ) {
                $schemas = array_merge( $schemas, $setting );
            }

            $output = $schemas;

            if ( $type === 'fields' ) {
                $fields = [];
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