<?php
/**
 * Views > Admin > Component > Prompt Dialog.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HVSFW\Admin\Inc\Helper;

defined( 'ABSPATH' ) || exit; ?>

<div id="hd-js-prompt-dialog" class="hd-pop-up" data-state="default">
    <div class="hd-modal__card hd-modal__card--sm hd-bg-clr-white hd-br-default hd-shadow-2">
        <div class="hd-modal__head hd-p-15 hd-line-bottom">
            <div class="hd-flex hd-flex-jc-sb hd-flex-ai-c">
                <div>
                    <span id="hd-js-prompt-dialog-title" class="hd-fs-14 hd-fw-600">Title</span>
                </div>
                <div class="hd-ml-10">
                    <button id="hd-js-prompt-dialog-close-btn" class="hd-btn-circle" aria-label="Close Prompt">
                        <?php echo Helper::get_icon( 'close-filled', 'hd-svg' ); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="hd-modal__body hd-p-15">
            <p id="hd-js-prompt-dialog-message">Message</p>
        </div>
        <div class="hd-modal__footer hd-p-15">
            <div class="hd-flex hd-flex-jc-fe">
                <div>
                    <button type="button" id="hd-js-prompt-dialog-no-btn" class="hd-btn hd-btn--default hd-btn--fit">No</button>
                </div>
                <div class="hd-ml-10">
                    <button type="button" id="hd-js-prompt-dialog-yes-btn" class="hd-btn hd-btn--fit">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>