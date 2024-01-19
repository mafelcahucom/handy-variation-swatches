/**
 * Return the linear gradient color or stripe color.
 * 
 * @since 1.0.0
 * 
 * @param  {Array}  colors Contains the list of colors to rendered in background color.
 * @param  {string} degree Contains the total degree or angle of the background color.
 * @return {string} The css gradient background color property.
 */
const getLinearColor = function( colors, degree = '-45deg' ) {
    if ( colors.length === 0 || ! Array.isArray( colors ) ) {
        return '#ffffff';
    }

    let value = `${ degree }, `;
    const count = colors.length;
    const length = ( 100 / count );

    colors.forEach( function( color, index ) {
        index = ( index + 1 );
        const end = ( length * index );
        const start = ( end - length );

        value += `${ color } ${ start }%, ${ color } ${ end }% `;
        value += ( index < count ? ',' : '' );
    } );

    return `repeating-linear-gradient( ${ value } )`;
};

export default getLinearColor;