<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Installer.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom
 */
final class Installer {

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
     * Plugin Activation.
     *
     * @since 1.0.0
     */
	public static function activate() {
        flush_rewrite_rules();
        self::set_option_main_settings();

        // Set plugin version.
        update_option( '_hvsfw_plugin_version', HVSFW_PLUGIN_VERSION );
    }

    /**
     * Plugin Deactivation.
     *
     * @since 1.0.0
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Sets the default value of option _hvsfw_main_settings.
     *
     * @since 1.0.0
     */
    public static function set_option_main_settings() {
        if ( get_option( '_hvsfw_main_settings' ) ) {
            return;
        }

        $settings = [

            // gn.
            'gn_enable'                     => 1,
            'gn_enable_tooltip'             => 1,
            'gn_disable_item_oos'           => 1,
            'gn_disable_item_style'         => 'blurred-crossed',

            // gn_pp.
            'gn_pp_enable'                  => 1,

            // gn_sp.
            'gn_sp_enable'                  => 1,
            'gn_sp_attribute_limit'         => 0,

            // gn_vf.
            'gn_vf_enable_widget'           => 1,
            'gn_vf_enable_block'            => 1,

            // gn_nc.
            'gn_nc_enable_notice'           => 1,
            'gn_nc_auto_hide'               => 1,
            'gn_nc_duration'                => 5000,
            
            // gs_pp.
            'gs_pp_sw_label_position'       => 'block',
            'gs_pp_sw_label_fs'             => '16px',
            'gs_pp_sw_label_fw'             => '500',
            'gs_pp_sw_label_ln'             => '20px',
            'gs_pp_sw_label_m'              => '5px',
            'gs_pp_sw_label_clr'            => 'rgba(0,0,0,1)',
            'gs_pp_sw_item_gap_row'         => '10px',
            'gs_pp_sw_item_gap_col'         => '10px',

            // gs_sp.
            'gs_sp_sw_alignment'            => 'left',
            'gs_sp_sw_label_position'       => 'block',
            'gs_sp_sw_label_fs'             => '16px',
            'gs_sp_sw_label_fw'             => '500',
            'gs_sp_sw_label_ln'             => '20px',
            'gs_sp_sw_label_m'              => '5px',
            'gs_sp_sw_label_clr'            => 'rgba(0,0,0,1)',
            'gs_sp_sw_item_gap_row'         => '10px',
            'gs_sp_sw_item_gap_col'         => '10px',

            // gs_ml.
            'gs_ml_format'                  => 'label-number',
            'gs_ml_label'                   => 'More',
            'gs_ml_fs'                      => '14px',
            'gs_ml_fw'                      => '500',
            'gs_ml_ln'                      => '21px',
            'gs_ml_txt_clr'                 => 'rgba(0,113,242,1)',
            'gs_ml_txt_hv_clr'              => 'rgba(2,97,205,1)',

            // bn.
            'bn_shape'                      => 'square',
            'bn_wd'                         => '40px',
            'bn_ht'                         => '40px',
            'bn_fs'                         => '14px',
            'bn_fw'                         => '500',
            'bn_txt_clr'                    => 'rgba(0,0,0,1)',
            'bn_txt_hv_clr'                 => 'rgba(0,113,242,1)',
            'bn_bg_clr'                     => 'rgba(255,255,255,1)',
            'bn_bg_hv_clr'                  => 'rgba(255,255,255,1)',
            'bn_pt'                         => '5px',
            'bn_pb'                         => '5px',
            'bn_pl'                         => '5px',
            'bn_pr'                         => '5px',
            'bn_bs'                         => 'solid',
            'bn_bw'                         => '1px',
            'bn_b_clr'                      => 'rgba(0,0,0,1)',
            'bn_b_hv_clr'                   => 'rgba(0,113,242,1)',
            'bn_br'                         => '0px',

            // cr.
            'cr_shape'                      => 'square',
            'cr_size'                       => '40px',
            'cr_wd'                         => '40px',
            'cr_ht'                         => '40px',
            'cr_bs'                         => 'solid',
            'cr_bw'                         => '1px',
            'cr_b_clr'                      => 'rgba(0,0,0,1)',
            'cr_b_hv_clr'                   => 'rgba(0,113,242,1)',
            'cr_br'                         => '0px',

            // im.
            'im_shape'                      => 'square',
            'im_size'                       => '40px',
            'im_wd'                         => '40px',
            'im_ht'                         => '40px',
            'im_bs'                         => 'solid',
            'im_bw'                         => '1px',
            'im_b_clr'                      => 'rgba(0,0,0,1)',
            'im_b_hv_clr'                   => 'rgba(0,113,242,1)',
            'im_br'                         => '0px',

            // tl.
            'tl_mn_wd'                      => '100px',
            'tl_mx_wd'                      => '200px',
            'tl_mn_ht'                      => 'auto',
            'tl_mx_ht'                      => 'auto',
            'tl_fs'                         => '12px',
            'tl_fw'                         => '400',
            'tl_ln'                         => '18px',
            'tl_txt_clr'                    => 'rgba(255,255,255,1)',
            'tl_bg_clr'                     => 'rgba(0,0,0,1)',
            'tl_pt'                         => '8px',
            'tl_pb'                         => '8px',
            'tl_pl'                         => '8px',
            'tl_pr'                         => '8px',
            'tl_br'                         => '4px',
            'tl_image_src_wd'               => 'thumbnail',
            'tl_image_mx_wd'                => '150px',
            'tl_image_mx_ht'                => 'auto',
            'tl_image_br'                   => '4px',

            // ad_add.
            'ad_add_custom_css'             => '',

            // ad_opt.
            'ad_opt_enable_cache'           => 1,
            'ad_opt_enable_minify'          => 1,
            'ad_opt_enable_defer'           => 1,
        ];

        // Insert settings in wp_options table.
        update_option( '_hvsfw_main_settings', $settings );
    }
}