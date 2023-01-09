import settingFieldModule from './modules/setting-field.js';

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
		//this.onChangeAttributeType();
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

		jQuery( '.hvsfw-color-picker' ).wpColorPicker();
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
	 * Update all fields state that are dependent in attribute type field.
	 *
	 * @since 1.0.0
	 */
	onChangeAttributeType() {
		hvsfw.fn.eventListener( 'change', '.hvsfw-field-attribute-type', function( e ) {
			const target = e.target;
			const value = target.value;
			const validValues = [ 'default', 'select', 'button', 'color', 'image', 'assorted' ];
			if ( ! validValues.includes( value ) ) {
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

			// Update the visibility of term control.
			const isVisibleTermControl = ( [ 'default', 'select' ].includes( value ) ? 'no' : 'yes' );
			const isVisibleTermSelectType = ( value === 'assorted' ? 'yes' : 'no' );
			hvsfw.fn.setChildValue( parentElem, '.hvsfw-field-term-type', value );
			hvsfw.fn.setChildVisibilty( parentElem, '.hvsfw-term-control', isVisibleTermControl );
			hvsfw.fn.setChildVisibilty( parentElem, '.hvsfw-term-select-type', isVisibleTermSelectType );

			// Update the visibility of global style accordion.
			const isVisibleGlobalStyleAccordion = ( [ 'button', 'color', 'image' ].includes( value ) ? 'yes' : 'no' );
			hvsfw.fn.setChildVisibilty( parentElem, '[data-accordion="global-style"]', isVisibleGlobalStyleAccordion );

			// Update the child accordion state.
			if ( isVisibleTermControl === 'no' ) {
				const bodyElem = parentElem.querySelector( '.hvsfw-accordion__body' );
				if ( bodyElem ) {
					hvsfw.accordion.closeAllOpenedChild( bodyElem );
				}
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
	hvsfw.accordion.init(); // Handle the accordion component events.
	hvsfw.form.init(); // Handle the form component events.
} );
