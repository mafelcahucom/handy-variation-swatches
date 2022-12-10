<?php
/**
 * Views > Admin > Component > Card.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

defined( 'ABSPATH' ) || exit; 

/**
 * $args = [
 *     'part'         => (string) The part of card to be return |opening|closing.
 *     'title'        => (string) The title of the card.
 *     'class'        => (string) Additional class.
 * ]
 **/

$part        = ( isset( $args['part'] ) ? $args['part'] : '' );
$title       = ( isset( $args['title'] ) ? $args['title'] : '' );
$class       = ( isset( $args['class'] ) ? $args['class'] : '' );
$button_icon = ( isset( $args['button_icon'] ) ? $args['button_icon'] : '' );
?>

<?php if ( $part === 'opening' ): ?>
    <div class="hd-accordion hd-card <?php echo esc_attr( $class ); ?>">
        <div class="hd-accordion__header">
            <div class="hd-flex hd-flex-jc-sb hd-flex-ai-c">
                <div>
                    <?php if ( ! empty( $title ) ): ?>
                        <span class="hd-title">
                            <?php echo esc_html( $title ); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="hd-ml-10">
                    <button class="hd-js-toggle-accordion-btn hd-btn-circle" data-state="open" aria-label="toggle">
                        <?php echo $button_icon; ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="hd-accordion__body" data-state="open">
            <div class="hd-accordion__content">
<?php endif; ?>

<?php if ( $part === 'closing' ): ?>
            </div>
        </div>
        <div class="hd-card__overlay"></div>
    </div>
<?php endif; ?>