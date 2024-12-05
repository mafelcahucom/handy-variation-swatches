<?php
/**
 * App > Views > Admin > Component > Message.
 *
 * @since   1.0.0
 *
 * @version 1.0.0
 * @author  Mafel John Cahucom
 * @package handy-variation-swatches
 */

defined( 'ABSPATH' ) || exit;

/**
 * $args = [
 *     'title'   => (string) Contains the title of the message.
 *     'content' => (string) Contains the content of the message.
 *     'button'  => (array)  Contains the buttn [ 'label', 'url' ].
 *     'image'   => (string) Contains the image source url.
 *     'class'   => (string) Contains the additional class.
 * ]
 */

$title   = ( isset( $args['title'] ) ? $args['title'] : '' );
$content = ( isset( $args['content'] ) ? $args['content'] : '' );
$button  = ( isset( $args['button'] ) ? $args['button'] : array() );
$url     = ( isset( $args['url'] ) ? $args['url'] : '' );
$image   = ( isset( $args['image'] ) ? $args['image'] : '' );
$class   = ( isset( $args['class'] ) ? $args['class'] : '' );
?>

<div class="<?php echo esc_attr( $class ); ?>">
    <div class="hd-message">
        <?php if ( ! empty( $image ) ) : ?>
            <figure>
                <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>">
            </figure>
        <?php endif; ?>
        <div>
            <?php if ( ! empty( $title ) ) : ?>
                <p class="hd-fs-16 hd-fw-700">
                    <?php echo esc_html( $title ); ?>
                </p>
            <?php endif; ?>
            <?php if ( ! empty( $content ) ) : ?>
                <p>
                    <?php echo esc_html( $content ); ?>
                </p>
            <?php endif; ?>
            <?php if ( ! empty( $button ) ) : ?>
                <div class="hd-ds-inline-block">
                    <a class="hd-btn hd-btn--white hd-mt-10" href="<?php echo esc_url( $button['url'] ); ?>">
                        <?php echo esc_html( $button['label'] ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
