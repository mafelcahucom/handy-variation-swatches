/**
 * Internal Dependencies.
 */
import {
	getFetch,
	setAttribute,
	eventListener,
} from '../../../../helpers';

/**
 * Internal Components.
 */
import prompt from '../component/prompt';
import toaster from '../component/toaster';

/**
 * Setting Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const setting = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.formField.init();
		this.saveSettingFields();
	},

	/**
	 * Form Fields.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	formField: {

		/**
		 * Initialize.
		 *
		 * @since 1.0.0
		 */
		init() {
			this.checkboxField.init();
			this.colorPickerField.init();
			this.iconPickerField.init();
			this.loaderPickerField.init();
			this.sortableField.init();
			this.switchField.init();
			this.taggingField.init();
		},

		/**
		 * Show the error message on specific field.
		 *
		 * @since 1.0.0
		 *
		 * @param {string} fieldName    Contains the name of the field.
		 * @param {string} errorMessage Contains the error message to be printend.
		 */
		showError( fieldName, errorMessage ) {
			if ( fieldName && errorMessage ) {
				const formFieldElem = document.getElementById( `hd-form-field-${ fieldName }` );
				const errorMessageElem = formFieldElem.querySelector( '.hd-form-field__error' );
				if ( formFieldElem && errorMessageElem ) {
					errorMessageElem.textContent = errorMessage;
					formFieldElem.setAttribute( 'data-has-error', '1' );
				}
			}
		},

		/**
		 * Hide all error mesasge in all field.
		 *
		 * @since 1.0.0
		 */
		hideAllErrors() {
			const formFieldElems = document.querySelectorAll( '.hd-form-field[data-has-error="1"]' );
			if ( formFieldElems.length > 0 ) {
				formFieldElems.forEach( function( formFieldElem ) {
					formFieldElem.setAttribute( 'data-has-error', '0' );
				} );
			}
		},

		/**
		 * Checkbox Field.
		 *
		 * @since 1.0.0
		 */
		checkboxField: {

			/**
			 * Initialize Checkbox.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onListenChecked();
			},

			/**
			 * On listen checkbox check state.
			 *
			 * @since 1.0.0
			 */
			onListenChecked() {
				eventListener( 'change', '.hd-checkbox-field__input', function( e ) {
					const target = e.target;
					const parentElem = target.closest( '.hd-checkbox-field' );
					if ( parentElem ) {
						parentElem.setAttribute( 'data-state', ( target.checked ? 'active' : 'default' ) );
					}
				} );
			},
		},

		/**
		 * Color Picker Field.
		 *
		 * @since 1.0.0
		 */
		colorPickerField: {

			/**
			 * Initialize Color Picker.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onSelectColor();
			},

			/**
			 * On selecting or modify color.
			 *
			 * @since 1.0.0
			 */
			onSelectColor() {
				const colorPickerElems = document.querySelectorAll( '.hd-color-picker-field__btn' );
				if ( ! colorPickerElems ) {
					return;
				}

				colorPickerElems.forEach( function( colorPickerElem ) {
					const colorPicker = Pickr.create( {
						el: colorPickerElem,
						theme: 'nano',
						appClass: 'hd-prc',
						position: 'bottom-end',
						useAsButton: true,
						default: colorPickerElem.getAttribute( 'data-value' ),
						swatches: [
							'rgba(244,67,54,1)',
							'rgba(233,30,99,1)',
							'rgba(156,39,176,1)',
							'rgba(103,58,183,1)',
							'rgba(63,81,181,1)',
							'rgba(33,150,243,1)',
							'rgba(3,169,244,1)',
							'rgba(0,188,212,1)',
							'rgba(0,150,136,1)',
							'rgba(76,175,80,1)',
							'rgba(139,195,74,1)',
							'rgba(205,220,57,1)',
							'rgba(255,235,59,1)',
							'rgba(255,193,7,1)',
						],
						components: {
							preview: true,
							opacity: true,
							hue: true,
							interaction: {
								input: true,
								save: true,
							},
						},
					} );

					colorPicker.on( 'save', function( color ) {
						const colorLabelElem = colorPickerElem.nextElementSibling;
						const inputId = colorPickerElem.getAttribute( 'data-input' );
						if ( inputId ) {
							const inputElem = document.getElementById( inputId );
							if ( inputElem ) {
								const rgbaDigit = color.toRGBA().map( function( digit, index ) {
									return ( index < 3 ? Math.round( digit ) : digit );
								} );

								const rgbaColor = `rgba(${ rgbaDigit.toString() })`;
								inputElem.value = rgbaColor;
								colorLabelElem.textContent = color.toHEXA().toString();
								colorPickerElem.style.backgroundColor = color.toHEXA().toString();
							}
						}
					} );
				} );
			},
		},

		/**
		 * Icon Picker Field.
		 *
		 * @since 1.0.0
		 */
		iconPickerField: {

			/**
			 * Initialize Icon Picker.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onSelectItem();
				this.onPaginate();
			},

			/**
			 * Update state on selecting an item icon.
			 *
			 * @since 1.0.0
			 */
			onSelectItem() {
				eventListener( 'click', '.hd-icon-picker-field__item', function( e ) {
					const target = e.target;
					const state = target.getAttribute( 'data-state' );
					const value = target.getAttribute( 'data-value' );
					const inputId = target.getAttribute( 'data-input' );
					if ( state === 'default' && value && inputId ) {
						const inputElem = document.getElementById( inputId );
						if ( inputId ) {
							inputElem.value = value;
							setAttribute.elem( `.hd-icon-picker-field__item[data-input="${ inputId }"]`, 'data-state', 'default' );
							target.setAttribute( 'data-state', 'active' );
						}
					}
				} );
			},

			/**
			 * Paginate or collapse icon items.
			 *
			 * @since 1.0.0
			 */
			onPaginate() {
				eventListener( 'click', '.hd-icon-picker-field__pagination', function( e ) {
					const target = e.target;
					const event = target.getAttribute( 'data-event' );
					const parentElem = target.closest( '.hd-icon-picker-field' );
					if ( parentElem && [ 'more', 'less' ].includes( event ) ) {
						let itemElems = parentElem.querySelectorAll( '.hd-icon-picker-field__item' );
						if ( itemElems.length > 0 ) {
							target.textContent = ( event === 'more' ? 'Show Less' : 'Show More' );
							target.setAttribute( 'data-event', ( event === 'more' ? 'less' : 'more' ) );

							itemElems = [ ...itemElems ].splice( 10, itemElems.length );
							itemElems.forEach( function( itemElem ) {
								itemElem.setAttribute( 'data-visibility', ( event === 'more' ? 'visible' : 'hidden' ) );
							} );
						}
					}
				} );
			},
		},

		/**
		 * Loader Picker Field.
		 */
		loaderPickerField: {

			/**
			 * Initialize Loader Picker.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onSelectItem();
				this.onPaginate();
			},

			/**
			 * Update state on selecting an item loader.
			 *
			 * @since 1.0.0
			 */
			onSelectItem() {
				eventListener( 'click', '.hd-loader-picker-field__item', function( e ) {
					const target = e.target;
					const state = target.getAttribute( 'data-state' );
					const value = target.getAttribute( 'data-value' );
					const inputId = target.getAttribute( 'data-input' );
					if ( state === 'default' && value && inputId ) {
						const inputElem = document.getElementById( inputId );
						if ( inputId ) {
							inputElem.value = value;
							setAttribute.elem( `.hd-loader-picker-field__item[data-input="${ inputId }"]`, 'data-state', 'default' );
							target.setAttribute( 'data-state', 'active' );
						}
					}
				} );
			},

			/**
			 * Paginate or collapse loader items.
			 *
			 * @since 1.0.0
			 */
			onPaginate() {
				eventListener( 'click', '.hd-loader-picker-field__pagination', function( e ) {
					const target = e.target;
					const event = target.getAttribute( 'data-event' );
					const parentElem = target.closest( '.hd-loader-picker-field' );
					if ( parentElem && [ 'more', 'less' ].includes( event ) ) {
						let itemElems = parentElem.querySelectorAll( '.hd-loader-picker-field__item' );
						if ( itemElems.length > 0 ) {
							target.textContent = ( event === 'more' ? 'Show Less' : 'Show More' );
							target.setAttribute( 'data-event', ( event === 'more' ? 'less' : 'more' ) );

							itemElems = [ ...itemElems ].splice( 10, itemElems.length );
							itemElems.forEach( function( itemElem ) {
								itemElem.setAttribute( 'data-visibility', ( event === 'more' ? 'visible' : 'hidden' ) );
							} );
						}
					}
				} );
			},
		},

		/**
		 * Sortable Field.
		 *
		 * @since 1.0.0
		 */
		sortableField: {

			/**
			 * Initialize Sortable Field.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onSort();
			},

			/**
			 * On sort and update input field value.
			 *
			 * @since 1.0.0
			 */
			onSort() {
				const sortableElems = document.querySelectorAll( '.hd-sortable-field' );
				if ( sortableElems.length > 0 ) {
					sortableElems.forEach( function( sortableElem ) {
						const inputId = sortableElem.getAttribute( 'data-input' );
						const inputElem = document.getElementById( inputId );
						if ( inputElem ) {
							Sortable.create( sortableElem, {
								animation: 150,
								easing: 'cubic-bezier(1, 0, 0, 1)',
								onChange() {
									setTimeout( function() {
										const itemElems = sortableElem.querySelectorAll( '.hd-sortable-field__item' );
										if ( itemElems.length > 0 ) {
											const order = Array.from( itemElems ).map( function( itemElem ) {
												return itemElem.getAttribute( 'data-value' );
											} );

											if ( order.length > 0 ) {
												inputElem.value = order;
											}
										}
									}, 500 );
								},
							} );
						}
					} );
				}
			},
		},

		/**
		 * Switch Field.
		 *
		 * @since 1.0.0
		 */
		switchField: {

			/**
			 * Initialize Switch Field.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onToggle();
			},

			/**
			 * Update switch buttons state on toggle.
			 *
			 * @since 1.0.0
			 */
			onToggle() {
				eventListener( 'click', '.hd-switch-field__btn', function( e ) {
					const target = e.target;
					const name = target.getAttribute( 'data-name' );
					const type = target.getAttribute( 'data-type' );
					const state = target.getAttribute( 'data-state' );
					const inputElem = document.getElementById( name );
					if ( inputElem && state === 'default' && [ 'on', 'off' ].includes( type ) ) {
						inputElem.value = ( type === 'on' ? 1 : 0 );

						const btnElems = document.querySelectorAll( `.hd-switch-field__btn[data-name="${ name }"]` );
						if ( btnElems.length > 0 ) {
							btnElems.forEach( function( btnElem ) {
								const btnType = btnElem.getAttribute( 'data-type' );
								btnElem.setAttribute( 'data-state', ( type === btnType ? 'active' : 'default' ) );
							} );
						}
					}
				} );
			},
		},

		/**
		 * Tagging Field.
		 *
		 * @since 1.0.0
		 */
		taggingField: {

			/**
			 * Initialize Field.
			 *
			 * @since 1.0.0
			 */
			init() {
				this.onSelect();
			},

			/**
			 * On select items and update input field value.
			 *
			 * @since 1.0.0
			 */
			onSelect() {
				jQuery( '.hd-tagging-field' ).each( function( index, element ) {
					const select = jQuery( this ).selectize( {
						plugins: [ 'remove_button' ],
						delimiter: ',',
						persist: false,
						onChange( value ) {
							const inputId = jQuery( element ).data( 'input' );
							const inputElem = document.getElementById( inputId );
							if ( inputElem ) {
								inputElem.value = ( value.length > 0 ? value.join( ',' ) : '' );
							}

							jQuery( this ).trigger( 'change' );
						},
					} );

					const value = this.getAttribute( 'value' );
					let splittedValue = [];
					if ( value.length > 0 ) {
						splittedValue = value.split( ',' );
					}

					if ( splittedValue.length > 0 ) {
						const selectize = select[ 0 ].selectize;
						selectize.setValue( splittedValue );
					}
				} );
			},
		},
	},

	/**
	 * Save all fields in setting tab.
	 *
	 * @since 1.0.0
	 */
	saveSettingFields() {
		eventListener( 'click', '.hd-save-setting-btn', async function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const targetGroup = target.getAttribute( 'data-group-target' );
			if ( state !== 'default' || ! targetGroup ) {
				return;
			}

			const inputElems = document.querySelectorAll( `[data-input-group="${ targetGroup }"]` );
			if ( inputElems.length === 0 ) {
				prompt.errorMessage( 'MISSING_DATA_ERROR' );
				return;
			}

			const fields = new Object();
			inputElems.forEach( function( input ) {
				const name = input.getAttribute( 'name' );
				if ( name ) {
					fields[ name ] = input.value;
				}
			} );

			if ( Object.keys( fields ).length === 0 ) {
				prompt.errorMessage( 'MISSING_DATA_ERROR' );
				return;
			}

			target.setAttribute( 'data-state', 'loading' );

			const res = await getFetch( {
				nonce: hvsfwLocal.module.setting.nonce.saveSettings,
				action: 'hvsfw_save_settings',
				fields: JSON.stringify( fields ),
			} );

			if ( res.success === true ) {
				const result = {
					valid: res.data.validation.valid,
					totalValid: res.data.validation.valid.length,
					invalid: res.data.validation.invalid,
					totalInvalid: res.data.validation.invalid.length,
				};

				// formField: Hide all field error message.
				setting.formField.hideAllErrors();

				// formField: Show all foeld error message.
				if ( result.totalInvalid > 0 ) {
					result.invalid.forEach( function( value ) {
						setting.formField.showError( value.field, value.error );
					} );
				}

				// Prompt success or error message.
				const alert = {};
				if ( result.totalValid > 0 ) {
					alert.color = 'success';
					alert.title = 'Successfully Saved';
					alert.content = 'All fields has been successfully saved.';
					if ( result.totalInvalid > 0 ) {
						alert.content = `A total of ${ result.totalValid } fields has been successfully saved. And a total of ${ result.totalInvalid } fields has been failed because of some requirements did not meet.`;
					}
				} else {
					alert.color = 'danger';
					alert.title = 'Saving Failed';
					alert.content = 'All fields has been failed to save because of some requirements did not meet.';
				}

				toaster.show( {
					color: alert.color,
					title: alert.title,
					content: alert.content,
				} );
			} else {
				prompt.errorMessage( res.data.error );
			}

			target.setAttribute( 'data-state', 'default' );
		} );
	},
};

export default setting;
