/**
 * Internal Dependencies.
 */
import { getLinearColor, isValidHexaColor } from '../../helpers';

/**
 * Internal Modules.
 */
import colorPickerModule from './modules/colorPicker.js';
import imagePickerModule from './modules/imagePicker.js';
import tooltipFieldModule from './modules/tooltipField.js';

/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
( 'use strict' ); // eslint-disable-line no-unused-expressions

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hvsfw = hvsfw || {};

/**
 * Holds the color picker events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.colorPicker = colorPickerModule;

/**
 * Holds the image picker events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.imagePicker = imagePickerModule;

/**
 * Holds the tooltip field events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.tooltipField = tooltipFieldModule;

/**
 * Helper.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.helper = {
	/**
	 * Return wp list table first row.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement} The first child <th>.
	 */
	getListTableFirstRow() {
		const selector = '#the-list > tr:first-child > th:first-child';
		return document.querySelector( selector );
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
		if ( 0 < colorInputElems.length ) {
			const colors = Array.from( colorInputElems ).map( ( colorInputElem ) => {
				const color = colorInputElem.value;
				return isValidHexaColor( color ) ? color : '#ffffff';
			} );

			if ( 0 < colors.length ) {
				const element = document.createElement( 'td' );
				element.className = 'hvsfw_color column-hvsfw_color';
				element.setAttribute( 'data-colname', 'Color' );
				element.innerHTML = `<div class="hvsfw-preview hvsfw-preview__color" style="background: ${ getLinearColor(
					colors
				) }"></div>`;

				const tableFirstRowElem = hvsfw.helper.getListTableFirstRow();
				if ( tableFirstRowElem ) {
					tableFirstRowElem.after( element );
				}
			}
		}
	},

	/**
	 * Render image previewer in wp list table.
	 *
	 * @since 1.0.0
	 */
	renderImagePreviewer() {
		const imagePickerElem = document.getElementById( 'hvsfw-image-picker-swatch' );
		if ( imagePickerElem ) {
			const imageElem = imagePickerElem.querySelector( '.hvsfw-image-picker__img' );
			if ( imageElem ) {
				const imageSource = imageElem.getAttribute( 'src' );
				const imageTitle = imageElem.getAttribute( 'title' );
				const imageAlt = imageElem.getAttribute( 'alt' );
				if ( imageSource ) {
					const imagePreviewElem = `
						<div class="hvsfw-preview hvsfw-preview__image">
							<img class="hvsfw-preview__image__img" src="${ imageSource }" alt="${ imageAlt }" title="${ imageTitle }">
						</div>
					`;

					const element = document.createElement( 'td' );
					element.className = 'hvsfw_image column-hvsfw_image';
					element.setAttribute( 'data-colname', 'Image' );
					element.innerHTML = imagePreviewElem;

					const tableFirstRowElem = hvsfw.helper.getListTableFirstRow();
					if ( tableFirstRowElem ) {
						tableFirstRowElem.after( element );
					}
				}
			}
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
	 *
	 * @return {boolean} The flag whether the element properties has been set.
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
		if ( 0 === colorColumnElems.length && 0 === imageColumnElems.length ) {
			return {};
		}

		const data = {};
		if ( 0 < colorColumnElems.length ) {
			data.type = 'color';
			data.columns = colorColumnElems;
		}

		if ( 0 < imageColumnElems.length ) {
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
		data.columns.forEach( ( column ) => {
			const parentElem = column.closest( 'tr.level-0' );
			const firstTdElem = parentElem.querySelector( 'th:first-child' );
			const lastTdElem = parentElem.querySelector( 'td:last-child' );
			if ( parentElem && firstTdElem && lastTdElem ) {
				if ( 782 >= windowWidth ) {
					if ( ! lastTdElem.classList.contains( `hvsfw_${ data.type }` ) ) {
						lastTdElem.after( column );
					}
				}

				if ( 783 <= windowWidth ) {
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
		window.addEventListener( 'resize', () => {
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
		jQuery( document ).ajaxSuccess( ( event, request, options ) => {
			const params = options.data.split( '&' );
			const keys = {};
			params.forEach( ( param ) => {
				param = param.split( '=' );
				keys[ param[ 0 ] ] = param[ 1 ];
			} );

			// Reset and render previewer for color and image.
			if ( 'add-tag' === keys.action ) {
				hvsfw.swatch.renderColorPreviewer();
				hvsfw.swatch.setColorToDefault();

				hvsfw.swatch.renderImagePreviewer();
				hvsfw.swatch.setImageToDefault();

				hvsfw.wpListTable.reposition();

				tooltipFieldModule.setToDefault( 'reset', 'hvsfw-tooltip-add' );
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
	 * @param {Function} func Contains the callback function.
	 * @return {Function|void} The callback function.
	 */
	execute( func ) {
		if ( 'function' !== typeof func ) {
			return;
		}

		if ( 'interactive' === document.readyState || 'complete' === document.readyState ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute( () => {
	Object.entries( hvsfw ).forEach( ( fragment ) => {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );
