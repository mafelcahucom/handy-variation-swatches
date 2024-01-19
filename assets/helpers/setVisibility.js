/**
 * Internal Dependencies.
 */
import setAttribute from "./setAttribute";

/**
 * Set the element's attribute data-visible.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const setVisibility = {

	/**
	 * Set the attribute data-visible of an element.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector   Contains the target element selector.
	 * @param {string} visibility Contains the visibility value yes|no.
	 */
	elem( selector, visibility ) {
        if ( selector && visibility ) {
            setAttribute.elem( selector, 'data-visible', visibility );
        }
	},

	/**
	 * Set the children attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent     Contains the parent of the target element.
	 * @param {string} selector   Contains the selector of target child element.
	 * @param {string} visibility Contains the visibility value yes|no.
	 */
	child( parent, selector, visibility ) {
        if ( parent && selector && visibility ) {
			setAttribute.child( parent, selector, 'data-visible', visibility );
		}
	},
};

export default setVisibility;