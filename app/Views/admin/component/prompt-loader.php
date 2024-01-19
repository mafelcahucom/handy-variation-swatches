<?php
/**
 * Views > Admin > Component > Prompt Loader.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 
?>

<div id="hd-prompt-loader" class="hd-screen-loader hd-pop-up" data-state="default">
    <div class="hd-prompt-loader__panel hd-bg-white-1 hd-br-default hd-p-30 hd-shadow-2">
        <div class="hd-flex hd-flex-jc-c hd-flex-ai-c hd-gap-15">
            <div class="hd-loader hd-loader--black"></div>
            <span id="hd-prompt-loader-title" class="hd-fw-600">
                <?php echo __( 'Please Wait...', HVSFW_PLUGIN_DOMAIN ); ?>
            </span>
        </div>
    </div>
</div>