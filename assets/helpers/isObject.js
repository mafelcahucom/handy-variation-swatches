/**
 * Object data type checker.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const isObject = {

	/**
	 * Sort out the object based on the keys.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  {Object} object Contains the object to be sorted.
	 * @return {Object} The sorted object.
	 */
	sortOut( object ) {
		return Object.keys( object ).sort().reduce( function( result, key ) {
			result[ key ] = object[ key ];
			return result;
		}, {} );
	},

	/**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param  {Object} object Contains the object object to be checked.
	 * @return {boolean} The flag whether a certain key is empty.
	 */
	empty( object ) {
		return Object.keys( object ).length === 0;
	},

	/**
	 * Checks if the object has a missing key, if has found
	 * a missing key return true.
	 *
	 * @since 1.0.0
	 *
	 * @param  {Array}  keys   Contains the list of keys use as referrence.
	 * @param  {Object} object Contains the object to be checked.
	 * @return {boolean} The flag whether the object has a missing key.
	 */
	hasMissingKey( keys, object ) {
		if ( keys.length === 0 || this.empty( object ) ) {
			return;
		}

		let hasMissing = false;
		keys.forEach( function( key ) {
			if ( ! object.hasOwnProperty( key ) ) {
				hasMissing = true;
			}
		} );

		return hasMissing;
	},

	/**
	 * Checks if the two objects has the same keys and values.
	 *
	 * @since 1.0.0
	 *
	 * @param  {Object} object1 Contains the first object.
	 * @param  {Object} object2 Contains the second object.
	 * @return {boolean} The flag whether the two objects are equal.
	 */
	equal( object1, object2 ) {
		const obj1 = this.sortOut( object1 );
		const obj2 = this.sortOut( object2 );

		return JSON.stringify( obj1 ) === JSON.stringify( obj2 );
	}
};

export default isObject;