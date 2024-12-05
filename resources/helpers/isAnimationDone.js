/**
 * Determines whether a certain animation that is executing on a certain element is done.
 *
 * @since 1.0.0
 *
 * @param {Object} element Contains the target element where animation is executing.
 * @type  {boolean} The flag whether the animation is done.
 */
const isAnimationDone = ( element ) => {
	return new Promise( ( resolve ) => {
		if ( ! element ) {
			resolve( false );
		}

		element.addEventListener( 'animationend', () => {
			resolve( true );
		} );
	} );
};

export default isAnimationDone;
