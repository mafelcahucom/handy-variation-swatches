/**
 * Internal Dependencies.
 */
import { eventListener } from '../../../helpers';

/**
 * Header Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const header = {
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
		window.addEventListener( 'scroll', () => {
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
		eventListener( 'click', '#hd-navigation-btn', ( e ) => {
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const navigationElem = document.getElementById( 'hd-header-navigation' );
			if ( navigationElem ) {
				const updatedState = 'default' === state ? 'active' : 'default';
				const updatedLabel = 'default' === state ? 'Close Navigation' : 'Open Navigation';
				target.setAttribute( 'data-state', updatedState );
				target.setAttribute( 'title', updatedLabel );
				target.setAttribute( 'aria-label', updatedLabel );
				navigationElem.setAttribute( 'data-state', updatedState );
			}
		} );
	},
};

export default header;
