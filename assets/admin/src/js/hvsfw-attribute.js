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
		if ( colorPickerElems.length === 0 ) {
			return;
		}

		jQuery( '.hvsfw-color-picker' ).wpColorPicker();
	},

	/**
	 * Reposition the attribute type selector field.
	 *
	 * @since 1.0.0
	 */
	poseTypeSelectorField() {
		const formFieldStyleElem = document.getElementById( 'hvsfw-form-field-style' );
		const attributeTypeElem = document.getElementById( 'attribute_type' );
		if ( ! formFieldStyleElem || ! attributeTypeElem ) {
			return;
		}

		attributeTypeElem.setAttribute( 'data-prefix', 'hvsfw' );
		const formFieldTypeElem = attributeTypeElem.closest( '.form-field' );
		if ( ! formFieldTypeElem ) {
			return;
		}

		formFieldStyleElem.before( formFieldTypeElem );
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
	hvsfw.form.init(); // Handle the swatch setting form events.
} );
