<?php
namespace HVSFW\Client\Blocks\VariationFilter\Inc;

use HVSFW\Client\Blocks\VariationFilter\Inc\BlockHelper;

defined( 'ABSPATH' ) || exit;

/**
 * Block Helper.
 *
 * @since 	1.0.0
 * @version 1.0.0
 * @author Mafel John Cahucom
 */
final class BlockRender {

    /**
     * Holds the block attributes.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    private $attributes = [];

    /**
     * Holds the selected variation attribute.
     * 
     * @since 1.0.0
     *
     * @var array
     */
    private $attribute = [];

    /**
     * Holds the block wrapper.
     *
     * @var string
     */
    private $block_wrapper = '';

    /**
     * Initialize.
     * 
     * @since 1.0.0
     */
	public function __construct( $args = [] ) {
        // Set properties.
        $this->attributes    = $args['attributes'];
        $this->block_wrapper = $args['block_wrapper'];

        BlockHelper::log( $this->attributes['settings']['attribute'] );
        BlockHelper::log( $this->block_wrapper );

        $selected_attribute = $this->attributes['settings']['attribute'];
        if ( $selected_attribute !== 'none' ) {
            // Set the variation attribute property.
            $this->attribute = BlockHelper::get_attribute( $selected_attribute );
            if ( ! empty( $this->attribute ) ) {
                echo $this->render();
            }
        }
    }

    /**
     * Return the block front-end component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private function render() {
        ob_start();
        ?>
        <div <?php echo $this->block_wrapper; ?>>
            <div class="hbvf">
                <?php echo $this->get_title(); ?>
                <?php echo $this->get_list_filter(); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the title component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private function get_title() {
        $title = $this->attributes['title'];
        $style = BlockHelper::css("
            display:       block;
            color:         {$title['color']};
            font-size:     {$title['fontSize']};
            font-weight:   {$title['fontWeight']};
            margin-bottom: {$title['marginBottom']};
        ");

        ob_start();
        ?>
        <?php if ( ! empty( $title['text'] ) ): ?>
            <label class="hbvf-title" style="<?php echo esc_attr( $style ); ?>">
                <?php echo esc_html( $title['text'] ); ?>
            </label>
        <?php endif; ?>
        <?php
        return ob_get_clean();
    }

    /**
     * Return the list filter version component.
     * 
     * @since 1.0.0
     *
     * @return HTMLElement
     */
    private function get_list_filter() {
        ob_start();
        ?>
        <ul class="hbvf-list">
            <?php foreach ( $this->attribute['terms'] as $term ): ?>
                <li class="hbvf-list__li">
                    <a>
                        <?php echo esc_html( $term->name ); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        return ob_get_clean();
    }
}