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
};

/**
 * Holds the color swatch setting form.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.colorPicker = {

	/**
	 * Holds the color picker parent element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	parentElem: null,

	/**
	 * Holds the color picker list element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	listElem: null,

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		if ( ! this.constructor() ) {
			return;
		}

		this.setColorPicker();
		this.addNewField();
		this.deleteField();
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
		// Set parentElem property.
		const parentElem = document.getElementById( 'hvsfw-color-picker' );
		if ( ! parentElem ) {
			return false;
		}

		hvsfw.colorPicker.parentElem = parentElem;

		// Set listElem property.
		const listElem = parentElem.querySelector( '.hvsfw-color-picker__list' );
		if ( ! listElem ) {
			return false;
		}

		hvsfw.colorPicker.listElem = listElem;

		return true;
	},

	/**
	 * Set the color picker.
	 *
	 * @param  action
	 * @since 1.0.0
	 */
	setColorPicker( action = 'set' ) {
		const selector = '.hvsfw-color-picker__input';
		jQuery( selector ).wpColorPicker();

		if ( action === 'reset' ) {
			jQuery( selector ).iris( 'color', '#ffffff' );
		}
	},

	/**
	 * Set the count of items.
	 *
	 * @since 1.0.0
	 */
	setCount() {
		const parentElem = hvsfw.colorPicker.parentElem;
		const listElem = hvsfw.colorPicker.listElem;

		parentElem.setAttribute( 'data-count', listElem.childElementCount );
	},

	/**
	 * Set to default or reset color picker.
	 *
	 * @since 1.0.0
	 */
	setToDefault() {
		const parentElem = document.getElementById( 'hvsfw-color-picker' );
		if ( ! parentElem ) {
			return;
		}

		const listElem = hvsfw.colorPicker.listElem;
		const itemElems = listElem.querySelectorAll( '.hvsfw-color-picker__item' );
		if ( itemElems.length === 0 ) {
			return;
		}

		if ( itemElems.length > 1 ) {
			itemElems.forEach( function( itemElem, index ) {
				if ( index !== 0 ) {
					itemElem.remove();
				}
			} );
		}

		this.setCount();
		this.setColorPicker( 'reset' );
	},

	/**
	 * Returns the new created color picker component element.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement} Color picker component.
	 */
	field() {
		const element = document.createElement( 'div' );
		element.className = 'hvsfw-color-picker__item';
		element.innerHTML = `
            <div class="hvsfw-col__left">
                <input type="hidden" name="hvsfw_colors[]" class="hvsfw-color-picker__input" value="#ffffff">
            </div>
            <div class="hvsfw-col__right">
                <button type="button" class="hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button">Delete</button>
            </div>
        `;

		return element;
	},

	/**
	 * Add new color picker field.
	 *
	 * @since 1.0.0
	 */
	addNewField() {
		hvsfw.fn.eventListener( 'click', '.hvsfw-js-color-picker-add-btn', function( e ) {
			e.preventDefault();
			const parentElem = hvsfw.colorPicker.parentElem;
			const listElem = hvsfw.colorPicker.listElem;
			const newColorPickerField = hvsfw.colorPicker.field();

			listElem.appendChild( newColorPickerField );

			hvsfw.colorPicker.setColorPicker();
			hvsfw.colorPicker.setCount();
		} );
	},

	/**
	 * Delete a certain color picker field.
	 *
	 * @since 1.0.0
	 */
	deleteField() {
		hvsfw.fn.eventListener( 'click', '.hvsfw-js-color-picker-delete-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const itemElem = target.closest( '.hvsfw-color-picker__item' );
			if ( itemElem ) {
				itemElem.remove();
				hvsfw.colorPicker.setCount();
			}
		} );
	},
};

/**
 * Holds the image swatch setting form.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.imagePicker = {

	/**
	 * Holds the image previewer element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	imageElem: null,

	/**
	 * Holds the input element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	inputElem: null,

	/**
	 * Holds the remove button element.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	removeBtnElem: null,

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		if ( ! this.constructor() ) {
			return;
		}

		this.uploadImage();
		this.removeImage();
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
		// Set imageElem property.
		const imageElem = document.getElementById( 'hvsfw-image-picker-img' );
		if ( ! imageElem ) {
			return false;
		}

		hvsfw.imagePicker.imageElem = imageElem;

		// Set inputElem property.
		const inputElem = document.getElementById( 'hvsfw-image-picker-input' );
		if ( ! inputElem ) {
			return false;
		}

		hvsfw.imagePicker.inputElem = inputElem;

		// Set removeBtnElem property.
		const removeBtnElem = document.getElementById( 'hvsfw-js-image-picker-remove-btn' );
		if ( ! removeBtnElem ) {
			return false;
		}

		hvsfw.imagePicker.removeBtnElem = removeBtnElem;

		return true;
	},

	/**
	 * Set to default or reset image picker.
	 *
	 * @since 1.0.0
	 */
	setToDefault() {
		const imageElem = document.getElementById( 'hvsfw-image-picker-img' );
		if ( ! imageElem ) {
			return;
		}

		const inputElem = hvsfw.imagePicker.inputElem;
		const removeBtnElem = hvsfw.imagePicker.removeBtnElem;
		const imagePlaceholder = imageElem.getAttribute( 'data-default' );

		inputElem.value = 0;

		imageElem.setAttribute( 'src', imagePlaceholder );
		imageElem.setAttribute( 'alt', 'WooCommerce Placeholder' );
		imageElem.setAttribute( 'title', 'WooCommerce Placeholder' );

		removeBtnElem.setAttribute( 'data-state', 'disabled' );
	},

	/**
	 * Upload or select image from media library.
	 *
	 * @since 1.0.0
	 */
	uploadImage() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-image-picker-select-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			if ( state !== 'default' ) {
				return;
			}

			const imageElem = hvsfw.imagePicker.imageElem;
			const inputElem = hvsfw.imagePicker.inputElem;
			const removeBtnElem = hvsfw.imagePicker.removeBtnElem;

			const uploader = wp.media( {
				title: 'Select Image',
				library: {
					type: 'image',
				},
				button: {
					text: 'Use Image',
				},
				multiple: false,
			} );

			uploader.open();
			uploader.on( 'select', function() {
				const attachment = uploader.state().get( 'selection' ).toJSON();

				inputElem.value = attachment[ 0 ].id;

				imageElem.setAttribute( 'src', attachment[ 0 ].url );
				imageElem.setAttribute( 'alt', attachment[ 0 ].alt );
				imageElem.setAttribute( 'title', attachment[ 0 ].title );

				removeBtnElem.setAttribute( 'data-state', 'default' );
			} );
		} );
	},

	/**
	 * Remove or delete the current image selected.
	 *
	 * @since 1.0.0
	 */
	removeImage() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-image-picker-remove-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			if ( state === 'default' ) {
				hvsfw.imagePicker.setToDefault();
			}
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

			// Reset color and image forms.
			if ( keys.action === 'add-tag' ) {
				hvsfw.colorPicker.setToDefault();
				hvsfw.imagePicker.setToDefault();
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
	hvsfw.colorPicker.init(); // Handle the color swatch setting form events.
	hvsfw.imagePicker.init(); // Handle the image swatch setting form events.
	hvsfw.ajax.init(); // Handle the ajax events catcher.
} );
