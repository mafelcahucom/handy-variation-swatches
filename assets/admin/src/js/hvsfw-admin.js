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
	 * Fetch handler.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params Containing the parameters.
	 * @return {Object} Fetch response
	 */
	async fetch( params ) {
		let result = {
			success: false,
			data: {
				error: 'NETWORK_ERROR',
			},
		};

		if ( this.isObjectEmpty( params ) ) {
			result.data.error = 'MISSING_DATA_ERROR';
			return result;
		}

		try {
			const response = await fetch( hvsfwLocal.url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: new URLSearchParams( params ),
			} );

			if ( response.ok ) {
				result = await response.json();
				console.log( result );
			}
		} catch ( e ) {
			console.log( 'error', e );
		}

		return result;
	},

	/**
	 * Checks if the object is empty.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object The object to be checked.
	 * @return {boolean} Whether has empty key.
	 */
	isObjectEmpty( object ) {
		return Object.keys( object ).length === 0;
	},

	/**
	 * Set the text of an element based on selector.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector The target element selector.
	 * @param {string} text     The text to be inserted in the element.
	 */
	setText( selector, text ) {
		if ( ! selector || ! text ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.textContent = text;
			} );
		}
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
	 * Create a text file from the text of the appended element.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} filename Will be used as name for the .txt file.
	 * @param {string} content  The content of the .txt file.
	 */
	createTextFile( filename, content ) {
		if ( ! filename || ! content ) {
			return;
		}

		const element = document.createElement( 'a' );
		element.setAttribute( 'href', 'data:text/plain;charset=utf-8,' + encodeURIComponent( content ) );
		element.setAttribute( 'download', filename );
		element.style.display = 'none';
		document.body.appendChild( element );
		element.click();
		document.body.removeChild( element );
	},
};

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
	 * @param {Object} params         Contains the necessary parameters.
	 * @param {string} params.title   The title of the toast.
	 * @param {string} params.content The message of the toast.
	 */
	show( params ) {
		// initialize class
		const parent = this;
		const toastComponent = this.alertToast( params );

		// showing and appending to container
		toastComponent.setAttribute( 'data-visibility', 'visible' );
		this.container().appendChild( toastComponent );

		// hiding and removing element
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
	 * @param {string} params.title   The title of the toast.
	 * @param {string} params.message The message of the toast.
	 * @return {HTMLElement}  Alert toast component.
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
                    <p class="hd-toast__p">${ params.content }</p>
                </div>
            </div>
        </div>
        `;
		return messageToast;
	},

	/**
	 * Render and append toast container in the main body element.
	 *
	 * @since 1.0.0
	 *
	 * @return {HTMLElement}  Toast main container.
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
	 * @param {string} visibility The visibility state of the screen loader.
	 * @param {strong} title      The title or message of the screen loader.
	 */
	loader( visibility, title = 'Please Wait...' ) {
		if ( ! visibility ) {
			return;
		}

		if ( visibility === 'visible' ) {
			hvsfw.fn.setText( '#hd-js-prompt-loader-title', title );
		}
		hvsfw.fn.setAttribute( '#hd-js-prompt-loader', 'data-state', visibility );
	},

	/**
	 * Prompt Modal Dialog.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} args         Contains all the parameters for showing modal dialog.
	 * @param {string} args.title   The title of the modal dialog.
	 * @param {string} args.message The message of the modal dialog.
	 * @param {string} args.yes     The yes button label.
	 * @param {string} args.no      The no button label.
	 * @return {Promise}
	 */
	dialog( args = {} ) {
		const prompt = document.getElementById( 'hd-js-prompt-dialog' );
		if ( ! prompt ) {
			return;
		}

		hvsfw.fn.setText( '#hd-js-prompt-dialog-title', ( args.title ? args.title : 'Title' ) );
		hvsfw.fn.setText( '#hd-js-prompt-dialog-message', ( args.message ? args.message : 'Message' ) );
		hvsfw.fn.setText( '#hd-js-prompt-dialog-no-btn', ( args.no ? args.no : 'No' ) );
		hvsfw.fn.setText( '#hd-js-prompt-dialog-yes-btn', ( args.yes ? args.yes : 'Yes' ) );
		hvsfw.fn.setAttribute( '#hd-js-prompt-dialog', 'data-state', 'visible' );

		return new Promise( function( resolve, reject ) {
			hvsfw.fn.eventListener( 'click', '#hd-js-prompt-dialog-no-btn', function( e ) {
				hvsfw.fn.setAttribute( '#hd-js-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );

			hvsfw.fn.eventListener( 'click', '#hd-js-prompt-dialog-yes-btn', function( e ) {
				hvsfw.fn.setAttribute( '#hd-js-prompt-dialog', 'data-state', 'hide' );
				resolve( true );
			} );

			hvsfw.fn.eventListener( 'click', '#hd-js-prompt-dialog-close-btn', function( e ) {
				hvsfw.fn.setAttribute( '#hd-js-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );
		} );
	},

	/**
	 * Prompts error message using toaster.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error The error name.
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
		this.toggleNavigation();
	},

	/**
	 * Show & hide header navigation.
	 *
	 * @since 1.0.0
	 */
	toggleNavigation() {
		hvsfw.fn.eventListener( 'click', '#hd-js-toggle-header-navigation-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const navigationElem = document.getElementById( 'hd-js-header-navigation' );
			if ( ! navigationElem ) {
				return;
			}

			const updatedState = ( state === 'default' ? 'active' : 'default' );
			const updatedLabel = ( state === 'default' ? 'Close Navigation' : 'Open Navigation' );
			target.setAttribute( 'data-state', updatedState );
			target.setAttribute( 'title', updatedLabel );
			target.setAttribute( 'aria-label', updatedLabel );
			navigationElem.setAttribute( 'data-state', updatedState );
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
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.updateTab();
		this.toggleTab();
	},

	/**
	 * Update the tab button and panel.
	 *
	 * @since 1.0.0
	 */
	updateTab() {
		const tabBtnElems = document.querySelectorAll( '.hd-tab__btn' );
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
		const currentTabBtnElem = document.querySelector( `.hd-tab__btn[data-target="${ updatedHash }"]` );
		if ( ! currentTabPanelElem || ! currentTabBtnElem ) {
			return;
		}

		hvsfw.fn.setAttribute( '.hd-tab__panel', 'data-state', 'default' );
		currentTabPanelElem.setAttribute( 'data-state', 'active' );

		hvsfw.fn.setAttribute( '.hd-tab__btn', 'data-state', 'default' );
		currentTabBtnElem.setAttribute( 'data-state', 'active' );
	},

	/**
	 * Toggle tab.
	 *
	 * @since 1.0.0
	 */
	toggleTab() {
		hvsfw.fn.eventListener( 'click', '.hd-js-tab-btn', function( e ) {
			const parent = hvsfw.tab;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const targetPanel = target.getAttribute( 'data-target' );
			if ( state !== 'default' || ! targetPanel ) {
				return;
			}

			window.location.hash = targetPanel;
			parent.updateTab();
		} );
	},
};

/**
 * Carousel Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.carousel = {

	/**
	 * Holds the number left position.
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
		this.slide();
	},

	/**
	 * Slide the carousel.
	 *
	 * @since 1.0.0
	 */
	slide() {
		hvsfw.fn.eventListener( 'click', '.hd-js-carousel-btn', function( e ) {
			const parent = hvsfw.carousel;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const event = target.getAttribute( 'data-event' );
			const parentElem = target.closest( '.hd-carousel' );
			if ( state !== 'default' || ! [ 'prev', 'next' ].includes( event ) || ! parentElem ) {
				return;
			}

			const listElem = parentElem.querySelector( '.hd-carousel__list' );
			const prevBtnElem = parentElem.querySelector( '.hd-carousel__btn[data-event="prev"]' );
			const nextBtnElem = parentElem.querySelector( '.hd-carousel__btn[data-event="next"]' );
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
		this.switchField();
		this.colorPickerField();
		this.iconPickerField();
		this.imagePickerField();
		this.loaderPickerField();
		this.fileField();
	},

	/**
	 * Show the error message on specific field.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} fieldName    The name of the field.
	 * @param {string} errorMessage The error message to be printend.
	 */
	showError( fieldName, errorMessage ) {
		if ( ! fieldName || ! errorMessage ) {
			return;
		}

		const formFieldElem = document.getElementById( `hd-form-field-${ fieldName }` );
		const errorMessageElem = formFieldElem.querySelector( '.hd-form-field__error' );
		if ( formFieldElem && errorMessageElem ) {
			errorMessageElem.textContent = errorMessage;
			formFieldElem.setAttribute( 'data-has-error', '1' );
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
	 * Switch Field.
	 *
	 * @since 1.0.0
	 */
	switchField() {
		hvsfw.fn.eventListener( 'change', '.hd-js-switch-field', function( e ) {
			const target = e.target;
			target.setAttribute( 'value', ( target.checked === true ? 1 : 0 ) );
		} );
	},

	/**
	 * Color Picker Field.
	 *
	 * @since 1.0.0
	 */
	colorPickerField() {
		const colorPickerElems = document.querySelectorAll( '.hd-js-color-picker-btn' );
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
				if ( ! inputId ) {
					return;
				}

				const inputElem = document.getElementById( inputId );
				if ( ! inputElem ) {
					return;
				}

				const rgbaDigit = color.toRGBA().map( function( digit, index ) {
					return ( index < 3 ? Math.round( digit ) : digit );
				} );

				const rgbaColor = `rgba(${ rgbaDigit.toString() })`;
				inputElem.value = rgbaColor;
				colorLabelElem.textContent = color.toHEXA().toString();
				colorPickerElem.style.backgroundColor = color.toHEXA().toString();
			} );
		} );
	},

	/**
	 * Icon Picker Field.
	 *
	 * @since 1.0.0
	 */
	iconPickerField() {
		hvsfw.fn.eventListener( 'click', '.hd-js-icon-picker-field-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const value = target.getAttribute( 'data-value' );
			const inputId = target.getAttribute( 'data-input' );
			if ( ! state === 'default' || ! value || ! inputId ) {
				return;
			}

			const inputElem = document.getElementById( inputId );
			if ( ! inputId ) {
				return;
			}

			inputElem.value = value;
			hvsfw.fn.setAttribute( `.hd-js-icon-picker-field-btn[data-input="${ inputId }"]`, 'data-state', 'default' );
			target.setAttribute( 'data-state', 'active' );
		} );
	},

	/**
	 * Image Picker Field.
	 *
	 * @since 1.0.0
	 */
	imagePickerField() {
		hvsfw.fn.eventListener( 'click', '.hd-js-image-picker-field-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const value = target.getAttribute( 'data-value' );
			const inputId = target.getAttribute( 'data-input' );
			if ( ! state === 'default' || ! value || ! inputId ) {
				return;
			}

			const inputElem = document.getElementById( inputId );
			if ( ! inputId ) {
				return;
			}

			inputElem.value = value;
			hvsfw.fn.setAttribute( `.hd-js-image-picker-field-btn[data-input="${ inputId }"]`, 'data-state', 'default' );
			target.setAttribute( 'data-state', 'active' );
		} );
	},

	/**
	 * Loader Picker Filed.
	 */
	loaderPickerField() {
		hvsfw.fn.eventListener( 'click', '.hd-js-loader-picker-field-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const value = target.getAttribute( 'data-value' );
			const inputId = target.getAttribute( 'data-input' );
			if ( ! state === 'default' || ! value || ! inputId ) {
				return;
			}

			const inputElem = document.getElementById( inputId );
			if ( ! inputId ) {
				return;
			}

			inputElem.value = value;
			hvsfw.fn.setAttribute( `.hd-js-loader-picker-field-btn[data-input="${ inputId }"]`, 'data-state', 'default' );
			target.setAttribute( 'data-state', 'active' );
		} );
	},

	/**
	 * File Field.
	 *
	 * @since 1.0.0
	 */
	fileField() {
		hvsfw.fn.eventListener( 'change', '.hd-js-file-field-input', function( e ) {
			const target = e.target;
			const files = target.files;
			const parentElem = target.closest( '.hd-file-field' );
			const labelElem = parentElem.querySelector( '.hd-js-file-field-label' );
			if ( ! files.length === 0 || ! parentElem || ! labelElem ) {
				return;
			}

			labelElem.textContent = files[ 0 ].name;
		} );
	},
};

/**
 * Accordion Component.
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
	 * Collapse down and up card.
	 *
	 * @since 1.0.0
	 */
	toggle() {
		hvsfw.fn.eventListener( 'click', '.hd-js-toggle-accordion-btn', function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const bodyElem = target.closest( '.hd-accordion__header' ).nextElementSibling;
			if ( ! [ 'open', 'close' ].includes( state ) || ! bodyElem ) {
				return;
			}

			bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
			if ( state === 'open' ) {
				setTimeout( function() {
					bodyElem.style.maxHeight = null;
				}, 300 );
				target.setAttribute( 'data-state', 'close' );
				bodyElem.setAttribute( 'data-state', 'close' );
			} else {
				setTimeout( function() {
					bodyElem.style.maxHeight = 'max-content';
				}, 500 );
				target.setAttribute( 'data-state', 'open' );
				bodyElem.setAttribute( 'data-state', 'open' );
			}
		} );
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
		hvsfw.fn.eventListener( 'click', '.hvsfw-js-save-setting-btn', async function( e ) {
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

			const res = await hvsfw.fn.fetch( {
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
					alert.title = 'Saving Setttings Success';
					alert.content = 'All fields has been successfully saved.';
					if ( result.totalInvalid > 0 ) {
						alert.content = `A total of ${ result.totalValid } fields has been successfully saved. And a total of ${ result.totalInvalid } fields has been failed because of some requirements did not meet.`;
					}
				} else {
					alert.color = 'danger';
					alert.title = 'Saving Settings Failed';
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
		this.export();
		this.import();
	},

	/**
	 * Export settings from wp_options and also create
	 * a text file containing all the settings.
	 *
	 * @since 1.0.0
	 */
	export() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-export-file-btn', async function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			if ( state !== 'default' ) {
				return;
			}

			hvsfw.prompt.loader( 'visible', 'Exporting Settings...' );
			target.setAttribute( 'data-state', 'loading' );

			const res = await hvsfw.fn.fetch( {
				nonce: hvsfwLocal.tab.importerExporter.nonce.exportSettings,
				action: 'hvsfw_export_settings',
			} );

			if ( res.success === true ) {
				hvsfw.fn.createTextFile( 'handy-itemized-variation-for-woocommerce-settings.txt', res.data.settings );
				hvsfw.toaster.show( {
					color: 'success',
					title: 'Settings Successfully Exported',
					content: 'Itemized variation settings has successfully exported.',
				} );
			} else {
				hvsfw.prompt.errorMessage( res.data.error );
			}

			hvsfw.prompt.loader( 'hide' );
			target.setAttribute( 'data-state', 'default' );
		} );
	},

	/**
	 * Import settings to wp_options, upload the text file containing
	 * the encrypted settings.
	 *
	 * @since 1.0.0
	 *
	 * @return 1.0.0
	 */
	import() {
		hvsfw.fn.eventListener( 'click', '#hvsfw-js-import-file-btn', async function( e ) {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const fileUploaderElem = document.getElementById( 'hvsfw-js-file-field-input' );
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
				const res = await hvsfw.fn.fetch( {
					nonce: hvsfwLocal.tab.importerExporter.nonce.importSettings,
					action: 'hvsfw_import_settings',
					settings: fileContent,
				} );

				if ( res.success === true ) {
					hvsfw.toaster.show( {
						color: 'success',
						title: 'Settings Successfully Imported',
						content: 'Itemized variation settings has successfully imported.',
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
	hvsfw.header.init(); // Handle the header component events.
	hvsfw.tab.init(); // Handle the tab component events.
	hvsfw.carousel.init(); // Handle the carousel component events.
	hvsfw.formField.init(); // Handle all form field components events.
	hvsfw.accordion.init(); // Handle the accordion component events.
	hvsfw.setting.init(); // Handle the setting tab component events.
	hvsfw.importerExporter.init(); // Handle the importer & exporter tab component events.
} );
