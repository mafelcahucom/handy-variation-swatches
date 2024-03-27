<?php
/**
 * Admin Homepage.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;
use HVSFW\Inc\Plugins;

defined( 'ABSPATH' ) || exit; 
?>

<main class="hd-app">
    <div class="hd-home">
        <div class="hd-home__container">
            <div class="hd-home__banner">
                <div class="hd-txt-center">
                    <h1 class="hd-home__title">
                        <?php echo __( 'Handy Tools', HVSFW_PLUGIN_DOMAIN ); ?>
                    </h1>
                    <p class="hd-fs-16">
                        <?php echo __( 'Build an amazing WordPress website faster with our handy tools.', HVSFW_PLUGIN_DOMAIN ); ?>
                    </p>
                </div>
            </div>
            <div class="hd-home__collections">
                <?php foreach ( Plugins::collections() as $plugin ): ?>
                    <div class="hd-home__plugin">
                        <div class="hd-home__plugin__body">
                            <div class="hd-col-left">
                                <div class="hd-home__plugin__icon">
                                    <img src="<?php echo esc_url( Helper::get_asset_src( 'images/' . $plugin['slug'] . '.svg' ) ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" title="<?php echo esc_attr( $plugin['name'] ); ?>">
                                </div>
                            </div>
                            <div class="hd-col-right">
                                <h3 class="hd-home__plugin__name">
                                    <a href="<?php echo esc_url( $plugin['website'] ); ?>" target="_blank">
                                        <?php echo esc_html( $plugin['name'] ); ?>
                                    </a>
                                </h3>
                                <p class="hd-home__plugin__description">
                                    <?php echo esc_html( $plugin['description'] ); ?>
                                </p>
                            </div>
                        </div>
                        <div class="hd-home__plugin__footer">
                            <div class="hd-home__plugin__control">
                                <div class="hd-col-left">
                                    <p class="hd-fw-600">
                                        <?php echo __( 'Status: ', HVSFW_PLUGIN_DOMAIN ); ?>
                                        <span class="hd-clr-black-4">
                                            <?php
                                                if ( Plugins::is_installed( $plugin['slug'] ) ) {
                                                    echo __( 'Installed', HVSFW_PLUGIN_DOMAIN );
                                                } else {
                                                    echo __( 'Not Installed', HVSFW_PLUGIN_DOMAIN );
                                                }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="hd-col-right">
                                    <?php if ( Plugins::is_installed( $plugin['slug'] ) ): ?>
                                        <?php if ( Plugins::is_active( $plugin['slug'] ) ): ?>
                                            <a class="hd-btn" href="<?php echo esc_url( admin_url( 'admin.php?page=' . $plugin['prefix'] ) ); ?>">
                                                <?php echo __( 'Dashboard', HVSFW_PLUGIN_DOMAIN ); ?>
                                            </a>
                                        <?php else: ?>
                                            <a class="hd-btn" href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>">
                                                <?php echo __( 'Activate', HVSFW_PLUGIN_DOMAIN ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a class="hd-btn" href="<?php echo esc_url( $plugin['download'] ); ?>" target="_blank">
                                            <?php echo __( 'Download', HVSFW_PLUGIN_DOMAIN ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="hd-home__developer">
                <p class="hd-fs-16">
                    <?php echo __( 'Handcrafted By ', HVSFW_PLUGIN_DOMAIN ); ?>
                    <a href="#" target="_blank">
                        <?php echo __( 'Mafel John Cahucom', HVSFW_PLUGIN_DOMAIN ); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</main>