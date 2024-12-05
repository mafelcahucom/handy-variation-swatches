/**
 * Internal Dependencies.
 */
import {
	getFetch,
	getUCFirst,
	setText,
	setValue,
	setVisibility,
	eventListener,
	hasMissingChild,
} from '../../helpers';

/**
 * Internal Modules.
 */
import colorPickerModule from './modules/colorPicker.js';
import imagePickerModule from './modules/imagePicker.js';
import settingFieldModule from './modules/settingField.js';
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
	 * Close all the accordion children based on parent accordion attribute.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent body element.
	 */
	closeAllOpenedChild( parent ) {
		if ( ! parent ) {
			return;
		}

		// Update accordion toggle button state to close.
		const toggleBtnElems = parent.querySelectorAll(
			'.hvsfw-accordion__toggle-btn[data-state="open"]'
		);
		if ( 0 < toggleBtnElems.length ) {
			toggleBtnElems.forEach( ( toggleBtnElem ) => {
				toggleBtnElem.setAttribute( 'title', 'open' );
				toggleBtnElem.setAttribute( 'aria-label', 'open' );
				toggleBtnElem.setAttribute( 'data-state', 'close' );
			} );
		}

		// Update accordion body state to close.
		const bodyElems = parent.querySelectorAll( '.hvsfw-accordion__body[data-state="open"]' );
		if ( 0 < bodyElems.length ) {
			bodyElems.forEach( ( bodyElem ) => {
				setTimeout( () => {
					bodyElem.style.maxHeight = null;
				}, 300 );
				bodyElem.setAttribute( 'data-state', 'close' );
			} );
		}
	},

	/**
	 * Collapse card up and down.
	 *
	 * @since 1.0.0
	 */
	toggle() {
		eventListener( 'click', '.hvsfw-accordion__toggle-btn', ( e ) => {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const bodyElem = target.closest( '.hvsfw-accordion__head' ).nextElementSibling;
			if ( bodyElem && [ 'open', 'close' ].includes( state ) ) {
				const updatedTitle = 'open' === state ? 'open' : 'close';
				const updatedState = 'open' === state ? 'close' : 'open';

				bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
				if ( 'open' === state ) {
					setTimeout( () => {
						bodyElem.style.maxHeight = null;
					}, 300 );
				} else {
					setTimeout( () => {
						bodyElem.style.maxHeight = 'max-content';
					}, 500 );
				}

				target.setAttribute( 'title', updatedTitle );
				target.setAttribute( 'aria-label', updatedTitle );
				target.setAttribute( 'data-state', updatedState );
				bodyElem.setAttribute( 'data-state', updatedState );
			}
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
		if ( 0 < colorPickerElems.length ) {
			jQuery( '.hvsfw-color-picker-style' ).wpColorPicker();
		}
	},

	/**
	 * Set to default or reset the color swatch picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent element.
	 */
	setColorPickerToDefault( parent ) {
		if ( parent ) {
			const colorPickerElems = parent.querySelectorAll( '.hvsfw-color-picker' );
			if ( 0 < colorPickerElems.length ) {
				colorPickerElems.forEach( ( colorPickerElem ) => {
					colorPickerModule.setToDefault( colorPickerElem );
				} );
			}
		}
	},

	/**
	 * Set to default or reset the image picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent element.
	 */
	setImagePickerToDefault( parent ) {
		if ( parent ) {
			const imagePickerElems = parent.querySelectorAll( '.hvsfw-image-picker' );
			if ( 0 < imagePickerElems.length ) {
				imagePickerElems.forEach( ( imagePickerElem ) => {
					imagePickerModule.setToDefault( imagePickerElem );
				} );
			}
		}
	},

	/**
	 * Set to default or reset the image size.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent element.
	 */
	setImageSizeToDefault( parent ) {
		if ( parent ) {
			setValue.child( parent, '.hvsfw-image-size-selector > select', 'thumbnail' );
		}
	},

	/**
	 * Set to default or reset the button label input.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent element.
	 */
	setButtonLabelToDefault( parent ) {
		if ( parent ) {
			const buttonLabelElems = parent.querySelectorAll( '.hvsfw-field-value-button-label' );
			if ( 0 < buttonLabelElems.length ) {
				buttonLabelElems.forEach( ( buttonLabelElem ) => {
					buttonLabelElem.value = buttonLabelElem.getAttribute( 'data-default' );
				} );
			}
		}
	},

	/**
	 * Set to default or reset the tooltip forms.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent Contains the accordion parent element.
	 */
	setTooltipToDefault( parent ) {
		if ( parent ) {
			const termTypeElems = parent.querySelectorAll( '.hvsfw-field-term-type' );
			if ( 0 < termTypeElems.length ) {
				termTypeElems.forEach( ( termTypeElem ) => {
					let prefix = termTypeElem.getAttribute( 'data-prefix' );
					prefix = prefix.replace( '[style]', '[tooltip]' );
					if ( prefix ) {
						tooltipFieldModule.setToDefault( 'reset', prefix );
					}
				} );
			}
		}
	},

	/**
	 * Set the visibilty of BlockUI loader spinner visibility.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} state Contains the visibility state of the loader spinner.
	 */
	blockLoader( state ) {
		if ( state && [ 'show', 'hide' ].includes( state ) ) {
			const swatchPanelElem = jQuery( '#hvsfw_swatch_panel' );
			if ( swatchPanelElem ) {
				if ( 'show' === state ) {
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
		}
	},

	/**
	 * Prompt the swatch form message box.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params         Contains the parameters needed to render notice.
	 * @param {string} params.state   Contains the state or status of the notice.
	 * @param {string} params.message Contains the message or content of the notice.
	 */
	promptNotice( params ) {
		if ( params.state && params.message ) {
			const noticeElem = document.getElementById( 'hvsfw-notice' );
			const noticeTextElem = document.getElementById( 'hvsfw-notice-text' );
			if ( noticeElem && noticeTextElem ) {
				noticeElem.setAttribute( 'data-state', params.state );
				noticeElem.setAttribute( 'data-visibility', 'visible' );
				noticeTextElem.textContent = params.message;

				setTimeout( () => {
					noticeElem.setAttribute( 'data-visibility', 'hidden' );
				}, 5000 );
			}
		}
	},

	/**
	 * Prompt the swatch form error message box.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error Contains the error name.
	 */
	errorNotice( error ) {
		if ( ! error ) {
			return;
		}

		const errors = [
			{
				error: 'NETWORK_ERROR',
				title: 'Network Error',
				content:
					'The network connection is lost, there might be a problem with your network.',
			},
			{
				error: 'SECURITY_ERROR',
				title: 'Security Error',
				content:
					'A security error occur. Please try again later or contact the website administrator for help.',
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

		const errorDetail = errors.find( ( value ) => {
			return value.error === error;
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
		eventListener( 'change', '.hvsfw-field-attribute-type', ( e ) => {
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

			const hasMissing = hasMissingChild( parentElem, [
				'.hvsfw-term-control',
				'.hvsfw-term-select-type',
				'.hvsfw-field-term-type',
				'[data-accordion="global-style"]',
			] );

			if ( true === hasMissing ) {
				return;
			}

			// Update the visibility of global style accordion.
			const isVisibleGlobalStyleAccordion = [ 'button', 'color', 'image' ].includes( type )
				? 'yes'
				: 'no';
			setVisibility.child(
				parentElem,
				'[data-accordion="global-style"]',
				isVisibleGlobalStyleAccordion
			);

			// Update the visibility of term controls and accordion.
			const isTypeAssorted = 'assorted' === type ? 'yes' : 'no';
			const isVisibleTermControl = [ 'default', 'select' ].includes( type ) ? 'no' : 'yes';
			setValue.child( parentElem, '.hvsfw-field-term-type', type );
			setVisibility.child( parentElem, '.hvsfw-term-control', isVisibleTermControl );
			setVisibility.child( parentElem, '.hvsfw-term-select-type', isTypeAssorted );
			setVisibility.child( parentElem, '[data-accordion="style"]', isTypeAssorted );

			// Dispatch on change event in select term type.
			if ( [ 'button', 'color', 'image', 'assorted' ].includes( type ) ) {
				const termTypeValue = 'assorted' === type ? 'button' : type;
				setValue.child( parentElem, '.hvsfw-field-term-type', termTypeValue );

				const termTypeElems = parentElem.querySelectorAll( '.hvsfw-field-term-type' );
				if ( 0 < termTypeElems.length ) {
					termTypeElems.forEach( ( termTypeElem ) => {
						termTypeElem.dispatchEvent(
							new Event( 'change', {
								bubbles: true,
							} )
						);
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
		eventListener( 'change', '.hvsfw-field-term-type', ( e ) => {
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

			const hasMissing = hasMissingChild( parentElem, [
				'.hvsfw-accordion__title[data-type="value"]',
				'[data-group-field="value_button"]',
				'[data-group-field="value_color"]',
				'[data-group-field="value_image"]',
			] );

			if ( true === hasMissing ) {
				return;
			}

			// Update term value accordion title.
			setText.child(
				parentElem,
				'.hvsfw-accordion__title[data-type="value"]',
				getUCFirst( type )
			);

			// Update group field visibility.
			setVisibility.child(
				parentElem,
				'[data-group-field="value_button"]',
				'button' === type ? 'yes' : 'no'
			);
			setVisibility.child(
				parentElem,
				'[data-group-field="value_color"]',
				'color' === type ? 'yes' : 'no'
			);
			setVisibility.child(
				parentElem,
				'[data-group-field="value_image"]',
				'image' === type ? 'yes' : 'no'
			);

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
		eventListener( 'click', '#hvsfw-js-save-setting-btn', async ( e ) => {
			e.preventDefault();
			const formElem = document.getElementById( 'post' );
			if ( ! formElem ) {
				return;
			}

			hvsfw.form.blockLoader( 'show' );

			const formData = new FormData( formElem );
			const res = await getFetch( {
				// eslint-disable-next-line no-undef
				nonce: hvsfwLocal.variation.product.nonce.saveSwatchSettings,
				action: 'hvsfw_save_swatch_settings',
				formData: new URLSearchParams( formData ).toString(),
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( true === res.success ) {
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
		jQuery( 'body' ).on( 'reload', async () => {
			const postIdElem = document.getElementById( 'post_ID' );
			const swatchAttributeElem = document.getElementById( 'hvsfw-swatch-attributes' );
			if ( ! postIdElem || ! swatchAttributeElem ) {
				return;
			}

			const postId = parseInt( postIdElem.value );
			if ( postId === NaN || 0 === postId ) {
				return;
			}

			hvsfw.form.blockLoader( 'show' );

			const res = await getFetch( {
				// eslint-disable-next-line no-undef
				nonce: hvsfwLocal.variation.product.nonce.updateSwatchSettings,
				action: 'hvsfw_update_swatch_settings',
				postId,
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( true === res.success ) {
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
		eventListener( 'click', '#hvsfw-js-reset-setting-btn', async ( e ) => {
			e.preventDefault();
			const postIdElem = document.getElementById( 'post_ID' );
			if ( ! postIdElem ) {
				return;
			}

			const postId = parseInt( postIdElem.value );
			if ( postId === NaN || 0 === postId ) {
				return;
			}

			// eslint-disable-next-line no-alert
			const isContinue = confirm( 'Do you really want to reset the swatch settings?' );
			if ( ! isContinue ) {
				return;
			}

			hvsfw.form.blockLoader( 'show' );

			const res = await getFetch( {
				// eslint-disable-next-line no-undef
				nonce: hvsfwLocal.variation.product.nonce.resetSwatchSettings,
				action: 'hvsfw_reset_swatch_settings',
				postId,
			} );

			hvsfw.form.blockLoader( 'hide' );

			if ( true === res.success ) {
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
				const attributeTypeElems = document.querySelectorAll(
					'.hvsfw-field-attribute-type'
				);
				if ( 0 < attributeTypeElems.length ) {
					attributeTypeElems.forEach( ( attributeTypeElem ) => {
						attributeTypeElem.value = 'default';
						attributeTypeElem.dispatchEvent(
							new Event( 'change', {
								bubbles: true,
							} )
						);
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
