/**
 * Toaster Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const toaster = {
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
		setTimeout( () => {
			if ( toastComponent ) {
				parent.hide( toastComponent );
				parent.hideContainer();
			}
		}, 5000 );

		const closeToastEvent = toastComponent.querySelector( '.hd-toast__close-btn' );
		if ( closeToastEvent ) {
			closeToastEvent.addEventListener( 'click', () => {
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
		toastComponent.addEventListener(
			'animationend',
			() => {
				toastComponent.remove();
			},
			false
		);
	},

	/**
	 * Hide the toast container.
	 *
	 * @since 1.0.0
	 */
	hideContainer() {
		setTimeout( () => {
			if ( false === toaster.container().hasChildNodes() ) {
				toaster.container().remove();
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

export default toaster;
