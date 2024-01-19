/**
 * Internal Dependencies.
 */
import {
	setAttribute,
	setValue,
	eventListener,
} from '../../../../helpers';

/**
 * Internal Modules.
 */
import imagePickerModule from './image-picker.js';

/**
 * Tooltio Field Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
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
	 * Set to default or reset tooltip form.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} action Contains the type of action.
	 * @param {string} prefix Contains the prefix of the field.
	 */
	setToDefault( action = 'set', prefix ) {
		if ( action && prefix ) {
			const imagePickerElem = document.getElementById( `${ prefix }_content_image` );
			if ( imagePickerElem ) {
				imagePickerModule.setToDefault( imagePickerElem );
			}

			setValue.elem( `[id="${ prefix }_content_text"]`, '' );
			setValue.elem( `[id="${ prefix }_content_html"]`, '' );

			setAttribute.elem( `[data-group-field="${ prefix }_content_text"]`, 'data-visible', 'no' );
			setAttribute.elem( `[data-group-field="${ prefix }_content_html"]`, 'data-visible', 'no' );
			setAttribute.elem( `[data-group-field="${ prefix }_content_image"]`, 'data-visible', 'no' );

			if ( action === 'reset' ) {
				setValue.elem( `[id="${ prefix }_type"]`, 'none' );
			}
		}
	},

	/**
	 * Update all fields state that are dependent in type field.
	 *
	 * @since 1.0.0
	 */
	onChangeTypeField() {
		eventListener( 'change', '.hvsfw-tooltip-field-type', function( e ) {
			const target = e.target;
			const type = target.value;
			const prefix = target.getAttribute( 'data-prefix' );
			if ( prefix && [ 'none', 'default', 'text', 'image', 'html' ].includes( type ) ) {
				tooltipField.setToDefault( 'set', prefix );
				setAttribute.elem( `[data-group-field="${ prefix }_content_${ type }"]`, 'data-visible', 'yes' );
			}
		} );
	},
};

export default tooltipField;
