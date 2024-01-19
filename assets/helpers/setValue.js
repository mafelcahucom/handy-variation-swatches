/**
 * Set the element's value.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const setValue = {

	/**
	 * Set the value of an element.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector Contains the target element selector.
	 * @param {mixed}  value    Contains the value of the element.
	 */
	elem( selector, value ) {
        if ( selector ) {
            const elems = document.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.value = value;
                } );
            }
        }
	},

	/**
	 * Set the children value of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent   Contains the parent of the target element.
	 * @param {string} selector Contains the selector of target child element.
	 * @param {mixed}  value    Contains the value of the element.
	 */
	child( parent, selector, value ) {
        if ( parent && selector ) {
			const elems = parent.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.value = value;
                } );
            }
		}
	},
};

export default setValue;