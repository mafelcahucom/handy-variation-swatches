<?php
namespace HVSFW\Inc;

use HVSFW\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Installer.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class Installer {

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

            // gn_pp.
            'gn_pp_enable'                  => 1,

            // gn_sp.
            'gn_sp_enable'                  => 1,

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
            'bn_gap'                        => '10px',

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
            'cr_gap'                        => '10px',

            // im.
            'im_image_size'                 => 'thumbnail',
            'im_shape'                      => 'square',
            'im_size'                       => '40px',
            'im_wd'                         => '40px',
            'im_ht'                         => '40px',
            'im_bs'                         => 'solid',
            'im_bw'                         => '1px',
            'im_b_clr'                      => 'rgba(0,0,0,1)',
            'im_b_hv_clr'                   => 'rgba(0,113,242,1)',
            'im_br'                         => '0px',
            'im_gap'                        => '10px',

            // tl.
            'tl_mn_wd'                      => '100px',
            'tl_mx_wd'                      => '200px',
            'tl_mn_ht'                      => 'auto',
            'tl_mx_ht'                      => 'auto',
            'tl_fs'                         => '14px',
            'tl_fw'                         => '500',
            'tl_ln'                         => '21px',
            'tl_txt_clr'                    => 'rgba(255,255,255,1)',
            'tl_bg_clr'                     => 'rgba(0,0,0,0.8)',
            'tl_pt'                         => '5px',
            'tl_pb'                         => '5px',
            'tl_pl'                         => '5px',
            'tl_pr'                         => '5px',
            'tl_bs'                         => 'none',
            'tl_bw'                         => '0px',
            'tl_b_clr'                      => 'rgba(0,0,0,0)',
            'tl_br'                         => '0px',
            'tl_image_src_wd'               => 'thumbnail',
            'tl_image_mx_wd'                => '150px',
            'tl_image_mx_ht'                => 'auto',
            'tl_image_br'                   => '0px',

            // ad_stg.
            'ad_stg_additional_css'         => ''
        ];

        // Insert settings in wp_options table.
        update_option( '_hvsfw_main_settings', $settings );
    }
}