/**
 * Internal Modules.
 */
import settingFieldModule from './modules/settingField.js';

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
 * Holds the product attribute swatch setting form.
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
		this.poseTypeSelectorField();
		this.settingFieldEvents();
	},

	/**
	 * Color Picker Field.
	 *
	 * @since 1.0.0
	 */
	colorPicker() {
		const colorPickerElems = document.querySelectorAll( '.hvsfw-color-picker' );
		if ( 0 < colorPickerElems.length ) {
			jQuery( '.hvsfw-color-picker' ).wpColorPicker();
		}
	},

	/**
	 * Reposition the attribute type selector field.
	 *
	 * @since 1.0.0
	 */
	poseTypeSelectorField() {
		const formFieldStyleElem = document.getElementById( 'hvsfw-form-field-style' );
		const attributeTypeElem = document.getElementById( 'attribute_type' );
		if ( formFieldStyleElem && attributeTypeElem ) {
			attributeTypeElem.setAttribute( 'data-prefix', 'hvsfw' );
			const formFieldTypeElem = attributeTypeElem.closest( '.form-field' );
			if ( formFieldTypeElem ) {
				formFieldStyleElem.before( formFieldTypeElem );
			}
		}
	},

	/**
	 * Load the setting field events from settingFieldModule.
	 *
	 * @since 1.0.0
	 */
	settingFieldEvents() {
		settingFieldModule.init( {
			page: 'attribute',
			type: '#attribute_type',
			style: '#hvsfw_style',
			shape: '#hvsfw_shape',
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
