import colorPickerModule from './modules/color-picker.js';
import imagePickerModule from './modules/image-picker.js';
import tooltipFieldModule from './modules/tooltip-field.js';

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const hvsfw = hvsfw || {};

/**
 * Helper.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.fn = {

	/**
	 * Global event listener delegation.
	 *
	 * @since 1.0.0
	 *
	 * @param {string}   type     Event type can be multiple seperate with space.
	 * @param {string}   selector Target element.
	 * @param {Function} callback Callback function.
	 */
	async eventListener( type, selector, callback ) {
		const events = type.split( ' ' );
		events.forEach( function( event ) {
			document.addEventListener( event, function( e ) {
				if ( e.target.matches( selector ) ) {
					callback( e );
				}
			} );
		} );
	},

	/**
	 * Sets the attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector  The element selector.
	 * @param {string} attribute The Attribute to be set.
	 * @param {string} value     The value of the attribute.
	 */
	setAttribute( selector, attribute, value ) {
		if ( ! selector || ! attribute ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length === 0 ) {
			return;
		}

		elems.forEach( function( elem ) {
			elem.setAttribute( attribute, value );
		} );
	},

	/**
	 * Sets the value of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector The element selector.
	 * @param {mixed}  value    The value of the element.
	 */
	setValue( selector, value ) {
		if ( ! selector ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length === 0 ) {
			return;
		}

		elems.forEach( function( elem ) {
			elem.value = value;
		} );
	},

	/**
	 * Return wp list table first row.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement} The first child th.
	 */
	getListTableFirstRow() {
		const selector = '#the-list > tr:first-child > th:first-child';
		return document.querySelector( selector );
	},

	/**
	 * Return the linear gradient color or stripe color.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array}  colors Containing the list of colors.
	 * @param {string} angle  The total angle or rotation of the background.
	 * @return {string} The gradient background color.
	 */
	getLinearColor( colors, angle = '-45deg' ) {
		if ( colors.length === 0 || ! Array.isArray( colors ) ) {
			return '#ffffff';
		}

		let value = `${ angle }, `;
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

	/**
	 * Checks if the color is a valid hexa color.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} color The color to be check.
	 * @return {boolean} Validity of the color.
	 */
	isValidHexColor( color ) {
		if ( ! color ) {
			return false;
		}

		return /^#([0-9A-F]{3}){1,2}$/i.test( color );
	},
};

/**
 * Holds the swatch setting form.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.swatch = {

	/**
	 * Set to default or reset color swatch picker.
	 *
	 * @since 1.0.0
	 */
	setColorToDefault() {
		const colorPickerElem = document.getElementById( 'hvsfw-color-picker-swatch' );
		if ( colorPickerElem ) {
			colorPickerModule.setToDefault( colorPickerElem );
		}
	},

	/**
	 * Set to default or reset image swatch picker.
	 *
	 * @since 1.0.0
	 */
	setImageToDefault() {
		const imagePickerElem = document.getElementById( 'hvsfw-image-picker-swatch' );
		if ( imagePickerElem ) {
			imagePickerModule.setToDefault( imagePickerElem );
		}
	},

	/**
	 * Render color previewer in wp list table.
	 *
	 * @since 1.0.0
	 */
	renderColorPreviewer() {
		const colorInputElems = document.querySelectorAll( 'input[name="hvsfw_color_swatch[]"]' );
		if ( colorInputElems.length === 0 ) {
			return;
		}

		const colors = Array.from( colorInputElems ).map( function( colorInputElem ) {
			const color = colorInputElem.value;
			return ( hvsfw.fn.isValidHexColor( color ) ? color : '#ffffff' );
		} );

		if ( colors.length === 0 ) {
			return;
		}

		const element = document.createElement( 'td' );
		element.className = 'hvsfw_color column-hvsfw_color';
		element.setAttribute( 'data-colname', 'Color' );
		element.innerHTML = `
			<div class="hvsfw-preview hvsfw-preview__color" style="background: ${ hvsfw.fn.getLinearColor( colors ) }"></div>
		`;

		const tableFirstRowElem = hvsfw.fn.getListTableFirstRow();
		if ( tableFirstRowElem ) {
			tableFirstRowElem.after( element );
		}
	},

	/**
	 * Render image previewer in wp list table.
	 *
	 * @since 1.0.0
	 */
	renderImagePreviewer() {
		const imagePickerElem = document.getElementById( 'hvsfw-image-picker-swatch' );
		if ( ! imagePickerElem ) {
			return;
		}

		const imageElem = imagePickerElem.querySelector( '.hvsfw-image-picker__img' );
		if ( ! imageElem ) {
			return;
		}

		const imageSource = imageElem.getAttribute( 'src' );
		const imageTitle = imageElem.getAttribute( 'title' );
		const imageAlt = imageElem.getAttribute( 'alt' );
		if ( ! imageSource ) {
			return;
		}

		const imagePreviewElem = `
			<div class="hvsfw-preview hvsfw-preview__image">
    			<img class="hvsfw-preview__image__img" src="${ imageSource }" alt="${ imageAlt }" title="${ imageTitle }">
			</div>
		`;

		const element = document.createElement( 'td' );
		element.className = 'hvsfw_image column-hvsfw_image';
		element.setAttribute( 'data-colname', 'Image' );
		element.innerHTML = imagePreviewElem;

		const tableFirstRowElem = hvsfw.fn.getListTableFirstRow();
		if ( tableFirstRowElem ) {
			tableFirstRowElem.after( element );
		}
	},
};

