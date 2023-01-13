import colorPickerModule from './modules/color-picker.js';
import imagePickerModule from './modules/image-picker.js';
import settingFieldModule from './modules/setting-field.js';
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
	 * Fetch handler.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params Containing the parameters.
	 * @return {Object} Fetch response
	 */
	async fetch( params ) {
		let result = {
			success: false,
			data: {
				error: 'NETWORK_ERROR',
			},
		};

		if ( this.isObjectEmpty( params ) ) {
			result.data.error = 'MISSING_DATA_ERROR';
			return result;
		}

		try {
			const response = await fetch( hvsfwLocal.url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams( params ),
			} );

			if ( response.ok ) {
				result = await response.json();
				console.log( result );
			}
		} catch ( e ) {
			console.log( 'error', e );
		}

		return result;
	},

	/**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object The object to be checked.
	 * @return {boolean} Whether has empty key.
	 */
	isObjectEmpty( object ) {
		return Object.keys( object ).length === 0;
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
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.setAttribute( attribute, value );
			} );
		}
	},

	/**
	 * Sets the children attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent    The parent element.
	 * @param {string} selector  The element selector.
	 * @param {string} attribute The Attribute to be set.
	 * @param {string} value     The value of the attribute.
	 */
	setChildAttribute( parent, selector, attribute, value ) {
		if ( ! parent || ! selector || ! attribute ) {
			return;
		}

		const elems = parent.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.setAttribute( attribute, value );
			} );
		}
	},

	/**
	 * Sets the elements visibility.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector   The element selector.
	 * @param {string} visibility The visibility of the element.
	 */
	setVisibility( selector, visibility ) {
		if ( selector && visibility ) {
			this.setAttribute( selector, 'data-visible', visibility );
		}
	},

	/**
	 * Sets the children elements visibilty.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent     The parent element.
	 * @param {string} selector   The child element selector.
	 * @param {string} visibility The visibility of the child element.
	 */
	setChildVisibilty( parent, selector, visibility ) {
		if ( parent && selector && visibility ) {
			this.setChildAttribute( parent, selector, 'data-visible', visibility );
		}
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
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.value = value;
			} );
		}
	},

	/**
	 * Sets the children value of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent   The parent element.
	 * @param {string} selector The element selector.
	 * @param {mixed}  value    The value of the element.
	 */
	setChildValue( parent, selector, value ) {
		if ( ! parent || ! selector ) {
			return;
		}

		const elems = parent.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.value = value;
			} );
		}
	},

	/**
	 * Sets the text content of target elements.
	 *
	 * @since 1.0.0
	 * 
	 * @param {string} selector The element selector.
	 * @param {string} text     The text to be inserted in the element.
	 */
	setText( selector, text = '' ) {
		if ( ! selector ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.textContent = text;
			} );
		}
	},

	/**
	 * Sets the children text content of target elements.
	 *
	 * @since 1.0.0
	 * 
	 * @param {object} parent   The parent element.
	 * @param {string} selector The element selector.
	 * @param {string} text     The text to be inserted in the element.
	 */
	setChildText( parent, selector, text = '' ) {
		if ( ! parent || ! selector ) {
			return;
		}

		const elems = parent.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.textContent = text;
			} );
		}
	},

	/**
	 * Check if parent has missing children element.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent   The parent element.
	 * @param {Array}  children The selectors of children element.
	 * @return {boolean} Check if has missing child.
	 */
	hasMissingChild( parent, children ) {
		if ( ! parent || ! children ) {
			return true;
		}

		let output = false;
		children.forEach( function( child ) {
			const elements = parent.querySelectorAll( child );
			if ( elements.length === 0 ) {
				output = true;
				console.log( elements );
			}
		} );

		return output;
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

	/**
	 * Capitalize the first letter in a word.
	 *
	 * @since 1.0.0
	 * 
	 * @param  {string} string The string to be capitalize.
	 * @return {string} The capitalized string.
	 */
	capitalizeFirstLetter( string = '' ) {
		return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
	}
};

