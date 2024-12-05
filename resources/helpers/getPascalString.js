/**
 * Return the converted Pascal case format string from a provided string.
 *
 * @since 1.0.0
 *
 * @param {string} separator Contains the regular expression to use for splitting.
 * @param {string} joiner    Contains the regular expression to use for joining.
 * @param {string} string    Contains the string to be formated to pascal case.
 * @return {string} The converted Pascal case format string.
 */
const getPascalString = ( separator, joiner, string ) => {
	if ( 0 === separator.length || 0 === joiner.length || 0 === string.length ) {
		return '';
	}

	const cleanStr = string.replace( /#/g, '' );
	const splittedStr = cleanStr.toLowerCase().split( separator );
	for ( let i = 0; i < splittedStr.length; i++ ) {
		splittedStr[ i ] =
			splittedStr[ i ].charAt( 0 ).toUpperCase() + splittedStr[ i ].substring( 1 );
	}

	return splittedStr.join( joiner );
};

export default getPascalString;
