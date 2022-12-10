<?php
/**
 * Admin Header Template
 *
 * @since 1.0.0
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Admin\Inc\Component;

defined( 'ABSPATH' ) || exit; ?>

<div class="hd-dashboard">
    <div class="hd-app">

        <!-- Header -->
        <div class="hd-header">
            <div class="hd-header__component">
                <div class="hd-container">
                    <div class="hd-flex hd-flex-jc-sb">
                        <div class="hd-flex hd-flex-ai-c">
                            <div>
                                <?php echo Component::get_logo(); ?>
                            </div>
                            <div>
                                <?php echo Helper::get_icon( 'chevron-forward-filled', 'hd-separator' ) ?>
                            </div>
                            <div>
                                <span class="hd-fw-600">
                                    <?php echo esc_html( $args['page_title'] ); ?>
                                </span>
                            </div>
                        </div>
                        <div class="hd-flex">
                            <div>
                                <?php
                                    echo Component::get_button([
                                        'type'  => 'circle-link',
                                        'label' => 'Help',
                                        'icon'  => 'help-filled',
                                        'url'   => 'www.facebook.com'
                                    ]);
                                ?>
                            </div>
                            <div class="hd-ps-relative hd-ml-10">
                                <button id="hd-js-toggle-header-navigation-btn" class="hd-header__navigation-btn hd-btn-circle" data-state="default" aria-label="Open Navigation" title="Open Navigation">
                                    <?php echo Helper::get_icon( 'app-filled', 'hd-svg' ); ?>
                                    <?php echo Helper::get_icon( 'close-filled', 'hd-svg' ); ?>
                                </button>
                                <div id="hd-js-header-navigation" class="hd-header__navigation" data-state="default">
                                    <?php
                                        echo Component::get_navigation([
                                            [
                                                'label' => 'Setting',
                                                'slug'  => 'setting',
                                                'icon'  => 'setting-filled'
                                            ],
                                            [
                                                'label' => 'Import & Export',
                                                'slug'  => 'import-export',
                                                'icon'  => 'archive-filled'
                                            ]
                                        ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hd-header__shadow" style="background-image: url('<?php echo esc_url( Helper::get_asset_src( 'images/shadow.png' ) ) ?>');"></div>
        </div>
        <!-- End: Header -->

        <!-- Content -->
        <div class="hd-content">