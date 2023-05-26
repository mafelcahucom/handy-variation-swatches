/**
 * Helper Functions.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 * @author Mafel John Cahucom
 */
const data = {

    /**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object The object to be checked.
	 * @return {boolean} Whether has empty key.
	 */
	isObjectEmpty( object ) {
		return object === null || object === undefined || Object.keys( object ).length === 0;
	},

	/**
	 * Returns the validate size unit.
	 * 
	 * @since 1.0.0
	 * @param {string} string The string to be validate. 
	 * @return {string} Validated size.
	 */
	getValidateUnitSize: ( string ) => {
		let size = '0px';
		if ( string !== '' ) {
			const number = string.match(/\d+/g);
			const unit   = string.match(/[a-zA-Z]+/g);

			if ( number !== null ) {
				const validUnits = [
					'cm', 'mm', 'in', 'px', 'pt', 'pc', 'em', 'ex',
					'ch', 'rem', 'vw', 'vh', 'vmin', 'vmax', '%'
				];

				size = number[0];
				if ( unit !== null && validUnits.includes( unit[0] ) ) {
					size = number[0] + unit[0];
				}
			}
		}

		return size;
	},

	/**
	 * Return the capitalize the first character of string.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {string} string Contains the string to be modified.
	 * @return {string} Capitalize first character. 
	 */
	getUcFirst: ( string ) => {
		return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
	},

	/**
	 * Return a single line css padding value.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} padding Contains the top, right, bottom and left value.
	 * @return {string} Single line padding value.
	 */
	getPadding: ( padding ) => {
		if ( data.isObjectEmpty( padding ) ) {
			return '0px 0px 0px 0px';
		}

		const {
			top = ( top !== undefined ? top : '0px' ),
			right = ( right !== undefined ? right : '0px' ),
			bottom = ( bottom !== undefined ? bottom : '0px' ),
			left = ( left !== undefined ? left : '0px' ),
		} = padding;

		return `${ top } ${ right } ${ bottom } ${ left }`;
	},

	/**
	 * Return a single line css border value.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} border Contains the width, style and color value.
	 * @return {string} Single line border value.
	 */
	getBorder: ( border ) => {
		if ( data.isObjectEmpty( border ) ) {
			return '0px none #000000';
		}

		const {
			width = ( width !== undefined ? width : '0px' ),
			style = ( style !== undefined ? style : 'none' ),
			color = ( color !== undefined ? color : '#000000' )
		} = border;

		return `${ width } ${ style } ${ color }`;
	},

	/**
	 * Returns border top, right, bottom, left and its value in single line.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} borders Contains the border top, right, bottom and left.
	 * @return {Object} Contains all borders and its value.
	 */
	getBorders: ( borders ) => {
		if ( data.isObjectEmpty( borders ) ) {
			return { border: '0px none #000000' };
		}

		const value = {};
		if ( Object.keys( borders ).length === 4 ) {
			Object.entries( borders ).forEach( ( border ) => {
				const key = `border${ data.getUcFirst( border[0] ) }`;
				value[ key ] = data.getBorder( border[1] );
			});
		} else {
			value.border = data.getBorder( borders );
		}

		return value;
	},

	/**
	 * Set the border property on an element.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} element Contains the element to be modified. 
	 * @param {Object} borders Contains the border top, right, bottom and left.
	 */
	setBorder: ( element, borders ) => {
		if ( ! element || data.isObjectEmpty( borders ) ) {
			return;
		}

		if ( Object.keys( borders ).length === 4 ) {
			Object.entries( borders ).forEach( ( border ) => {
				element.style[ border[0] ] = border[1];
			});
		} else {
			element.style.border = borders.border;
		}
	},

	/**
	 * Return the linear gradient color or stripe color.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array} colors Containing the list of colors.
	 * @return {string} The gradient background color.
	 */
	getLinearColor( colors ) {
		if ( colors.length === 0 || ! Array.isArray( colors ) ) {
			return '#ffffff';
		}

		let value = '-45deg, ';
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
	},
};

export { data as helper };