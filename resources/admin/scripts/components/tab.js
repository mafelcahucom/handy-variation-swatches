/**
 * Internal Dependencies.
 */
import { getPascalString, setText, setAttribute, eventListener } from '../../../helpers';

/**
 * Tab Component.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const tab = {
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
	 * Update the breadcrumb tab title.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} hash Contains the url hash of tab.
	 */
	updateBreadcrumbTabTitle( hash ) {
		let title = 'General';
		title = hash ? getPascalString( '-', ' ', hash ) : title;
		setText.elem( '.hd-breadcrumb__item[data-type="tab"]', title );
	},

	/**
	 * Update the tab button and panel.
	 *
	 * @since 1.0.0
	 */
	onUpdateTab() {
		const tabBtnElems = document.querySelectorAll( '.hd-tab__nav__item-btn' );
		if ( 0 === tabBtnElems.length ) {
			return;
		}

		const hash = window.location.hash;
		if ( ! hash ) {
			const firstTabHash = tabBtnElems[ 0 ].getAttribute( 'data-target' );
			if ( firstTabHash ) {
				window.location.hash = firstTabHash;
			}
		}
		this.updateBreadcrumbTabTitle( hash );

		const updatedHash = window.location.hash;
		if ( ! updatedHash ) {
			return;
		}
		this.updateBreadcrumbTabTitle( updatedHash );

		const currentTabPanelElem = document.querySelector( updatedHash );
		const currentTabBtnElem = document.querySelector(
			`.hd-tab__nav__item-btn[data-target="${ updatedHash }"]`
		);
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
		eventListener( 'click', '.hd-tab__nav__item-btn', ( e ) => {
			const parent = tab;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const targetPanel = target.getAttribute( 'data-target' );
			if ( 'default' === state && targetPanel ) {
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
		eventListener( 'click', '.hd-tab__nav__action-btn', ( e ) => {
			const parent = tab;
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const event = target.getAttribute( 'data-event' );
			const parentElem = target.closest( '.hd-tab__nav__container' );
			if ( 'default' !== state || ! [ 'prev', 'next' ].includes( event ) || ! parentElem ) {
				return;
			}

			const listElem = parentElem.querySelector( '.hd-tab__nav__list' );
			const prevBtnElem = parentElem.querySelector(
				'.hd-tab__nav__action-btn[data-event="prev"]'
			);
			const nextBtnElem = parentElem.querySelector(
				'.hd-tab__nav__action-btn[data-event="next"]'
			);
			if ( ! listElem || ! prevBtnElem || ! nextBtnElem ) {
				return;
			}

			const outerRec = parentElem.getBoundingClientRect();
			const rightPosition = listElem.scrollWidth + parent.left - outerRec.width;
			/* eslint-disable indent */
			switch ( event ) {
				case 'prev':
					if ( 0 > parseInt( listElem.style.left ) ) {
						parent.left += 100;
						nextBtnElem.setAttribute( 'data-state', 'default' );
					}
					break;
				case 'next':
					if ( 0 < rightPosition ) {
						parent.left -= 100;
						prevBtnElem.setAttribute( 'data-state', 'default' );
					}
					break;
			}
			/* eslint-enable */

			listElem.style.left = parent.left + 'px';
			if ( 0 === parseInt( listElem.style.left ) ) {
				listElem.style.left = '0px';
				prevBtnElem.setAttribute( 'data-state', 'disabled' );
			} else if ( 0 > rightPosition ) {
				listElem.style.left = `-${ listElem.scrollWidth - outerRec.width }`;
				nextBtnElem.setAttribute( 'data-state', 'disabled' );
			}
		} );
	},
};

export default tab;
