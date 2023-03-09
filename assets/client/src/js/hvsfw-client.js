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

		this.onMouseEnterTerm();
		this.onMouseLeaveTerm();
	},

	/**
	 * On mouse enter swatch term.
	 *
	 * @since 1.0.0
	 */
	onMouseEnterTerm() {
		jQuery( '.hvsfw-term[data-tooltip="yes"]' ).mouseenter( function( e ) {
			const target = e.target;
			const tooltipElem = target.querySelector( '.hvsfw-tooltip' );
			console.log( tooltipElem );
			if ( tooltipElem ) {
				tooltipElem.setAttribute( 'data-visibility', 'visible' );
			}
		});
	},

	/**
	 * On mouse leave swatch term.
	 *
	 * @since 1.0.0
	 */
	onMouseLeaveTerm() {
		jQuery( '.hvsfw-term[data-tooltip="yes]' ).mouseleave( function( e ) {
			const target = e.target;
			const tooltipElem = target.querySelector( '.hvsfw-tooltip' );
			console.log( tooltipElem );
			if ( tooltipElem ) {
				tooltipElem.setAttribute( 'data-visibility', 'hidden' );
			}
		});
	}
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
