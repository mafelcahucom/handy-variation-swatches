/**
 * Checks if a certain animation is done.
 *
 * @since 1.0.0
 *
 * @param  {Object} element Contains the target element where animation is executing.
 * @return {booean} The flag whether the anition is done.
 */
const isAnimationDone = function( element ) {
    return new Promise( function( resolve, reject ) {
        if ( ! element ) {
            resolve( false );
        }

        element.addEventListener( 'animationend', function() {
            resolve( true );
        } );
    } );
};

export default isAnimationDone;