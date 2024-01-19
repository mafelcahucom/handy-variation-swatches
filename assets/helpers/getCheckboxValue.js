/**
 * Return checkbox values.
 * 
 * @since 1.0.0
 * 
 * @param  {string} selector Contains the target element selector.
 * @return {array}  The value of each checked checkbox.
 */
const getCheckboxValue = function( selector ) {
    let values = [];
    let checkedCheckboxElems = document.querySelectorAll( `${ selector }:checked` );
    if ( checkedCheckboxElems.length > 0 ) {
        checkedCheckboxElems.forEach( function( checkedCheckboxElem ) {
            const value = checkedCheckboxElem.value;
            if ( value.length !== 0 ) {
                values.push( value );
            }
        } );
    }

    return values;
};

export default getCheckboxValue;