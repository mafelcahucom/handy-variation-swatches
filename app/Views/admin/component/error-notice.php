<?php
/**
 * App > Views > Admin > Component > Error Notice.
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

<div class="hd-app">
    <div class="hd-container">
        <div class="hd-error-notice">
            <figure class="hd-error-notice__image">
                <img src="<?php echo Helper::get_resource_src( 'images/error-illustration.svg' ); ?>" title="<?php echo __( 'Error Illustration', 'handy-variation-swatches' ); ?>" alt="<?php echo __( 'Error Illustration', 'handy-variation-swatches' ); ?>">
            </figure>
            <div class="hd-error-notice__content">
                <p class="hd-fs-16 hd-fw-600 hd-mb-10">
                    <?php echo __( 'Oops! Service Unavailable', 'handy-variation-swatches' ); ?>
                </p>
                <p class="hd-fs-14">
                    <?php echo __( 'The plugin has found an error due to deleting or modifying the wp_options table in the database that caused deleting the options fields that are required in running this plugin. In order to fix this problem, you just need to deactivate and activate the plugin again.', 'handy-variation-swatches' ); ?>
                </p>
            </div>
            <div class="hd-error-notice__actions">
                <a class="hd-btn" href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>">
                    <?php echo __( 'Deactivate Now', 'handy-variation-swatches' ); ?>
                </a>
            </div>
        </div>
    </div>
</div>
