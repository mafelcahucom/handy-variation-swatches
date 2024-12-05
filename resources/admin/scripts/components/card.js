/**
 * Internal Dependencies.
 */
import { eventListener } from '../../../helpers';

/**
 * Card Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const card = {
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
		eventListener( 'click', '.hd-card__header[data-type="collapsible"]', ( e ) => {
			const target = e.target;
			const parentElem = target.closest( '.hd-card' );
			const bodyElem = parentElem.querySelector( '.hd-card__body' );
			const state = parentElem.getAttribute( 'data-state' );
			if ( parentElem && bodyElem && [ 'opened', 'closed' ].includes( state ) ) {
				bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
				if ( 'opened' === state ) {
					setTimeout( () => {
						bodyElem.style.maxHeight = null;
					}, 300 );
					parentElem.setAttribute( 'data-state', 'closed' );
				} else {
					setTimeout( () => {
						bodyElem.style.maxHeight = 'max-content';
					}, 500 );
					parentElem.setAttribute( 'data-state', 'opened' );
				}
			}
		} );
	},
};

export default card;
