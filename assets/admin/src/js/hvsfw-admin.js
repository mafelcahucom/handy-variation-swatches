/**
 * Internal Dependencies.
 */
import {
	createTextFile,
	getFetch,
	getCheckboxValue,
	setText,
	setAttribute,
	eventListener,
} from '../../../helpers';

/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
'use strict';

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hvsfw = hvsfw || {};

/**
 * Toaster Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.toaster = {

	/**
	 * Show the toast.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params         Contains the parameters for popping toaster.
	 * @param {string} params.title   Contains the title of the toast.
	 * @param {string} params.content Contains the content or message of the toast.
	 */
	show( params ) {
		const parent = this;
		const toastComponent = this.alertToast( params );

		// Showing and appending to container.
		toastComponent.setAttribute( 'data-visibility', 'visible' );
		this.container().appendChild( toastComponent );

		// Hiding and removing element.
		setTimeout( function() {
			if ( toastComponent ) {
				parent.hide( toastComponent );
				parent.hideContainer();
			}
		}, 10000 );

		const closeToastEvent = toastComponent.querySelector( '.hd-toast__close-btn' );
		if ( closeToastEvent ) {
			closeToastEvent.addEventListener( 'click', function() {
				if ( toastComponent ) {
					parent.hide( toastComponent );
					parent.hideContainer();
				}
			} );
		}
	},

	/**
	 * Hide the toast component.
	 *
	 * @since 1.0.0
	 *
	 * @param {HTMLElement} toastComponent The current showed toast component.
	 */
	hide( toastComponent ) {
		toastComponent.setAttribute( 'data-visibility', 'hidden' );
		toastComponent.addEventListener( 'animationend', function() {
			toastComponent.remove();
		}, false );
	},

	/**
	 * Hide the toast container.
	 *
	 * @since 1.0.0
	 */
	hideContainer() {
		setTimeout( function() {
			if ( hvsfw.toaster.container().hasChildNodes() === false ) {
				hvsfw.toaster.container().remove();
			}
		}, 1000 );
	},

	/**
	 * Returns the new created toast component element.
	 *
	 * @param {Object} params         Contains the necessary parameters in rendering toast component.
	 * @param {string} params.title   Contains the title of the toast.
	 * @param {string} params.message Contains the content or message of the toast.
	 * @return {HTMLElement}  The alert toast component.
	 */
	alertToast( params ) {
		const messageToast = document.createElement( 'div' );
		messageToast.className = 'hd-toast';
		messageToast.innerHTML = `
        <div class="hd-toast__alert">
            <div class="hd-toast__detail">
                <div class="hd-toast__head">
                    <div class="hd-toast__info">
                        <div class="hd-toast__status hd-toast__status--${ params.color }"></div>
                        <strong class="hd-toast__title">${ params.title }</strong>
                    </div>
                    <button class="hd-toast__close-btn" title="close">
                        <svg class="hd-toast__close-btn__svg" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><path d='M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z'/></svg>
                    </button>
                </div>
                <div class="hd-toast__body">
                    <p class="hd-toast__message">${ params.content }</p>
                </div>
            </div>
        </div>`;

		return messageToast;
	},

	/**
	 * Render and append toast container in the main body element.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement}  Contains the toast main container.
	 */
	container() {
		let toastContainer = document.getElementById( 'hd-toast-container' );
		if ( ! toastContainer ) {
			const container = document.createElement( 'div' );
			container.setAttribute( 'id', 'hd-toast-container' );
			document.body.appendChild( container );
			toastContainer = container;
		}

		return toastContainer;
	},
};

