/**
 * Return the checkbox value.
 *
 * @since 1.0.0
 *
 * @param {string} selector Contains the target element selector.
 * @return {array} The value of each checked checkbox.
 */
const getCheckboxValue = ( selector ) => {
	const values = [];
	const checkedCheckboxElems = document.querySelectorAll( `${ selector }:checked` );
	if ( 0 < checkedCheckboxElems.length ) {
		checkedCheckboxElems.forEach( ( checkedCheckboxElem ) => {
			const value = checkedCheckboxElem.value;
			if ( 0 !== value.length ) {
				values.push( value );
			}
		} );
	}

	return values;
};

export default getCheckboxValue;
