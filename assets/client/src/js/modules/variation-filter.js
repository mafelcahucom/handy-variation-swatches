/**
 * Internal Dependencies.
 */
import {
	eventListener,
} from '../../../../helpers';

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
		eventListener( 'click', '.hvsfw-vf-link', function( e ) {
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
		eventListener( 'change', '.hvsfw-vf-swatch-select__select', function( e ) {
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
		eventListener( 'click', '.hvsfw-vf-swatch-select__clear-btn', function( e ) {
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
		if ( parentElems.length > 0 ) {
			parentElems.forEach( function( parentElem ) {
				const pElems = parentElem.querySelectorAll( 'p' );
				if ( pElems.length > 0 ) {
					pElems.forEach( function( pElem ) {
						pElem.remove();
					} );
				}

				const brElems = parentElem.querySelectorAll( 'br' );
				if ( brElems.length > 0 ) {
					brElems.forEach( function( brElem ) {
						brElem.remove();
					} );
				}
			} );
		}
	},
};

export default variationFilter;