/**
 * Prompt Components.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.prompt = {

	/**
	 * Show or hide screen loader, and also can set the title.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} visibility Contains the visibility state of the screen loader.
	 * @param {string} title      Contains the title or message of the screen loader.
	 */
	loader( visibility, title = 'Please Wait...' ) {
		if ( visibility ) {
			if ( visibility === 'visible' ) {
				setText.elem( '#hd-prompt-loader-title', title );
			}

			setAttribute.elem( '#hd-prompt-loader', 'data-state', visibility );
		}
	},

	/**
	 * Prompt Modal Dialog.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} args         Contains all the parameter for prompting a modal dialog.
	 * @param {string} args.title   Contains the title of the modal dialog.
	 * @param {string} args.message Contains the content or message of the modal dialog.
	 * @param {string} args.yes     Contains the yes button label.
	 * @param {string} args.no      contains the no button label.
	 * @return {Promise} The promise for users dialog result.
	 */
	dialog( args = {} ) {
		const prompt = document.getElementById( 'hd-prompt-dialog' );
		if ( ! prompt ) {
			return;
		}

		setText.elem( '#hd-prompt-dialog-title', ( args.title ? args.title : 'Title' ) );
		setText.elem( '#hd-prompt-dialog-message', ( args.message ? args.message : 'Message' ) );
		setText.elem( '#hd-prompt-dialog-no-btn', ( args.no ? args.no : 'No' ) );
		setText.elem( '#hd-prompt-dialog-yes-btn', ( args.yes ? args.yes : 'Yes' ) );
		setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'visible' );

		return new Promise( function( resolve ) {
			eventListener( 'click', '#hd-prompt-dialog-no-btn', function() {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );

			eventListener( 'click', '#hd-prompt-dialog-yes-btn', function() {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( true );
			} );

			eventListener( 'click', '#hd-prompt-dialog-close-btn', function() {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );
		} );
	},

	/**
	 * Prompts error message using toaster.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error Contains the error type or name.
	 */
	errorMessage( error ) {
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
				error: 'DB_QUERY_ERROR',
				title: 'Database Error',
				content: 'A database error occur. Please try again later or contact the plugin developer.',
			},
			{
				error: 'INVALID_FILE_TYPE',
				title: 'Invalid File Type',
				content: 'Invalid file type. Please make sure the file type is .txt.',
			},
			{
				error: 'CORRUPTED_SETTING_FILE',
				title: 'Corrupted Setting File',
				content: 'The setting text file is corrupted or missing data or containing an invalid data. Please check and try again.',
			},
			{
				error: 'ERROR_READING_FILE',
				title: 'Error Reading File',
				content: 'Error in reading the file. Please contact your developer and try again.',
			},
		];

		const errorDetail = errors.find( function( value ) {
			return ( value.error === error );
		} );

		if ( errorDetail ) {
			hvsfw.toaster.show( {
				color: 'danger',
				title: errorDetail.title,
				content: errorDetail.content,
			} );
		}
	},
};

/**
 * Header Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.header = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onAddScrollClass();
		this.onToggleNavigation();
	},

	/**
	 * On adding scroll class in body tag if the header is not visible.
	 *
	 * @since 1.0.0
	 */
	onAddScrollClass() {
		window.addEventListener( 'scroll', function() {
			const appElem = document.querySelector( '.hd-app' );
			const headerElem = document.querySelector( '.hd-header' );
			if ( appElem && headerElem ) {
				const offset = window.pageYOffset;
				const headerHeight = headerElem.offsetHeight;

				if ( offset > headerHeight ) {
					appElem.classList.add( 'scrolled' );
				} else {
					appElem.classList.remove( 'scrolled' );
				}
			}
		} );
	},

	/**
	 * Show & hide header navigation.
	 *
	 * @since 1.0.0
	 */
	onToggleNavigation() {
		eventListener( 'click', '#hd-navigation-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const navigationElem = document.getElementById( 'hd-header-navigation' );
			if ( navigationElem ) {
				const updatedState = ( state === 'default' ? 'active' : 'default' );
				const updatedLabel = ( state === 'default' ? 'Close Navigation' : 'Open Navigation' );
				target.setAttribute( 'data-state', updatedState );
				target.setAttribute( 'title', updatedLabel );
				target.setAttribute( 'aria-label', updatedLabel );
				navigationElem.setAttribute( 'data-state', updatedState );
			}
		} );
	},
};

