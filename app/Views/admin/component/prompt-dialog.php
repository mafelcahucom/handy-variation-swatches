<?php
/**
 * Views > Admin > Component > Prompt Dialog.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; 
?>

<div id="hd-prompt-dialog" class="hd-pop-up" data-state="default">
    <div class="hd-modal__card hd-modal__card--sm hd-bg-white-1 hd-br-default hd-shadow-2">
        <div class="hd-modal__head hd-p-15 hd-line-bottom">
            <div class="hd-flex hd-flex-jc-sb hd-flex-ai-c hd-gap-10">
                <span id="hd-prompt-dialog-title" class="hd-fs-14 hd-fw-600">
                    <?php echo __( 'Title', HVSFW_PLUGIN_DOMAIN ); ?>
                </span>
                <button id="hd-prompt-dialog-close-btn" class="hd-btn-square" aria-label="<?php echo __( 'Close Prompt', HVSFW_PLUGIN_DOMAIN ); ?>">
                    <?php echo Helper::get_icon( 'close', 'hd-svg' ); ?>
                </button>
            </div>
        </div>
        <div class="hd-modal__body hd-p-15">
            <p id="hd-prompt-dialog-message">
                <?php echo __( 'Message', HVSFW_PLUGIN_DOMAIN ); ?>
            </p>
        </div>
        <div class="hd-modal__footer hd-p-15">
            <div class="hd-flex hd-flex-jc-fe hd-gap-10">
                <button type="button" id="hd-prompt-dialog-no-btn" class="hd-btn hd-btn--default hd-btn--fit">
                    <?php echo __( 'No', HVSFW_PLUGIN_DOMAIN ); ?>
                </button>
                <button type="button" id="hd-prompt-dialog-yes-btn" class="hd-btn hd-btn--fit">
                    <?php echo __( 'Yes', HVSFW_PLUGIN_DOMAIN ); ?>
                </button>
            </div>
        </div>
    </div>
</div>