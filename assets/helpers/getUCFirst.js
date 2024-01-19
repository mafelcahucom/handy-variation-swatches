/**
 * Return the string with capitalize letter in a word.
 * 
 * @since 1.0.0
 * 
 * @param  {string} string Contains the string to be capitalize.
 * @return {string} The string with capitalize letter.
 */
const getUCFirst = function( string = '' ) {
    return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
};

export default getUCFirst;