/**
 * Set element attribute.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const setAttribute = {

	/**
	 * Set the attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector  Contains the target element selector.
	 * @param {string} attribute Contains the attribute to be set.
	 * @param {string} value     Contains the value of the attribute
	 */
	elem( selector, attribute, value ) {
		if ( selector && attribute ) {
			const elems = document.querySelectorAll( selector );
			if ( elems.length > 0 ) {
				elems.forEach( function( elem ) {
					elem.setAttribute( attribute, value );
				} );
			}
		}
	},

	/**
	 * Set the children attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent    Contains the parent of the target element.
	 * @param {string} selector  Contains the selector of target child element.
	 * @param {string} attribute Contains the Attribute to be set.
	 * @param {string} value     Contains the value of the attribute.
	 */
	child( parent, selector, attribute, value ) {
		if ( parent && selector && attribute ) {
			const elems = parent.querySelectorAll( selector );
			if ( elems.length > 0 ) {
				elems.forEach( function( elem ) {
					elem.setAttribute( attribute, value );
				} );
			}
		}
	},
};

export default setAttribute;