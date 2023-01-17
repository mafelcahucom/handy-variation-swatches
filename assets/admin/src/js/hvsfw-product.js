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
	 * @param {Object} parent   The parent element.
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
			}
		} );

		return output;
	},

	/**
	 * Capitalize the first letter in a word.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} string The string to be capitalize.
	 * @return {string} The capitalized string.
	 */
	capitalizeFirstLetter( string = '' ) {
		return string.charAt( 0 ).toUpperCase() + string.slice( 1 );
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
		this.tooltipFieldEvents();
		this.onChangeAttributeType();
		this.onChangeTermType();
		this.saveSwatchSettings();
		this.updateSwatchSettings();
		this.resetSwatchSettings();
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
	 * @param {Object} parent The accordion parent element.
	 */
	setColorPickerToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const colorPickerElems = parent.querySelectorAll( '.hvsfw-color-picker' );
		if ( colorPickerElems.length > 0 ) {
			colorPickerElems.forEach( function( colorPickerElem ) {
				colorPickerModule.setToDefault( colorPickerElem );
			} );
		}
	},

	/**
	 * Set to default or reset image picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The accordion parent element.
	 */
	setImagePickerToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const imagePickerElems = parent.querySelectorAll( '.hvsfw-image-picker' );
		if ( imagePickerElems.length > 0 ) {
			imagePickerElems.forEach( function( imagePickerElem ) {
				imagePickerModule.setToDefault( imagePickerElem );
			} );
		}
	},

	/**
	 * Set to default or reset image size.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The accordion parent element.
	 */
	setImageSizeToDefault( parent ) {
		if ( parent ) {
			hvsfw.fn.setChildValue( parent, '.hvsfw-image-size-selector > select', 'thumbnail' );
		}
	},

	/**
	 * Set to default or reset button label input.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The accordion parent element.
	 */
	setButtonLabelToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const buttonLabelElems = parent.querySelectorAll( '.hvsfw-field-value-button-label' );
		if ( buttonLabelElems.length > 0 ) {
			buttonLabelElems.forEach( function( buttonLabelElem ) {
				buttonLabelElem.value = buttonLabelElem.getAttribute( 'data-default' );
			} );
		}
	},

	/**
	 * Set to default or reset tooltip forms.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The accordion parent element.
	 */
	setTooltipToDefault( parent ) {
		if ( ! parent ) {
			return;
		}

		const termTypeElems = parent.querySelectorAll( '.hvsfw-field-term-type' );
		if ( termTypeElems.length === 0 ) {
			return;
		}

		termTypeElems.forEach( function( termTypeElem ) {
			let prefix = termTypeElem.getAttribute( 'data-prefix' );
			prefix = prefix.replace( '[style]', '[tooltip]' );
			if ( prefix ) {
				tooltipFieldModule.setToDefault( 'reset', prefix );
			}
		} );
	},

	/**
	 * Set the visibilty of BlockUI loader spinner visibility.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} state The visibility of the loader spinner.
	 */
	blockLoader( state ) {
		if ( ! state || ! [ 'show', 'hide' ].includes( state ) ) {
			return;
		}

		const swatchPanelElem = jQuery( '#hvsfw_swatch_panel' );
		if ( swatchPanelElem ) {
			if ( state === 'show' ) {
				swatchPanelElem.block( {
					message: null,
					overlayCSS: {
						background: '#f3f3f3',
						opacity: 0.5,
					},
				} );
			} else {
				swatchPanelElem.unblock();
			}
		}
	},

	/**
	 * Prompt the swatch form message box.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params         Containing the parameters needed to render notice.
	 * @param {string} params.state   The state or status of the notice.
	 * @param {string} params.message The message or content of the notice.
	 */
	promptNotice( params ) {
		if ( ! params.state || ! params.message ) {
			return;
		}

		const noticeElem = document.getElementById( 'hvsfw-notice' );
		const noticeTextElem = document.getElementById( 'hvsfw-notice-text' );
		if ( ! noticeElem || ! noticeTextElem ) {
			return;
		}

		noticeElem.setAttribute( 'data-state', params.state );
		noticeElem.setAttribute( 'data-visibility', 'visible' );
		noticeTextElem.textContent = params.message;

		setTimeout( function() {
			noticeElem.setAttribute( 'data-visibility', 'hidden' );
		}, 5000 );
	},

	/**
	 * Prompt the swatch form error message box.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error The error name.
	 */
	errorNotice( error ) {
		if ( ! error ) {
			return;
		}

		const errors = [
			{
				error: 'NETWORK_ERROR',
				title: 'Network Error',
				content: 'The network connection is lost, there might be a problem with your network.',
			},
			{
				error: 'SECURITY_ERROR',
				title: 'Security Error',
				content: 'A security error occur. Please try again later or contact the website administrator for help.',
			},
			{
				error: 'MISSING_DATA_ERROR',
				title: 'Missing Data',
				content: 'There is a missing data that are required. Please check and try again.',
			},
			{
				error: 'INVALID_PRODUCT_ID',
				title: 'Invalid Product ID',
				content: 'The product ID that you are trying to save is invalid product ID.',
			},
			{
				error: 'NOT_VARIABLE_PRODUCT',
				title: 'Not Variable Product',
				content: 'The product that you are trying to save is not a variable product.',
			},
			{
				error: 'FAILED_TO_SAVE',
				title: 'Failed To Save',
				content: 'Failed to save the swatch settings.',
			},
			{
				error: 'FAILED_TO_RESET',
				title: 'Failed To Reset',
				content: 'Failed to reset the swatch settings.',
			},
		];

		const errorDetail = errors.find( function( value ) {
			return ( value.error === error );
		} );

		if ( errorDetail ) {
			this.promptNotice( {
				state: 'error',
				message: errorDetail.content,
			} );
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
							bubbles: true,
						} ) );
					} );
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
				'[data-group-field="value_image"]',
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

			// Set tooltip form to default.
			hvsfw.form.setTooltipToDefault( parentElem );

			// Close all opened child accordion.
			const bodyElem = parentElem.querySelector( '.hvsfw-accordion__body' );
			if ( bodyElem ) {
				hvsfw.accordion.closeAllOpenedChild( bodyElem );
			}
		} );
	},

	/**
	 * Save swatch settings via AJAX.
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

			hvsfw.form.blockLoader( 'show' );

			const formData = new FormData( formElem );
			const res = await hvsfw.fn.fetch( {
				nonce: hvsfwLocal.variation.product.nonce.saveSwatchSettings,
				action: 'hvsfw_save_swatch_settings',
				formData: new URLSearchParams( formData ).toString(),
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( res.success === true ) {
				hvsfw.form.promptNotice( {
					state: 'success',
					message: 'Swatch settings has been successfully saved.',
				} );
			} else {
				hvsfw.form.errorNotice( res.data.error );
			}
		} );
	},

	/**
	 * Update swatch settings via AJAX.
	 *
	 * @since 1.0.0
	 */
	updateSwatchSettings() {
		jQuery( 'body' ).on( 'reload', async function() {
			const postIdElem = document.getElementById( 'post_ID' );
			const swatchAttributeElem = document.getElementById( 'hvsfw-swatch-attributes' );
			if ( ! postIdElem || ! swatchAttributeElem ) {
				return;
			}

			const postId = parseInt( postIdElem.value );
			if ( postId === NaN || postId === 0 ) {
				return;
			}

			hvsfw.form.blockLoader( 'show' );

			const res = await hvsfw.fn.fetch( {
				nonce: hvsfwLocal.variation.product.nonce.updateSwatchSettings,
				action: 'hvsfw_update_swatch_settings',
				postId,
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( res.success === true ) {
				swatchAttributeElem.innerHTML = res.data.content;

				// Re-init wpColorPicker.
				hvsfw.form.colorPicker();
				jQuery( '.hvsfw-color-picker__input' ).wpColorPicker();
			} else {
				hvsfw.form.errorNotice( res.data.error );
			}
		} );
	},

	/**
	 * Reset swatch settings AJAX.
	 *
	 * @since 1.0.0
	 */
	resetSwatchSettings() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-reset-setting-btn', async function( e ) {
			e.preventDefault();
			const postIdElem = document.getElementById( 'post_ID' );
			if ( ! postIdElem ) {
				return;
			}

			const postId = parseInt( postIdElem.value );
			if ( postId === NaN || postId === 0 ) {
				return;
			}

			const isContinue = confirm( 'Do you really want to reset the swatch settings?' );
			if ( ! isContinue ) {
				return;
			}

			hvsfw.form.blockLoader( 'show' );

			const res = await hvsfw.fn.fetch( {
				nonce: hvsfwLocal.variation.product.nonce.resetSwatchSettings,
				action: 'hvsfw_reset_swatch_settings',
				postId,
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( res.success === true ) {
				hvsfw.form.promptNotice( {
					state: 'success',
					message: 'Swatch settings has been successfully reset.',
				} );

				// Close all accordion.
				const swatchPanelElem = document.getElementById( 'hvsfw_swatch_panel' );
				if ( swatchPanelElem ) {
					hvsfw.accordion.closeAllOpenedChild( swatchPanelElem );
				}

				// Set all input to default.
				const attributeTypeElems = document.querySelectorAll( '.hvsfw-field-attribute-type' );
				if ( attributeTypeElems.length > 0 ) {
					attributeTypeElems.forEach( function( attributeTypeElem ) {
						attributeTypeElem.value = 'default';
						attributeTypeElem.dispatchEvent( new Event( 'change', {
							bubbles: true,
						} ) );
					} );
				}
			} else {
				hvsfw.form.errorNotice( res.data.error );
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
	hvsfw.accordion.init(); // Handle the accordion component events.
	hvsfw.form.init(); // Handle the form component events.
} );