/**
 * Holds the wp list table .
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.wpListTable = {

	/**
	 * Holds the wp list table element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	tableElem: null,

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		if ( ! this.constructor() ) {
			return;
		}

		this.reposition();
		this.screenResize();
	},

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	constructor() {
		// Set all element property.
		if ( ! this.setElementProperties() ) {
			return false;
		}

		return true;
	},

	/**
	 * Set all element property values.
	 *
	 * @since 1.0.0
	 *
	 * @return {boolean} Check if all property element has a value.
	 */
	setElementProperties() {
		// Set tableElem property.
		const tableElem = document.getElementById( 'the-list' );
		if ( ! tableElem ) {
			return false;
		}

		hvsfw.wpListTable.tableElem = tableElem;

		return true;
	},

	/**
	 * Return the column type and element.
	 *
	 * @since 1.0.0
	 *
	 * @return {Object} Contains the type and element of the column.
	 */
	getColumnData() {
		const tableElem = hvsfw.wpListTable.tableElem;
		const colorColumnElems = tableElem.querySelectorAll( '.column-hvsfw_color' );
		const imageColumnElems = tableElem.querySelectorAll( '.column-hvsfw_image' );
		if ( colorColumnElems.length === 0 && imageColumnElems.length === 0 ) {
			return {};
		}

		const data = {};
		if ( colorColumnElems.length > 0 ) {
			data.type = 'color';
			data.columns = colorColumnElems;
		}

		if ( imageColumnElems.length > 0 ) {
			data.type = 'image';
			data.columns = imageColumnElems;
		}

		return data;
	},

	/**
	 * Reposition the swatch type preview.
	 *
	 * @since 1.0.0
	 */
	reposition() {
		const data = this.getColumnData();
		if ( ! ( 'type' in data ) ) {
			return;
		}

		const windowWidth = window.innerWidth;
		data.columns.forEach( function( column ) {
			const parentElem = column.closest( 'tr.level-0' );
			const firstTdElem = parentElem.querySelector( 'th:first-child' );
			const lastTdElem = parentElem.querySelector( 'td:last-child' );
			if ( parentElem && firstTdElem && lastTdElem ) {
				if ( windowWidth <= 782 ) {
					if ( ! lastTdElem.classList.contains( `hvsfw_${ data.type }` ) ) {
						lastTdElem.after( column );
					}
				}

				if ( windowWidth >= 783 ) {
					if ( firstTdElem ) {
						const nextTdElem = firstTdElem.nextElementSibling;
						if ( ! nextTdElem.classList.contains( `hvsfw_${ data.type }` ) ) {
							firstTdElem.after( column );
						}
					}
				}
			}
		} );
	},

	/**
	 * Screen resize event.
	 *
	 * @since 1.0.0
	 */
	screenResize() {
		window.addEventListener( 'resize', function() {
			hvsfw.wpListTable.reposition();
		} );
	},
};

/**
 * Holds the ajax event catcher.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.ajax = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onSuccess();
	},

	/**
	 * Catch ajax on success events.
	 *
	 * @since 1.0.0
	 */
	onSuccess() {
		jQuery( document ).ajaxSuccess( function( event, request, options ) {
			const params = options.data.split( '&' );
			const keys = {};
			params.forEach( function( param ) {
				param = param.split( '=' );
				keys[ param[ 0 ] ] = param[ 1 ];
			} );

			// Reset and render previewer for color and image.
			if ( keys.action === 'add-tag' ) {
				hvsfw.swatch.renderColorPreviewer();
				hvsfw.swatch.setColorToDefault();

				hvsfw.swatch.renderImagePreviewer();
				hvsfw.swatch.setImageToDefault();

				hvsfw.tooltip.setToDefault( 'reset' );

				hvsfw.wpListTable.reposition();
			}
		} );
	},
};

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
hvsfw.domReady = {

	/**
	 * Execute the code when dom is ready.
	 *
	 * @param {Function} func callback
	 * @return {Function} The callback function.
	 */
	execute( func ) {
		if ( typeof func !== 'function' ) {
			return;
		}
		if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

hvsfw.domReady.execute( function() {
	colorPickerModule.init(); // Handle the color picker field events.
	imagePickerModule.init(); // Handle the image picker field events.
	tooltipFieldModule.init(); // Handle the tooltip field events.
	hvsfw.wpListTable.init(); // Handle the wp list table events.
	hvsfw.ajax.init(); // Handle the ajax events catcher.
} );
