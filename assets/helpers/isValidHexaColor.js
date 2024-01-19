/**
 * Checks if the color is a valid hexa color.
 *
 * @since 1.0.0
 *
 * @param  {string} color Contains the color to be validated.
 * @return {booean} The flag whether the color is a valid hexa color.
 */
const isValidHexaColor = function( color ) {
    if ( ! color ) {
        return false;
    }

    return /^#([0-9A-F]{3}){1,2}$/i.test( color );
};

export default isValidHexaColor;