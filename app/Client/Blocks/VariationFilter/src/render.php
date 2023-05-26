<?php
use HVSFW\Client\Blocks\VariationFilter\Inc\BlockRender;

/**
 * Render Block Dynamically.
 * 
 * @since 1.0.0
 */
new BlockRender([
	'attributes' 	=> $attributes,
	'block_wrapper' => get_block_wrapper_attributes()
]);