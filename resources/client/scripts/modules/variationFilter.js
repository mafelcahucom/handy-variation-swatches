/**
 * Internal Dependencies.
 */
import { eventListener } from '../../../helpers';

/**
 * Variation Filter Module.
 *
 * @since 1.0.0
 *
 * @type   {Object}
 * @author Mafel John Cahucom
 */
const variationFilter = {
	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onClickLink();
		this.onChangeSwatchSelect();
		this.onClearSwatchSelect();
		this.removeUnwantedTags();
	},

	/**
	 * Go to the provided data url. Note this is done because wordpress automatically
	 * add <p> and <br> tags after an <a> tag.
	 *
	 * @since 1.0.0
	 */
	onClickLink() {
		eventListener( 'click', '.hvsfw-vf-link', ( e ) => {
			const target = e.target;
			const url = target.getAttribute( 'data-url' );
			if ( url ) {
				window.location.href = url;
			}
		} );
	},

	/**
	 * Swatch Select: Update the url parameter based on select value.
	 *
	 * @since 1.0.0
	 */
	onChangeSwatchSelect() {
		eventListener( 'change', '.hvsfw-vf-swatch-select__select', ( e ) => {
			const target = e.target;
			const url = target.value;
			if ( url ) {
				window.location.href = url;
			}
		} );
	},

	/**
	 * Swatch Select: Clear the current value in the url parameter.
	 *
	 * @since 1.0.0
	 */
	onClearSwatchSelect() {
		eventListener( 'click', '.hvsfw-vf-swatch-select__clear-btn', ( e ) => {
			const target = e.target;
			const parent = target.closest( '.hvsfw-vf-swatch-select' );
			const url = target.getAttribute( 'data-url' );
			if ( url ) {
				parent.setAttribute( 'data-state', 'default' );
				window.location.href = url;
			}
		} );
	},

	/**
	 * Removes the unwated <p> and <br> tags inside filter component.
	 *
	 * @since 1.0.0
	 */
	removeUnwantedTags() {
		const parentElems = document.querySelectorAll( '.hvsfw-vf' );
		if ( 0 < parentElems.length ) {
			parentElems.forEach( ( parentElem ) => {
				const pElems = parentElem.querySelectorAll( 'p' );
				if ( 0 < pElems.length ) {
					pElems.forEach( ( pElem ) => {
						pElem.remove();
					} );
				}

				const brElems = parentElem.querySelectorAll( 'br' );
				if ( 0 < brElems.length ) {
					brElems.forEach( ( brElem ) => {
						brElem.remove();
					} );
				}
			} );
		}
	},
};

export default variationFilter;
