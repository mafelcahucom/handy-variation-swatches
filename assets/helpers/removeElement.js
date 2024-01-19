/**
 * Remove an element.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const removeElement = {

	/**
	 * Remove the target element.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector Contains the target element selector.
	 */
	elem( selector ) {
        if ( selector ) {
            const elems = document.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.remove();
                } );
            }
        }
	},

	/**
	 * Remove a child element from a parent element.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent   Contains the parent of the target element.
	 * @param {string} selector Contains the selector of target child element.
	 */
	child( parent, selector ) {
        if ( parent && selector ) {
            const elems = parent.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.remove();
                } );
            }
        }
	},
};

export default removeElement;