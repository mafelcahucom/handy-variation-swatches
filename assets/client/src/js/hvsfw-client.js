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
	 * Set or implement the inline style on a certain element based on
	 * the given styles.
	 *
	 * @since 1.0.0
	 * 
	 * @param  {Object} element The target element.
	 * @param  {array}  styles  Containing the style attribute and value.
	 */
	setInlineStyle( element, styles ) {
		if ( ! element || ! styles ) {
			return;
		}

		Object.entries( styles ).forEach( function( style ) {
			element.style[ style[0] ] = style[1];
		});
	}
};

/**
 * Holds the swatch events.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
hvsfw.swatch = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.onHoverTerm();
	},

	/**
	 * On mouse enter and leave swatch term.
	 *
	 * @since 1.0.0
	 */
	onHoverTerm() {
		jQuery( '.hvsfw-term' ).on( 'mouseenter mouseleave', function( e ) {
			const target = e.target;;
			
			// Override style.
			const styleEncoded = target.getAttribute( 'data-style' );
			if ( styleEncoded ) {
				const styleParsed = JSON.parse( styleEncoded );
				const styles = ( e.type === 'mouseenter' ? styleParsed.enter : styleParsed.leave );
				if ( styles ) {
					hvsfw.fn.setInlineStyle( target, styles );
				}
			}

			// Showing and hiding tooltip.
			const isTooltipEnabled = target.getAttribute( 'data-tooltip' );
			if ( isTooltipEnabled === 'yes' ) {
				const tooltipElem = target.querySelector( '.hvsfw-tooltip' );
				if ( tooltipElem ) {
					const tooltipVisibility = ( e.type === 'mouseenter' ? 'show' : 'hide' );
					tooltipElem.setAttribute( 'data-visibility', tooltipVisibility );
				} 
			}
		});
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
	hvsfw.swatch.init();
} );
