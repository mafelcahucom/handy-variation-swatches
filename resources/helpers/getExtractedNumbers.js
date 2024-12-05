/**
 * Return the entire extracted numerical character from a string.
 *
 * @since 1.0.0
 *
 * @param {string} string Contains the string source to be filtered.
 * @return {numeric} The extracted numbers from string.
 */
const getExtractedNumbers = ( string ) => {
	if ( ! string ) {
		return 0;
	}

	const number = parseInt( string.replace( /[^0-9]/g, '' ) );
	return isNaN( number ) ? 0 : number;
};

export default getExtractedNumbers;
