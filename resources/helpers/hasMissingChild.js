/**
 * Check whether a parent element has a missing children elements.
 * 
 * @since 1.0.0
 * 
 * @param  {Object} parent   Contains the parent element.
 * @param  {Array}  children Contains the selectors of the children element.
 * @return {boolean} The flag whether the parent element has a missing child.
 */
const hasMissingChild = ( parent, children ) => {
    if ( ! parent || ! children ) {
        return true;
    }

    let output = false;
    children.forEach( ( child ) => {
        const elems = parent.querySelectorAll( child );
        if ( elems.length === 0 ) {
            output = true;
        }
    } );

    return output;
};

export default hasMissingChild;