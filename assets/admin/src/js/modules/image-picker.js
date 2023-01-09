/**
 * Color Picker Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const imagePicker = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.uploadImage();
		this.removeImage();
	},

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
	 * Set to default or reset image picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The image picker parent element.
	 */
	setToDefault( parent ) {
		let imagePickerElems = Array.from( document.querySelectorAll( '.hvsfw-image-picker' ) );
		imagePickerElems = ( parent ? [ parent ] : imagePickerElems );
		if ( imagePickerElems.length === 0 ) {
			return;
		}

		imagePickerElems.forEach( function( imagePickerElem ) {
			const inputElem = imagePickerElem.querySelector( '.hvsfw-image-picker-input' );
			const imageElem = imagePickerElem.querySelector( '.hvsfw-image-picker__img' );
			const removeBtnElem = imagePickerElem.querySelector( '.hvsfw-js-image-picker-remove-btn' );
			if ( inputElem && imageElem && removeBtnElem ) {
				const imagePlaceholder = imageElem.getAttribute( 'data-default' );

				inputElem.value = 0;

				imageElem.setAttribute( 'src', imagePlaceholder );
				imageElem.setAttribute( 'alt', 'WooCommerce Placeholder' );
				imageElem.setAttribute( 'title', 'WooCommerce Placeholder' );

				removeBtnElem.setAttribute( 'data-state', 'disabled' );
			}
		} );
	},

	/**
	 * Upload or select image from media library.
	 *
	 * @since 1.0.0
	 */
	uploadImage() {
		this.eventListener( 'click', '.hvsfw-js-image-picker-select-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			if ( state !== 'default' ) {
				return;
			}

			const parentElem = target.closest( '.hvsfw-image-picker' );
			if ( ! parentElem ) {
				return;
			}

			const inputElem = parentElem.querySelector( '.hvsfw-image-picker-input' );
			const imageElem = parentElem.querySelector( '.hvsfw-image-picker__img' );
			const removeBtnElem = parentElem.querySelector( '.hvsfw-js-image-picker-remove-btn' );
			if ( ! inputElem || ! imageElem || ! removeBtnElem ) {
				return;
			}

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
		this.eventListener( 'click', '.hvsfw-js-image-picker-remove-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			if ( state !== 'default' ) {
				return;
			}

			const parentElem = target.closest( '.hvsfw-image-picker' );
			if ( parentElem ) {
				imagePickerModule.setToDefault( parentElem );
			}
		} );
	},
};

export default imagePicker;
