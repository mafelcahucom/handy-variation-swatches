<?php
use HVSFW\Client\Blocks\VariationFilter\Inc\BlockRender;

/**
 * Render Block Front-end.
 * 
 * @since 1.0.0
 */
echo BlockRender::render([
	'attributes' => $attributes,
	'bloc_wrapper' => get_block_wrapper_attributes()
]);