/**
 * Set the text of an element.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 */
const setText = {

    /**
	 * Set the attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector Contains the selector of the target element.
     * @param {string} text     Contains the text to be inserted in the element.
	 */
    elem( selector, text = '' ) {
        if ( selector ) {
            const elems = document.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.textContent = text;
                } );
            }
        }
    },

    /**
     * Set the text of the children elements.
     * 
     * @since 1.0.0
     * 
     * @param {Object} parent   Contains the parent of the target element. 
     * @param {string} selector Contains the selector of target child element.
     * @param {string} text     Contains the text to be inserted in the element.
     */
    child( parent, selector, text = '' ) {
        if ( parent && selector ) {
            const elems = parent.querySelectorAll( selector );
            if ( elems.length > 0 ) {
                elems.forEach( function( elem ) {
                    elem.textContent = text;
                } );
            }
        }
    }
};

export default setText;