/**
 * Tab Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.tab = {

	/**
	 * Holds the left position of the carousel.
	 *
	 * @since 1.0.0
	 *
	 * @type {number}
	 */
	left: 0,

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onUpdateTab();
		this.onToggleTab();
		this.onSlideTabNav();
	},

	/**
	 * Update the tab button and panel.
	 *
	 * @since 1.0.0
	 */
	onUpdateTab() {
		const tabBtnElems = document.querySelectorAll( '.hd-tab__nav__item-btn' );
		if ( tabBtnElems.length === 0 ) {
			return;
		}

		const hash = window.location.hash;
		if ( ! hash ) {
			const firstTabHash = tabBtnElems[ 0 ].getAttribute( 'data-target' );
			if ( firstTabHash ) {
				window.location.hash = firstTabHash;
			}
		}

		const updatedHash = window.location.hash;
		if ( ! updatedHash ) {
			return;
		}

		const currentTabPanelElem = document.querySelector( updatedHash );
		const currentTabBtnElem = document.querySelector( `.hd-tab__nav__item-btn[data-target="${ updatedHash }"]` );
		if ( currentTabPanelElem && currentTabBtnElem ) {
			setAttribute.elem( '.hd-placeholder', 'data-visibility', 'hidden' );
			
			setAttribute.elem( '.hd-tab__nav', 'data-visibility', 'visible' );

			setAttribute.elem( '.hd-tab__panel', 'data-state', 'default' );
			currentTabPanelElem.setAttribute( 'data-state', 'active' );

			setAttribute.elem( '.hd-tab__nav__item-btn', 'data-state', 'default' );
			currentTabBtnElem.setAttribute( 'data-state', 'active' );
		}
	},

	/**
	 * On toggle tab navigation.
	 *
	 * @since 1.0.0
	 */
	onToggleTab() {
		eventListener( 'click', '.hd-tab__nav__item-btn', function( e ) {
			const parent = hvsfw.tab;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const targetPanel = target.getAttribute( 'data-target' );
			if ( state === 'default' && targetPanel ) {
				window.location.hash = targetPanel;
				parent.onUpdateTab();
			}
		} );
	},

	/**
	 * On slide the tab navigation item.
	 *
	 * @since 1.0.0
	 */
	onSlideTabNav() {
		eventListener( 'click', '.hd-tab__nav__action-btn', function( e ) {
			const parent = hvsfw.tab;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const event = target.getAttribute( 'data-event' );
			const parentElem = target.closest( '.hd-tab__nav__container' );
			if ( state !== 'default' || ! [ 'prev', 'next' ].includes( event ) || ! parentElem ) {
				return;
			}

			const listElem = parentElem.querySelector( '.hd-tab__nav__list' );
			const prevBtnElem = parentElem.querySelector( '.hd-tab__nav__action-btn[data-event="prev"]' );
			const nextBtnElem = parentElem.querySelector( '.hd-tab__nav__action-btn[data-event="next"]' );
			if ( ! listElem || ! prevBtnElem || ! nextBtnElem ) {
				return;
			}

			const outerRec = parentElem.getBoundingClientRect();
			const rightPosition = ( ( listElem.scrollWidth + parent.left ) - outerRec.width );
			switch ( event ) {
				case 'prev':
					if ( parseInt( listElem.style.left ) < 0 ) {
						parent.left += 100;
						nextBtnElem.setAttribute( 'data-state', 'default' );
					}
					break;
				case 'next':
					if ( rightPosition > 0 ) {
						parent.left -= 100;
						prevBtnElem.setAttribute( 'data-state', 'default' );
					}
					break;
			}

			listElem.style.left = parent.left + 'px';
			if ( parseInt( listElem.style.left ) === 0 ) {
				listElem.style.left = '0px';
				prevBtnElem.setAttribute( 'data-state', 'disabled' );
			} else if ( rightPosition < 0 ) {
				listElem.style.left = `-${ listElem.scrollWidth - outerRec.width }`;
				nextBtnElem.setAttribute( 'data-state', 'disabled' );
			}
		} );
	},
};

/**
 * Card Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.card = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onToggle();
	},

	/**
	 * On toggle or collapse down and up card.
	 *
	 * @since 1.0.0
	 */
	onToggle() {
		eventListener( 'click', '.hd-card__header', function( e ) {
			const target = e.target;
			const parentElem = target.closest( '.hd-card' );
			const bodyElem = parentElem.querySelector( '.hd-card__body' );
			const state = parentElem.getAttribute( 'data-state' );
			if ( parentElem && bodyElem && [ 'opened', 'closed' ].includes( state ) ) {
				bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
				if ( state === 'opened' ) {
					setTimeout( function() {
						bodyElem.style.maxHeight = null;
					}, 300 );
					parentElem.setAttribute( 'data-state', 'closed' );
				} else {
					setTimeout( function() {
						bodyElem.style.maxHeight = 'max-content';
					}, 500 );
					parentElem.setAttribute( 'data-state', 'opened' );
				}
			}
		} );
	},
};

