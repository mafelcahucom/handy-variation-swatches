/**
 * Set up the text of an element.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const setText = {
	/**
	 * Set the text of the target element(s).
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector Contains the selector of the target element(s).
	 * @param {string} text     Contains the text to be inserted in the element.
	 */
	elem( selector, text ) {
		if ( selector && text ) {
			const elems = document.querySelectorAll( selector );
			if ( 0 < elems.length ) {
				elems.forEach( ( elem ) => {
					elem.textContent = text;
				} );
			}
		}
	},

	/**
	 * Set the text of the target children element(s).
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent   Contains the target parent element.
	 * @param {string} selector Contains the selector of the target child element(s).
	 * @param {string} text     Contains the text to be inserted in the element.
	 */
	child( parent, selector, text ) {
		if ( parent && selector && text ) {
			const elems = parent.querySelectorAll( selector );
			if ( 0 < elems.length ) {
				elems.forEach( ( elem ) => {
					elem.textContent = text;
				} );
			}
		}
	},
};

export default setText;
