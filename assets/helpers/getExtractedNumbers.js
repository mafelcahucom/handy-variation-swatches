/**
 * Return the extracted number from a string.
 *
 * @since 1.0.0
 *
 * @param  {string} string Contains the string to be filter.
 * @return {integer} The extracted numbers from string.
 */
const getExtractedNumbers = function( string ) {
    if ( ! string ) {
        return 0;
    }
    
    const number = parseInt( string.replace( /[^0-9]/g, '' ) );
    return ( isNaN( number ) ? 0 : number );
};

export default getExtractedNumbers;