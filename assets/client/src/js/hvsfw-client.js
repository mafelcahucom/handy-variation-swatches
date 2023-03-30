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
	 * @param {Object} element The target element.
	 * @param {Array}  styles  Containing the style attribute and value.
	 */
	setInlineStyle( element, styles ) {
		if ( ! element || ! styles ) {
			return;
		}

		Object.entries( styles ).forEach( function( style ) {
			element.style[ style[ 0 ] ] = style[ 1 ];
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
		this.onLoadTerm();
		this.onHoverTerm();
		this.onUpdateVariation();
		this.onResetVariation();
		this.onChangeVariationListener();
		this.onFoundVariationListener();
	},

	/**
	 * Set the inline style of target term element.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} element The target term element.
	 * @param {string} event   The style event |enter|leave.
	 */
	setTermInlineStyle( element, event ) {
		if ( ! element || ! event ) {
			return;
		}

		const styleEncoded = element.getAttribute( 'data-style' );
		if ( styleEncoded ) {
			const styleParsed = JSON.parse( styleEncoded );
			if ( styleParsed[ event ] ) {
				hvsfw.fn.setInlineStyle( element, styleParsed[ event ] );
			}
		}
	},

	/**
	 * Set all term enable state based on select values.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} form The variations form element.
	 */
	setTermsEnable( form = 'all' ) {
		let formElems = [ form ];
		if ( form === 'all' ) {
			formElems = document.querySelectorAll( '.variations_form' );
		}

		if ( formElems.length === 0 ) {
			return;
		}

		formElems.forEach( function( formElem ) {
			const selectElems = formElem.querySelectorAll( '.hvsfw-select' );
			if ( selectElems.length > 0 ) {
				selectElems.forEach( function( selectElem ) {
					const attribute = selectElem.getAttribute( 'data-attribute' );
					if ( attribute ) {
						const selectInputElem = selectElem.querySelector( `select[name="attribute_${ attribute }"]` );
						if ( selectInputElem ) {
							const selectInputValues = Array.from( selectInputElem.options ).map( function( e ) {
								return e.value;
							} );

							// Update the term enable state.
							const termElems = formElem.querySelectorAll( `.hvsfw-term[data-attribute="${ attribute }"]` );
							if ( termElems.length > 0 ) {
								termElems.forEach( function( termElem ) {
									const termValue = termElem.getAttribute( 'data-value' );
									const isTermValueExists = selectInputValues.includes( termValue );
									termElem.setAttribute( 'data-enable', ( isTermValueExists ? 'yes' : 'no' ) );
								} );
							}
						}
					}
				} );
			}
		} );
	},

	/**
	 * On load swatch term events.
	 *
	 * @since 1.0.0
	 */
	onLoadTerm() {
		setTimeout( function() {
			hvsfw.swatch.setTermsEnable( 'all' );
		}, 200 );
	},

	/**
	 * On mouse enter and leave swatch term events.
	 *
	 * @since 1.0.0
	 */
	onHoverTerm() {
		jQuery( '.hvsfw-term' ).on( 'mouseenter mouseleave', function( e ) {
			const target = e.target;
			const enable = target.getAttribute( 'data-enable' );

			// Override inline style.
			const state = target.getAttribute( 'data-state' );
			if ( enable === 'yes' && state === 'default' ) {
				const styleEvent = ( e.type === 'mouseenter' ? 'enter' : 'leave' );
				hvsfw.swatch.setTermInlineStyle( target, styleEvent );
			}

			// Showing and hiding tooltip.
			const tooltip = target.getAttribute( 'data-tooltip' );
			if ( enable === 'yes' && tooltip === 'yes' ) {
				const tooltipElem = target.querySelector( '.hvsfw-tooltip' );
				if ( tooltipElem ) {
					const tooltipVisibility = ( e.type === 'mouseenter' ? 'show' : 'hide' );
					tooltipElem.setAttribute( 'data-visibility', tooltipVisibility );
				}
			}
		} );
	},

	/**
	 * Sets or update the current variation by clicking term.
	 *
	 * @since 1.0.0
	 */
	onUpdateVariation() {
		hvsfw.fn.eventListener( 'click', '.hvsfw-term', function( e ) {
			const target = e.target;
			const value = target.getAttribute( 'data-value' );
			const state = target.getAttribute( 'data-state' );
			const enable = target.getAttribute( 'data-enable' );
			const attribute = target.getAttribute( 'data-attribute' );
			if ( state !== 'default' || enable !== 'yes' || value === '' || ! attribute ) {
				return;
			}

			const formElem = target.closest( '.variations_form' );
			if ( ! formElem ) {
				return;
			}

			const selectElem = formElem.querySelector( `select[name="attribute_${ attribute }"]` );
			if ( selectElem ) {
				selectElem.value = value;
				selectElem.dispatchEvent( new Event( 'change', {
					bubbles: true,
				} ) );

				// Set term current & siblings state.
				const attributeElem = target.closest( '.hvsfw-attribute' );
				if ( attributeElem ) {
					const termElems = attributeElem.querySelectorAll( '.hvsfw-term:not([data-enable="no"])' );
					if ( termElems.length > 0 ) {
						termElems.forEach( function( termElem ) {
							termElem.setAttribute( 'data-state', 'default' );
							hvsfw.swatch.setTermInlineStyle( termElem, 'leave' );
						} );

						target.setAttribute( 'data-state', 'active' );
						hvsfw.swatch.setTermInlineStyle( target, 'enter' );
					}
				}
			}
		} );
	},

	/**
	 * Reset the variation form value.
	 *
	 * @since 1.0.0
	 */
	onResetVariation() {
		jQuery( '.reset_variations' ).on( 'click', function( e ) {
			const target = e.target;

			// Shop Page or Product Thumbnail.
			const thumbnailElem = target.closest( 'li.product.product-type-variable' );
			if ( thumbnailElem ) {
				const variationForm = thumbnailElem.querySelector( '.variations_form' );
				if ( variationForm ) {
					// Reset thumbnail.
					if ( variationForm.hasAttribute( 'data-image' ) ) {
						const imageElem = thumbnailElem.querySelector( 'img.attachment-woocommerce_thumbnail' );
						const imageOriginal = variationForm.getAttribute( 'data-image' );
						if ( imageElem && imageOriginal ) {
							const image = JSON.parse( imageOriginal );
							if ( image ) {
								imageElem.setAttribute( 'src', image.thumb_src );
								imageElem.setAttribute( 'srcset', image.srcset );
								imageElem.setAttribute( 'sizes', image.sizes );
								imageElem.setAttribute( 'alt', image.alt );
							}
						}
					}

					// Reset price.
					if ( variationForm.hasAttribute( 'data-price' ) ) {
						const priceElem = thumbnailElem.querySelector( '.price' );
						const priceOriginal = variationForm.getAttribute( 'data-price' );
						if ( priceElem && priceOriginal ) {
							priceElem.innerHTML = priceOriginal;
						}
					}
				}
			}
		} );
	},

	/**
	 * Listens or fire event whenever variation selects has been changed.
	 *
	 * @since 1.0.0
	 */
	onChangeVariationListener() {
		jQuery( '.variations_form' ).on( 'woocommerce_variation_select_change', function( e ) {
			const target = e.target;

			setTimeout( function() {
				hvsfw.swatch.setTermsEnable( target );
			}, 200 );
		} );
	},

	/**
	 * Listens or fire event when all the required attributes are selected and a final variation is shown.
	 *
	 * @since 1.0.0
	 */
	onFoundVariationListener() {
		jQuery( '.variations_form' ).on( 'found_variation', function( e, variation ) {
			const target = e.target;

			// Shop Page or Product Thumbnail.
			const thumbnailElem = target.closest( 'li.product.product-type-variable' );
			if ( thumbnailElem ) {
				// Update thumbnail.
				const imageElem = thumbnailElem.querySelector( 'img.attachment-woocommerce_thumbnail' );
				if ( imageElem ) {
					if ( ! target.hasAttribute( 'data-image' ) ) {
						const imageOriginal = {
							alt: imageElem.getAttribute( 'alt' ),
							sizes: imageElem.getAttribute( 'sizes' ),
							srcset: imageElem.getAttribute( 'srcset' ),
							thumb_src: imageElem.getAttribute( 'src' ),
						};
						target.setAttribute( 'data-image', JSON.stringify( imageOriginal ) );
					}

					imageElem.setAttribute( 'src', variation.image.thumb_src );
					imageElem.setAttribute( 'srcset', variation.image.srcset );
					imageElem.setAttribute( 'sizes', variation.image.sizes );
					imageElem.setAttribute( 'alt', variation.image.alt );
				}

				// Update price.
				const priceElem = thumbnailElem.querySelector( '.price' );
				if ( priceElem ) {
					if ( ! target.hasAttribute( 'data-price' ) ) {
						target.setAttribute( 'data-price', priceElem.innerHTML );
					}

					priceElem.outerHTML = variation.price_html;
				}
			}
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
	hvsfw.swatch.init();
} );
