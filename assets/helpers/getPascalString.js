/**
 * Return the string into Pascal Case format.
 * 
 * @since 1.0.0
 * 
 * @param   {string} separator Contains the string or regular expression to use for splitting.
 * @param   {string} joiner    Contains the string or regular expression to use for joining.
 * @param   {string} string    Contains the string to be formated.
 * @returns {string} The pascal formated string.
 */
const getPascalString = function( separator, joiner, string ) {
    if ( separator.length === 0 || joiner.length === 0 || string.length === 0 ) {
        return '';
    }

    let cleanStr = string.replace( /#/g, '' );
    let splittedStr = cleanStr.toLowerCase().split( separator );
    for ( var i = 0; i < splittedStr.length; i++ ) {
        splittedStr[ i ] = splittedStr[ i ].charAt( 0 ).toUpperCase() + splittedStr[ i ].substring( 1 );     
    }

    return splittedStr.join( joiner ); 
};

export default getPascalString;