/**
 * Holds the accordion component events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.accordion = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.toggle();
	},

	/**
	 * Close all the accordion children based by parent accordion attribute.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The accordion parent body element.
	 */
	closeAllOpenedChild( parent ) {
		if ( ! parent ) {
			return;
		}

		// Update accordion toggle button state to close.
		const toggleBtnElems = parent.querySelectorAll( '.hvsfw-accordion__toggle-btn[data-state="open"]' );
		if ( toggleBtnElems.length > 0 ) {
			toggleBtnElems.forEach( function( toggleBtnElem ) {
				toggleBtnElem.setAttribute( 'title', 'open' );
				toggleBtnElem.setAttribute( 'aria-label', 'open' );
				toggleBtnElem.setAttribute( 'data-state', 'close' );
			} );
		}

		// Update accordion body state to close.
		const bodyElems = parent.querySelectorAll( '.hvsfw-accordion__body[data-state="open"]' );
		if ( bodyElems.length > 0 ) {
			bodyElems.forEach( function( bodyElem ) {
				setTimeout( function() {
					bodyElem.style.maxHeight = null;
				}, 300 );
				bodyElem.setAttribute( 'data-state', 'close' );
			} );
		}
	},

	/**
	 * Collapse down and up card.
	 *
	 * @since 1.0.0
	 */
	toggle() {
		hvsfw.fn.eventListener( 'click', '.hvsfw-accordion__toggle-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const bodyElem = target.closest( '.hvsfw-accordion__head' ).nextElementSibling;
			if ( ! bodyElem || ! [ 'open', 'close' ].includes( state ) ) {
				return;
			}

			const updatedTitle = ( state === 'open' ? 'open' : 'close' );
			const updatedState = ( state === 'open' ? 'close' : 'open' );

			bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
			if ( state === 'open' ) {
				setTimeout( function() {
					bodyElem.style.maxHeight = null;
				}, 300 );
			} else {
				setTimeout( function() {
					bodyElem.style.maxHeight = 'max-content';
				}, 500 );
			}

			target.setAttribute( 'title', updatedTitle );
			target.setAttribute( 'aria-label', updatedTitle );
			target.setAttribute( 'data-state', updatedState );
			bodyElem.setAttribute( 'data-state', updatedState );
		} );
	},
};

