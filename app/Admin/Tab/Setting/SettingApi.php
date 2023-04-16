<?php
namespace HVSFW\Admin\Tab\Setting;

use HVSFW\Inc\Traits\Singleton;
use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Admin > Tab Setting API.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class SettingApi {

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
     * Set of rules for setting fields. This can be use
     * for checking settings fields validity.
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_field_rules() {
        $rules = [

            // gn.
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

            // gn_nc.
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

            // gn_pp.
            'gn_pp_enable'                  => [
                'type'    => 'switch',
                'default' => 1
            ],
            

            // gn_sp.
            'gn_sp_enable'                  => [
                'type'    => 'switch',
                'default' => 1
            ],
            'gn_sp_attribute_limit'         => [
                'type'     => 'number',
                'default'  => 0
            ],

            // gs_pp.
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
                'default'  => 'rgba(0,0,0,1)'
            ],
            'gs_pp_sw_item_gap_row'         => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'gs_pp_sw_item_gap_col'         => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // gs_sp.
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
                'default'  => 'rgba(0,0,0,1)'
            ],
            'gs_sp_sw_item_gap_row'         => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'gs_sp_sw_item_gap_col'         => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // gs_ml.
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

            // bn.
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
                'default'  => 'rgba(0,0,0,1)'
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
                'default'  => 'rgba(0,0,0,1)'
            ],
            'bn_b_hv_clr'                   => [
                'type'     => 'color',
                'default'  => 'rgba(0,113,242,1)'
            ],
            'bn_br'                         => [
                'type'     => 'size',
                'default'  => '0px'
            ],
            'bn_gap_row'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'bn_gap_col'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // cr.
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
                'default'  => 'rgba(0,0,0,1)'
            ],
            'cr_b_hv_clr'                   => [
                'type'     => 'color',
                'default'  => 'rgba(0,113,242,1)'
            ],
            'cr_br'                         => [
                'type'     => 'size',
                'default'  => '0px'
            ],
            'cr_gap_row'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'cr_gap_col'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // im.
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
                'default'  => 'rgba(0,0,0,1)'
            ],
            'im_b_hv_clr'                   => [
                'type'     => 'color',
                'default'  => 'rgba(0,113,242,1)'
            ],
            'im_br'                         => [
                'type'     => 'size',
                'default'  => '0px'
            ],
            'im_gap_row'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],
            'im_gap_col'                    => [
                'type'     => 'size',
                'default'  => '10px'
            ],

            // tl.
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
                'default'  => 'rgba(0,0,0,1)'
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


            // ad_stg.
            'ad_stg_additional_css'         => [
                'type'     => 'textarea',
                'default'  => ''
            ]
        ];

        return $rules;
    }

    /**
     * Returns the default value of each fields based in get_field_rules().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_fields_default_values() {
        $fields = [];
        foreach ( self::get_field_rules() as $key => $value ) {
            $fields[ $key ] = $value['default'];
        }

        return $fields;
    }

    /**
     * Returns the settings value from _hvsfw_main_settings but
     * if _hvsfw_main_settings is empty it will get the default value
     * from self::get_fields_default_values().
     *
     * @since 1.0.0
     * 
     * @return array
     */
    public static function get_settings() {
        $settings = get_option( '_hvsfw_main_settings' );
        if ( empty( $settings ) ) {
            $settings = self::get_fields_default_values();
        }

        return $settings;
    }

    /**
     * Check if the settings has a missing field.
     *
     * @since 1.0.0
     * 
     * @param  array  $settings  Containing all the settings field.
     * @return boolean
     */
    public static function has_missing_fields( $settings ) {
        if ( empty( $settings ) ) {
            return true;
        }

        $field_rules = self::get_field_rules();
        foreach ( $field_rules as $key => $value ) {
            if ( ! array_key_exists( $key, $settings ) ) {
                return true;
            }
        }
        return false;
    }
}