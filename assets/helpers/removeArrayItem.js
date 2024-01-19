/**
 * Remove a specific item in an array.
 *
 * @since 1.0.0
 *
 * @param  {Array} array Contains the array to be filtered.
 * @param  {Array} item  Contains the item to be removed in the array.
 * @return {Array} The filtered array.
 */
const removeArrayItem = function( array, item ) {
    return array.filter( function( value ) {
        return value !== item;
    } );
};

export default removeArrayItem;