/**
 * Holds the swatch setting form events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.form = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.colorPicker();
		this.settingFieldEvents();
		this.tooltipFieldEvents();
		this.onChangeAttributeType();
		this.onChangeTermType();
		this.saveSwatchSettings();
		this.resetSwatchSettings();
		this.deleteSwatchSetting();
	},

	/**
	 * Color Picker Field.
	 *
	 * @since 1.0.0
	 */
	colorPicker() {
		const colorPickerElems = document.querySelectorAll( '.hvsfw-color-picker' );
		if ( colorPickerElems.length === 0 ) {
			return;
		}

		jQuery( '.hvsfw-color-picker-style' ).wpColorPicker();
	},

	/**
	 * Set to default or reset color swatch picker.
	 *
	 * @since 1.0.0
	 * 
	 * @param {object} parent The accordion parent element.
	 */
	setColorPickerToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const colorPickerElems = parent.querySelectorAll( '.hvsfw-color-picker' );
		if ( colorPickerElems.length > 0 ) {
			colorPickerElems.forEach( function( colorPickerElem ) {
				colorPickerModule.setToDefault( colorPickerElem );
			});
		}
	},

	/**
	 * Set to default or reset image picker.
	 *
	 * @since 1.0.0
	 * 
	 * @param {object} parent The accordion parent element.
	 */
	setImagePickerToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const imagePickerElems = parent.querySelectorAll( '.hvsfw-image-picker' );
		if ( imagePickerElems.length > 0 ) {
			imagePickerElems.forEach( function( imagePickerElem ) {
				imagePickerModule.setToDefault( imagePickerElem );
			});
		}
	},

	/**
	 * Set to default or reset image size.
	 *
	 * @since 1.0.0
	 * 
	 * @param {object} parent The accordion parent element.
	 */
	setImageSizeToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		hvsfw.fn.setChildValue( parent, '.hvsfw-image-size-selector > select', 'thumbnail' )
	},

	/**
	 * Set to default or reset button label input.
	 *
	 * @since 1.0.0
	 * 
	 * @param {object} parent The accordion parent element.
	 */
	setButtonLabelToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const buttonLabelElems = parent.querySelectorAll( '.hvsfw-field-value-button-label' );
		if ( buttonLabelElems.length > 0 ) {
			buttonLabelElems.forEach( function( buttonLabelElem ) {
				buttonLabelElem.value = buttonLabelElem.getAttribute( 'data-default' );
			});
		}
	},

	/**
	 * Load the setting field events from settingFieldModule.
	 *
	 * @since 1.0.0
	 */
	settingFieldEvents() {
		settingFieldModule.init( {
			page: 'product',
			type: '.hvsfw-setting-field-type',
			style: '.hvsfw-setting-field-style',
			shape: '.hvsfw-setting-field-shape',
		} );
	},

	/**
	 * Load the tooltip field events from tooltipFieldModule.
	 *
	 * @since 1.0.0
	 */
	tooltipFieldEvents() {
		tooltipFieldModule.init();
	},

	/**
	 * Update all fields state that are dependent in attribute type field.
	 *
	 * @since 1.0.0
	 */
	onChangeAttributeType() {
		hvsfw.fn.eventListener( 'change', '.hvsfw-field-attribute-type', function( e ) {
			const target = e.target;
			const type = target.value;
			const validValues = [ 'default', 'select', 'button', 'color', 'image', 'assorted' ];
			if ( ! validValues.includes( type ) ) {
				return;
			}

			const parentElem = target.closest( '[data-accordion="attribute"]' );
			if ( ! parentElem ) {
				return;
			}

			const hasMissingChild = hvsfw.fn.hasMissingChild( parentElem, [
				'.hvsfw-term-control',
				'.hvsfw-term-select-type',
				'.hvsfw-field-term-type',
				'[data-accordion="global-style"]',
			] );

			if ( hasMissingChild === true ) {
				return;
			}

			// Update the visibility of global style accordion.
			const isVisibleGlobalStyleAccordion = ( [ 'button', 'color', 'image' ].includes( type ) ? 'yes' : 'no' );
			hvsfw.fn.setChildVisibilty( parentElem, '[data-accordion="global-style"]', isVisibleGlobalStyleAccordion );

			// Update the visibility of term controls and accordion.
			const isTypeAssorted = ( type === 'assorted' ? 'yes' : 'no' );
			const isVisibleTermControl = ( [ 'default', 'select' ].includes( type ) ? 'no' : 'yes' );
			hvsfw.fn.setChildValue( parentElem, '.hvsfw-field-term-type', type );
			hvsfw.fn.setChildVisibilty( parentElem, '.hvsfw-term-control', isVisibleTermControl );
			hvsfw.fn.setChildVisibilty( parentElem, '.hvsfw-term-select-type', isTypeAssorted );
			hvsfw.fn.setChildVisibilty( parentElem, '[data-accordion="style"]', isTypeAssorted );

			// Dispatch on change event in select term type.
			if ( [ 'button', 'color', 'image', 'assorted' ].includes( type ) ) {
				const termTypeValue = ( type === 'assorted' ? 'button' : type );
				hvsfw.fn.setChildValue( parentElem, '.hvsfw-field-term-type', termTypeValue );

				const termTypeElems = parentElem.querySelectorAll( '.hvsfw-field-term-type' );
				if ( termTypeElems.length > 0 ) {
					termTypeElems.forEach( function( termTypeElem ) {
						termTypeElem.dispatchEvent( new Event( 'change', {
							bubbles: true
						}));
					});
				}
			}

			// Close all opened child accordion.
			const bodyElem = parentElem.querySelector( '.hvsfw-accordion__body' );
			if ( bodyElem ) {
				hvsfw.accordion.closeAllOpenedChild( bodyElem );
			}
		} );
	},

	/**
	 * Update all the fields state that are dependent in term type field.
	 *
	 * @since 1.0.0
	 */
	onChangeTermType() {
		hvsfw.fn.eventListener( 'change', '.hvsfw-field-term-type', function( e ) {
			const target = e.target;
			const type = target.value;
			const validValues = [ 'button', 'color', 'image' ];
			if ( ! validValues.includes( type ) ) {
				return;
			}

			const parentElem = target.closest( '[data-accordion="term"]' );
			if ( ! parentElem ) {
				return;
			}

			const hasMissingChild = hvsfw.fn.hasMissingChild( parentElem, [
				'.hvsfw-accordion__title[data-type="value"]',
				'[data-group-field="value_button"]',
				'[data-group-field="value_color"]',
				'[data-group-field="value_image"]'
			] );

			if ( hasMissingChild === true ) {
				return;
			}

			// Update term value accordion title.
			hvsfw.fn.setChildText( parentElem, '.hvsfw-accordion__title[data-type="value"]', hvsfw.fn.capitalizeFirstLetter( type ) );

			// Update group field visibility.
			hvsfw.fn.setChildVisibilty( parentElem, '[data-group-field="value_button"]', ( type === 'button' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildVisibilty( parentElem, '[data-group-field="value_color"]', ( type === 'color' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildVisibilty( parentElem, '[data-group-field="value_image"]', ( type === 'image' ? 'yes' : 'no' ) );

			// Set button label, color, image, image size picker to default.
			hvsfw.form.setButtonLabelToDefault( parentElem );
			hvsfw.form.setColorPickerToDefault( parentElem );
			hvsfw.form.setImagePickerToDefault( parentElem );
			hvsfw.form.setImageSizeToDefault( parentElem );

			// Close all opened child accordion.
			const bodyElem = parentElem.querySelector( '.hvsfw-accordion__body' );
			if ( bodyElem ) {
				hvsfw.accordion.closeAllOpenedChild( bodyElem );
			}
		});
	},

	/**
	 * Save swatch settings ajax.
	 *
	 * @since 1.0.0
	 */
	saveSwatchSettings() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-save-setting-btn', async function( e ) {
			e.preventDefault();
			const formElem = document.getElementById( 'post' );
			if ( ! formElem ) {
				return;
			}

			const formData = new FormData( formElem );
			const res = await hvsfw.fn.fetch({
				nonce: hvsfwLocal.variation.product.nonce.saveSwatchSettings,
				action: 'hvsfw_save_swatch_settings',
				formData: new URLSearchParams( formData ).toString()
			});
		});
	},

	/**
	 * Reset swatch settings ajax.
	 *
	 * @since 1.0.0
	 */
	resetSwatchSettings() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-reset-setting-btn', function( e ) {
			e.preventDefault();
			alert();
		});
	},

	/**
	 * Delete swatch setting/// DELETE IN PROD.
	 * @return {[type]} [description]
	 */
	deleteSwatchSetting() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-delete-setting-btn', async function( e ) {
			const target = e.target;
			const postId = target.getAttribute( 'data-id' );

			const res = await hvsfw.fn.fetch({
				nonce: hvsfwLocal.variation.product.nonce.deleteSwatchSettings,
				action: 'hvsfw_delete_swatch_settings',
				postId: postId
			});

			if ( res.success === true ) {
				alert( 'DELETED' );
			}
		});
	}
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
	hvsfw.accordion.init(); // Handle the accordion component events.
	hvsfw.form.init(); // Handle the form component events.
} );