/**
 * Form Input Field Components.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.formField = {

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
		this.switchField.init();
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
};

/**
 * Setting Tab.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.setting = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.saveSettingFields();
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
				hvsfw.prompt.errorMessage( 'MISSING_DATA_ERROR' );
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
				hvsfw.prompt.errorMessage( 'MISSING_DATA_ERROR' );
				return;
			}

			target.setAttribute( 'data-state', 'loading' );

			const res = await getFetch( {
				nonce: hvsfwLocal.tab.setting.nonce.saveSettings,
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
				hvsfw.formField.hideAllErrors();

				// formField: Show all foeld error message.
				if ( result.totalInvalid > 0 ) {
					result.invalid.forEach( function( value ) {
						hvsfw.formField.showError( value.field, value.error );
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

				hvsfw.toaster.show( {
					color: alert.color,
					title: alert.title,
					content: alert.content,
				} );
			} else {
				hvsfw.prompt.errorMessage( res.data.error );
			}

			target.setAttribute( 'data-state', 'default' );
		} );
	},
};

/**
 * Importer & Exporter Tab.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.importerExporter = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.import.init();
		this.export.init();
	},

	/**
	 * Import Component.
	 *
	 * @since 1.0.0
	 */
	import: {

		/**
		 * Initialize Import.
		 *
		 * @since 1.0.0
		 */
		init() {
			this.onImportSetting();
			this.onSelectFile();
		},

		/**
		 * Import settings to wp_options, upload the text file containing
		 * the encrypted settings.
		 *
		 * @since 1.0.0
		 */
		onImportSetting() {
			eventListener( 'click', '#hd-import-setting-file-btn', async function( e ) {
				const target = e.target;
				const state = target.getAttribute( 'data-state' );
				const fileUploaderElem = document.querySelector( '.hd-file-field__input' );
				if ( state !== 'default' ) {
					return;
				}

				const files = fileUploaderElem.files;
				if ( files.length === 0 ) {
					return;
				}

				const isContinueImporting = await hvsfw.prompt.dialog( {
					title: 'Import Settings',
					message: 'Are you sure you want to import settings? This process will override the current settings and cannot be undone.',
					yes: 'Continue',
					no: 'Cancel',
				} );

				if ( isContinueImporting === false ) {
					return;
				}

				const file = files[ 0 ];
				if ( file.type !== 'text/plain' ) {
					hvsfw.prompt.errorMessage( 'INVALID_FILE_TYPE' );
					return;
				}

				const reader = new FileReader();
				reader.readAsText( file );
				reader.onload = async function() {
					hvsfw.prompt.loader( 'visible', 'Importing Settings...' );
					target.setAttribute( 'data-state', 'loading' );

					const fileContent = reader.result;
					const res = await getFetch( {
						nonce: hvsfwLocal.tab.importerExporter.nonce.importSettings,
						action: 'hvsfw_import_settings',
						settings: fileContent,
					} );

					if ( res.success === true ) {
						hvsfw.toaster.show( {
							color: 'success',
							title: 'Successfully Imported',
							content: 'Variation swatches settings has successfully imported.',
						} );
					} else {
						hvsfw.prompt.errorMessage( res.data.error );
					}

					hvsfw.prompt.loader( 'hide' );
					target.setAttribute( 'data-state', 'default' );
				};

				reader.onerror = function() {
					hvsfw.prompt.errorMessage( 'ERROR_READING_FILE' );
				};
			} );
		},

		/**
		 * On selecting a setting .txt file, update import button state.
		 *
		 * @since 1.0.0
		 */
		onSelectFile() {
			eventListener( 'change', '.hd-file-field__input', function( e ) {
				const target = e.target;
				const files = target.files;
				const parentElem = target.closest( '.hd-file-field' );
				const labelElem = parentElem.querySelector( '.hd-file-field__label' );
				if ( files.length > 0 && parentElem && labelElem ) {
					labelElem.textContent = files[ 0 ].name;
					setAttribute.elem( '#hd-import-setting-file-btn', 'data-state', 'default' );
				}
			} );
		},
	},

	/**
	 * Export Component.
	 *
	 * @since 1.0.0
	 */
	export: {

		/**
		 * Initialize Export.
		 *
		 * @since 1.0.0
		 */
		init() {
			this.onExportSetting();
			this.onListenCheckbox();
			this.onListenExportAllCheckbox();
		},

		/**
		 * Export settings from wp_options and also create a text file
		 * containing all the settings.
		 *
		 * @since 1.0.0
		 */
		onExportSetting() {
			eventListener( 'click', '#hd-export-setting-file-btn', async function( e ) {
				const target = e.target;
				const state = target.getAttribute( 'data-state' );
				const groups = getCheckboxValue( '.hd-export-setting-checkbox' );
				if ( state !== 'default' || groups.length === 0 ) {
					return;
				}

				// Return the filename with prefix.
				const getFilename = function() {
					const date = new Date();
					return `HVSFW-DUPLICATE-SETTINGS-${ date.getFullYear() }-${ date.getDate() }-${ date.getMonth() + 1 }.txt`;
				};

				hvsfw.prompt.loader( 'visible', 'Exporting Settings...' );
				target.setAttribute( 'data-state', 'loading' );

				const res = await getFetch( {
					nonce: hvsfwLocal.tab.importerExporter.nonce.exportSettings,
					action: 'hvsfw_export_settings',
					groups,
				} );

				if ( res.success === true ) {
					createTextFile( getFilename(), res.data.settings );
					hvsfw.toaster.show( {
						color: 'success',
						title: 'Successfully Exported',
						content: 'Variation swatches settings has successfully exported.',
					} );
				} else {
					hvsfw.prompt.errorMessage( res.data.error );
				}

				hvsfw.prompt.loader( 'hide' );
				target.setAttribute( 'data-state', 'default' );
			} );
		},

		/**
		 * On listen all checkbox state.
		 *
		 * @since 1.0.0
		 */
		onListenCheckbox() {
			eventListener( 'change', '.hd-export-setting-checkbox', function( e ) {
				const target = e.target;
				const value = target.value;
				if ( value.length === 0 ) {
					return;
				}

				// Update the state of export button.
				setTimeout( function() {
					const checkedCheckboxElems = document.querySelectorAll( '.hd-export-setting-checkbox:checked' );
					setAttribute.elem( '#hd-export-setting-file-btn', 'data-state', ( checkedCheckboxElems.length > 0 ? 'default' : 'disabled' ) );
				}, 300 );

				// Update export all checkbox check state based on child checkboxes.
				if ( value !== 'ALL' ) {
					const exportAllCheckboxElem = document.querySelector( '.hd-export-setting-checkbox[value="ALL"]' );
					const unCheckedCheckboxElems = document.querySelectorAll( '.hd-export-setting-checkbox:not([value="ALL"]):not(:checked)' );
					if ( exportAllCheckboxElem ) {
						const parentElem = exportAllCheckboxElem.closest( '.hd-checkbox-field' );
						if ( parentElem ) {
							parentElem.setAttribute( 'data-state', ( unCheckedCheckboxElems.length > 0 ? 'default' : 'active' ) );
						}

						exportAllCheckboxElem.checked = ( unCheckedCheckboxElems.length > 0 ? false : true );
					}
				}
			} );
		},

		/**
		 * On listen export all checkbox state.
		 *
		 * @since 1.0.0
		 */
		onListenExportAllCheckbox() {
			eventListener( 'change', '.hd-export-setting-checkbox[value="ALL"]', function( e ) {
				const target = e.target;
				const checkboxElems = document.querySelectorAll( '.hd-export-setting-checkbox:not([value="ALL"])' );
				if ( checkboxElems.length > 0 ) {
					checkboxElems.forEach( function( checkboxElem ) {
						const parentElem = checkboxElem.closest( '.hd-checkbox-field' );
						if ( parentElem ) {
							parentElem.setAttribute( 'data-state', ( target.checked ? 'active' : 'default' ) );
						}

						checkboxElem.checked = ( target.checked ? true : false );
					} );
				}
			} );
		},
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

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute( function() {
	Object.entries( hvsfw ).forEach( function( fragment ) {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );