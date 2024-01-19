<?php
/**
 * Views > Admin > Component > Error Notice.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 

?>

<div class="hd-app">
    <div class="hd-container">
        <div class="hd-error-notice">
            <figure class="hd-error-notice__image">
                <img src="<?php echo Helper::get_asset_src( 'images/error-illustration.svg' ); ?>" title="<?php echo __( 'Error Illustration', HVSFW_PLUGIN_DOMAIN ); ?>" alt="<?php echo __( 'Error Illustration', HVSFW_PLUGIN_DOMAIN ); ?>">
            </figure>
            <div class="hd-error-notice__content">
                <p class="hd-fs-16 hd-fw-600 hd-mb-10">
                    <?php echo __( 'Oops! Service Unavailable', HVSFW_PLUGIN_DOMAIN ); ?>
                </p>
                <p class="hd-fs-14">
                    <?php echo __( 'The plugin has found an error due to deleting or modifying the wp_options table in the database that caused deleting the options fields that are required in running this plugin. In order to fix this problem, you just need to deactivate and activate the plugin again.', HVSFW_PLUGIN_DOMAIN ); ?>
                </p>
            </div>
            <div class="hd-error-notice__actions">
                <a class="hd-btn" href="<?php echo esc_url( admin_url( 'plugins.php' ) ); ?>">
                    <?php echo __( 'Deactivate Now', HVSFW_PLUGIN_DOMAIN ); ?>
                </a>
            </div>
        </div>
    </div>
</div>