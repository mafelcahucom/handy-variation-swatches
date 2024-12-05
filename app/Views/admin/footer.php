<?php
/**
 * App > Views > Admin > Footer.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit;
?>

        <!-- end: footer -->
        <div class="hd-footer">
            <p>
                <span>
                    <?php echo __( 'Handcrafted by', 'handy-variation-swatches' ); ?>
                </span>
                <a class="hd-fw-600" href="#" target="_blank">
                    <?php echo __( 'Mafel John Cahucom', 'handy-variation-swatches' ); ?>
                </a>
            </p>
            <div class="hd-sitemap">
                <a href="#" target="_blank">
                    <?php echo __( 'Documentation', 'handy-variation-swatches' ); ?>
                </a>
                <span class="hd-sitemap__separator">/</span>
                <a href="#" target="_blank">
                    <?php echo __( 'Plugins', 'handy-variation-swatches' ); ?>
                </a>
                <span class="hd-sitemap__separator">/</span>
                <a href="#" target="_blank">
                    <?php echo __( 'Developer', 'handy-variation-swatches' ); ?>
                </a>
            </div>
            <ul class="hd-social-media">
                <li>
                    <a href="#" target="_blank">
                        <?php echo Helper::get_icon( 'facebook', 'hd-svg' ); ?>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <?php echo Helper::get_icon( 'github', 'hd-svg' ); ?>
                    </a>
                </li>
                <li>
                    <a href="#" target="_blank">
                        <?php echo Helper::get_icon( 'browser', 'hd-svg' ); ?>
                    </a>
                </li>
            </ul>
        </div>
        <!-- end: footer -->

        </div>
    </div>
</main>
