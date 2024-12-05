/**
 * Removing an element(s) based on the provided selector.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const removeElement = {
	/**
	 * Remove the target element(s).
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector Contains the target element selector.
	 */
	elem( selector ) {
		if ( selector ) {
			const elems = document.querySelectorAll( selector );
			if ( 0 < elems.length ) {
				elems.forEach( ( elem ) => {
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
	 * @param {Object} parent   Contains the target parent element.
	 * @param {string} selector Contains the selector of the target child element(s).
	 */
	child( parent, selector ) {
		if ( parent && selector ) {
			const elems = parent.querySelectorAll( selector );
			if ( 0 < elems.length ) {
				elems.forEach( ( elem ) => {
					elem.remove();
				} );
			}
		}
	},
};

export default removeElement;
