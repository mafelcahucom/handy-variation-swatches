/**
 * Checks if a data is a valid number.
 *
 * @since 1.0.0
 *
 * @param  {*} data Contains the data to be validated.
 * @return {booean} The flag whether the data is a valid number.
 */
const isNumber = function( data ) {
    return ! isNaN( data );
};

export default isNumber;