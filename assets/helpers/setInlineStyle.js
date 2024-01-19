/**
 * Set or implement the inline style on a certain element 
 * based on the given styles.
 *
 * @since 1.0.0
 * 
 * @param {Object} element Contains the target element.
 * @param {Array}  styles  Contains the style attribute and value.
 */
const setInlineStyle = function( element, styles ) {
    if ( element && styles ) {
        Object.entries( styles ).forEach( function( style ) {
			element.style[ style[ 0 ] ] = style[ 1 ];
		} );
    }
};

export default setInlineStyle;