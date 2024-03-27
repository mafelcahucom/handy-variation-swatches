<?php
/**
 * Admin Header Template.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\Component;

defined( 'ABSPATH' ) || exit; 
?>

<main class="hd-app">
    
    <!-- header -->
    <div class="hd-header">
        <div class="hd-container">
            <div class="hd-header__col">
            <div class="hd-header__col--left">
                    <div class="hd-flex hd-flex-ai-c hd-flex-jc-sb hd-gap-10">
                        <div class="hd-header__logo">
                            <?php echo Component::get_logo(); ?>
                        </div>
                        <div class="hd-header__title">
                            <span class="hd-fs-18 hd-fw-700">
                                <?php echo __( 'Variation Swatches', HVSFW_PLUGIN_DOMAIN ); ?>
                            </span>
                            <?php echo Helper::render_view( 'component/breadcrumb' ); ?>
                        </div>
                    </div>
                </div>
                <div class="hd-header__col--right">
                    <div class="hd-flex hd-gap-10">
                        <div>
                            <a class="hd-btn-icon hd-btn-icon--circle" href="#" title="<?php echo __( 'Help', HVSFW_PLUGIN_DOMAIN ); ?>">
                                <?php echo Helper::get_icon( 'help', 'hd-svg' ); ?>
                            </a>
                        </div>
                        <div class="hd-ps-relative">
                            <button type="button" id="hd-navigation-btn" class="hd-btn-icon hd-btn-icon--circle" data-state="default" title="<?php echo __( 'Open Navigation', HVSFW_PLUGIN_DOMAIN ); ?>">
                                <?php
                                    echo Helper::get_icon( 'app', 'hd-svg hd-btn-nav__icon--default' );
                                    echo Helper::get_icon( 'close', 'hd-svg hd-btn-nav__icon--active' );
                                ?>
                            </button>
                            <div id="hd-header-navigation" class="hd-header__navigation">
                                <?php
                                    echo Component::get_navigation([
                                        [
                                            'slug'  => 'setting',
                                            'icon'  => 'setting',
                                            'label' => __( 'Setting', HVSFW_PLUGIN_DOMAIN )
                                        ],
                                        [
                                            'slug'  => 'import-export',
                                            'icon'  => 'download',
                                            'label' => __( 'Import & Export', HVSFW_PLUGIN_DOMAIN )
                                        ]
                                    ])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: header -->

    <!-- content -->
    <div class="hd-content">
        <div class="hd-container">