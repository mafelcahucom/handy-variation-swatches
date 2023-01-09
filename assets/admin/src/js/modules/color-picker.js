/**
 * Color Picker Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const colorPicker = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.setColorPicker();
		this.addNewField();
		this.deleteField();
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
	 * Set the color picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} action The type of action.
	 * @param {Object} parent The parent element.
	 */
	setColorPicker( action = 'set', parent ) {
		const selector = '.hvsfw-color-picker__input';
		let inputElems = document.querySelectorAll( selector );
		if ( parent ) {
			inputElems = parent.querySelectorAll( selector );
		}

		if ( inputElems.length === 0 ) {
			return;
		}

		inputElems.forEach( function( inputElem ) {
			jQuery( inputElem ).wpColorPicker();

			if ( action === 'reset' ) {
				jQuery( inputElem ).iris( 'color', '#ffffff' );
			}
		} );
	},

	/**
	 * Set the count of items.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The parent element.
	 */
	setCount( parent ) {
		if ( ! parent ) {
			return;
		}

		const listElem = parent.querySelector( '.hvsfw-color-picker__list' );
		if ( listElem ) {
			parent.setAttribute( 'data-count', listElem.childElementCount );
		}
	},

	/**
	 * Set to default or reset color swatch picker.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent The color picker parent element.
	 */
	setToDefault( parent ) {
		let colorPickerElems = Array.from( document.querySelectorAll( '.hvsfw-color-picker' ) );
		colorPickerElems = ( parent ? [ parent ] : colorPickerElems );
		if ( colorPickerElems.length === 0 ) {
			return;
		}

		colorPickerElems.forEach( function( colorPickerElem ) {
			const itemElems = colorPickerElem.querySelectorAll( '.hvsfw-color-picker__item' );
			if ( itemElems.length > 1 ) {
				itemElems.forEach( function( itemElem, index ) {
					if ( index !== 0 ) {
						itemElem.remove();
					}
				} );
			}

			colorPicker.setCount( colorPickerElem );
			colorPicker.setColorPicker( 'reset', colorPickerElem );
		} );
	},

	/**
	 * Returns the new created color picker component element.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} name The input name.
	 * @return {HTMLElement} The new color picker field.
	 */
	field( name ) {
		if ( ! name ) {
			return;
		}

		const element = document.createElement( 'div' );
		element.className = 'hvsfw-color-picker__item';
		element.innerHTML = `
            <div class="hvsfw-col__left">
                <input type="hidden" name="${ name }" class="hvsfw-color-picker__input" value="#ffffff">
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
		this.eventListener( 'click', '.hvsfw-js-color-picker-add-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const parentElem = target.closest( '.hvsfw-color-picker' );
			if ( ! parentElem ) {
				return;
			}

			const listElem = parentElem.querySelector( '.hvsfw-color-picker__list' );
			if ( ! listElem ) {
				return;
			}

			const firstInputElem = listElem.querySelector( '.hvsfw-color-picker__input' );
			if ( ! firstInputElem ) {
				return;
			}

			const inputName = firstInputElem.getAttribute( 'name' );
			if ( ! inputName ) {
				return;
			}

			const newColorPickerField = colorPicker.field( inputName );
			if ( newColorPickerField ) {
				listElem.appendChild( newColorPickerField );

				colorPicker.setColorPicker( 'set', parentElem );
				colorPicker.setCount( parentElem );
			}
		} );
	},

	/**
	 * Delete a center color picker field.
	 *
	 * @since 1.0.0
	 */
	deleteField() {
		this.eventListener( 'click', '.hvsfw-js-color-picker-delete-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const parentElem = target.closest( '.hvsfw-color-picker' );
			const itemElem = target.closest( '.hvsfw-color-picker__item' );
			if ( parentElem && itemElem ) {
				itemElem.remove();
				colorPicker.setCount( parentElem );
			}
		} );
	},
};

export default colorPicker;
