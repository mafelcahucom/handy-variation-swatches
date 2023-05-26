/**
 * Internal dependencies
 */
import imagePickerModule from './image-picker.js';

/**
 * Tooltio Field Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const tooltipField = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onChangeTypeField();
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
	 * Set to default or reset tooltip form.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} action The type of action.
	 * @param {string} prefix The prefix of the field.
	 */
	setToDefault( action = 'set', prefix ) {
		if ( ! action || ! prefix ) {
			return;
		}

		const imagePickerElem = document.getElementById( `${ prefix }_content_image` );
		if ( imagePickerElem ) {
			imagePickerModule.setToDefault( imagePickerElem );
		}

		this.setValue( `[id="${ prefix }_content_text"]`, '' );
		this.setValue( `[id="${ prefix }_content_html"]`, '' );

		this.setAttribute( `[data-group-field="${ prefix }_content_text"]`, 'data-visible', 'no' );
		this.setAttribute( `[data-group-field="${ prefix }_content_html"]`, 'data-visible', 'no' );
		this.setAttribute( `[data-group-field="${ prefix }_content_image"]`, 'data-visible', 'no' );

		if ( action === 'reset' ) {
			this.setValue( `[id="${ prefix }_type"]`, 'none' );
		}
	},

	/**
	 * Update all fields state that are dependent in type field.
	 *
	 * @since 1.0.0
	 */
	onChangeTypeField() {
		this.eventListener( 'change', '.hvsfw-tooltip-field-type', function( e ) {
			const target = e.target;
			const type = target.value;
			const prefix = target.getAttribute( 'data-prefix' );
			if ( ! prefix || ! [ 'none', 'default', 'text', 'image', 'html' ].includes( type ) ) {
				return;
			}

			tooltipField.setToDefault( 'set', prefix );
			tooltipField.setAttribute( `[data-group-field="${ prefix }_content_${ type }"]`, 'data-visible', 'yes' );
		} );
	},
};

export default tooltipField;
