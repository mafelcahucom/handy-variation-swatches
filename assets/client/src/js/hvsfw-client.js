/**
 * Internal dependencies
 */
import variationFilter from "./modules/variation-filter";

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

	/**
	 * Sort the object based on the keys.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object The object to be sort.
	 * @return {Object} The sorted object.
	 */
	sortObject( object ) {
		return Object.keys( object ).sort().reduce( function( result, key ) {
			result[ key ] = object[ key ];
			return result;
		}, {} );
	},

	/**
	 * Checks if the two objects has the same keys and values.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} object1 The first object.
	 * @param {Object} object2 The second object.
	 * @return {boolean} If two objects are equal.
	 */
	isObjectsEqual( object1, object2 ) {
		const obj1 = this.sortObject( object1 );
		const obj2 = this.sortObject( object2 );

		return JSON.stringify( obj1 ) === JSON.stringify( obj2 );
	},
};

/**
 * Holds all the prompt compnents.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.prompt = {

	/**
	 * Prompts woocommerce notice.
	 *
	 * @since 1.0.0
	 *
	 * @param {HTMLElement} notice The notice to be printed.
	 */
	notice( notice ) {
		if ( ! hvsfwLocal.setting.notice.isEnabled ) {
			return;
		}

		const noticeWrapperElem = document.querySelector( '.woocommerce-notices-wrapper' );
		if ( ! noticeWrapperElem || ! notice ) {
			return;
		}

		noticeWrapperElem.innerHTML = notice;
		if ( hvsfwLocal.setting.notice.isAutoHide ) {
			const noticeSuccessElems = noticeWrapperElem.querySelectorAll( '.woocommerce-message' );
			const noticeErrorElems = noticeWrapperElem.querySelectorAll( '.woocommerce-error' );

			setTimeout( function() {
				if ( noticeSuccessElems.length > 0 ) {
					noticeSuccessElems.forEach( function( noticeSuccessElem ) {
						noticeSuccessElem.remove();
					} );
				}

				if ( noticeErrorElems.length > 0 ) {
					noticeErrorElems.forEach( function( noticeErrorElem ) {
						noticeErrorElem.remove();
					} );
				}
			}, hvsfwLocal.setting.notice.duration );
		}
	},

	/**
	 * Prompts the toaster aler type - error.
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
				error: 'INVALID_PRODUCT_ERROR',
				title: 'Invalid Product',
				content: "The product you're trying to add to the cart is invalid. Please check and try again.",
			},
			{
				error: 'NO_VARIATION_SELECTED_ERROR',
				title: 'No Variation Selected',
				content: 'Variation is required. Please select a variation and try again.',
			},
			{
				error: 'INVALID_VARIATION_ERROR',
				title: 'Invalid Variation',
				content: "The variation you're trying to add to the cart is invalid. Please check and try again.",
			},
		];

		const errorDetail = errors.find( function( value ) {
			return ( value.error === error );
		} );

		if ( hvsfwLocal.plugin.isHATFWActive || hvsfwLocal.plugin.isHAPFWActive ) {
			// Alert toaster notifier.
			if ( hvsfwLocal.plugin.isHATFWActive ) {
				handyToasterNotifier.show( {
					type: 'alert',
					color: 'danger',
					title: errorDetail.title,
					content: errorDetail.content,
				} );
			}

			// Alert popup notifier.
			if ( hvsfwLocal.plugin.isHAPFWActive ) {
				handyPopupNotifier.showAlert( {
					status: 'error',
					title: errorDetail.title,
					message: errorDetail.content,
				} );
			}
		} else {
			alert( errorDetail.content );
		}
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
	 * Set all the terms enable in a certain variation form.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} form The target variation form.
	 */
	setTermEnable( form ) {
		if ( ! form ) {
			return;
		}

		const selectElems = form.querySelectorAll( '.hvsfw-select' );
		if ( selectElems.length > 0 ) {
			selectElems.forEach( function( selectElem ) {
				const attribute = selectElem.getAttribute( 'data-attribute' );
				if ( attribute ) {
					const selectInputElem = selectElem.querySelector( `select[name="attribute_${ attribute }"]` );
					if ( selectInputElem ) {
						const selectInputValues = Array.from( selectInputElem.options ).map( function( e ) {
							return e.value;
						} );

						const termElems = form.querySelectorAll( `.hvsfw-term[data-attribute="${ attribute }"]` );
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
	},

	/**
	 * Set all the terms enable in all variation form.
	 *
	 * @since 1.0.0
	 */
	setAllTermEnable() {
		const formElems = document.querySelectorAll( '.variations_form' );
		if ( formElems.length > 0 ) {
			formElems.forEach( function( formElem ) {
				hvsfw.swatch.setTermEnable( formElem );
			} );
		}
	},

	/**
	 * Set a certain term state.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} term  The target term element.
	 * @param {string} state The updated state value.
	 */
	setTermState( term, state ) {
		if ( ! term || ! [ 'default', 'active' ].includes( state ) ) {
			return;
		}

		const styleState = ( state === 'active' ? 'enter' : 'leave' );
		hvsfw.swatch.setTermInlineStyle( term, styleState );
		term.setAttribute( 'data-state', state );
	},

	/**
	 * Set all the terms state in a certain variation form.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} form     The target variation form.
	 * @param {string} selector The term selector.
	 * @param {string} state    The update state value
	 */
	setAllTermState( form, selector, state ) {
		if ( ! form || ! selector || ! [ 'default', 'active' ].includes( state ) ) {
			return;
		}

		const termElems = form.querySelectorAll( selector );
		if ( termElems.length > 0 ) {
			termElems.forEach( function( termElem ) {
				hvsfw.swatch.setTermState( termElem, state );
			} );
		}
	},

	/**
	 * Set the variation in single product page on first load.
	 *
	 * @since 1.0.0
	 */
	setSingleProductVariation() {
		const isSingleProduct = document.body.classList.contains( 'single-product' );
		if ( ! isSingleProduct ) {
			return;
		}

		const variationFormElem = document.querySelector( 'form.variations_form' );
		if ( ! variationFormElem ) {
			return;
		}

		let variations = variationFormElem.getAttribute( 'data-product_variations' );
		variations = JSON.parse( variations );
		if ( ! variations ) {
			return;
		}

		const selectParentElems = variationFormElem.querySelectorAll( '.hvsfw-select' );
		const totalAttribute = selectParentElems.length;
		if ( totalAttribute === 0 ) {
			return;
		}

		let selectData = [];
		let totalValidAttribute = 0;
		let totalInvalidAttribute = 0;
		selectParentElems.forEach( function( selectParentElem ) {
			const attributeName = selectParentElem.getAttribute( 'data-attribute' );
			if ( attributeName ) {
				const selectElem = selectParentElem.querySelector( 'select' );
				if ( selectElem ) {
					const selectName = selectElem.getAttribute( 'name' );
					const selectedOption = selectElem.querySelector( 'option[selected="selected"]' );
					const selectedValue = ( selectedOption ? selectedOption.getAttribute( 'value' ) : null );
					selectData[ attributeName ] = {
						key: selectName,
						value: selectedValue,
					};

					if ( selectedValue === null ) {
						totalInvalidAttribute += 1;
					} else {
						totalValidAttribute += 1;
					}
				}
			}
		} );

		if ( totalValidAttribute === 0 ) {
			return;
		}

		selectData = Object.entries( selectData );
		if ( totalInvalidAttribute === 0 ) {
			const attributes = [];
			selectData.forEach( function( data ) {
				attributes[ data[ 1 ].key ] = data[ 1 ].value;
			} );

			const currentVariation = variations.find( function( data ) {
				return hvsfw.fn.isObjectsEqual( attributes, data.attributes );
			} );

			let isVariationBuyable = false;
			if ( currentVariation !== undefined ) {
				if ( currentVariation.is_purchasable && currentVariation.is_in_stock ) {
					isVariationBuyable = true;
				}
			}

			selectData.forEach( function( data ) {
				const selector = `.hvsfw-term[data-attribute="${ data[ 0 ] }"][data-value="${ data[ 1 ].value }"]`;
				if ( isVariationBuyable ) {
					// Set term state to active.
					hvsfw.swatch.setAllTermState( variationFormElem, selector, 'active' );
				} else {
					// Set term enable to no.
					const termElem = variationFormElem.querySelector( selector );
					if ( termElem ) {
						termElem.setAttribute( 'data-enable', 'no' );
					}
				}
			} );
		}

		if ( totalInvalidAttribute > 0 ) {
			// Set term state to active.
			selectData.forEach( function( data ) {
				const selector = `.hvsfw-term[data-attribute="${ data[ 0 ] }"][data-value="${ data[ 1 ].value }"]`;
				hvsfw.swatch.setAllTermState( variationFormElem, selector, 'active' );
			} );
		}
	},

	/**
	 * On load swatch term events.
	 *
	 * @since 1.0.0
	 */
	onLoadTerm() {
		setTimeout( function() {
			hvsfw.swatch.setAllTermEnable();
			hvsfw.swatch.setSingleProductVariation();
		}, 1000 );
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

			// Product Single Page.
			const variationForm = target.closest( '.variations_form' );
			if ( variationForm ) {
				// Reset all term state.
				hvsfw.swatch.setAllTermState( variationForm, '.hvsfw-term[data-state="active"]', 'default' );
			}

			// Product Shop Page.
			const thumbnailElem = target.closest( 'li.product.product-type-variable' );
			if ( thumbnailElem ) {
				const thumbnailVariationForm = thumbnailElem.querySelector( '.variations_form' );
				if ( thumbnailVariationForm ) {
					// Reset thumbnail.
					if ( thumbnailVariationForm.hasAttribute( 'data-image' ) ) {
						const imageElem = thumbnailElem.querySelector( 'img.attachment-woocommerce_thumbnail' );
						const imageOriginal = thumbnailVariationForm.getAttribute( 'data-image' );
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
					if ( thumbnailVariationForm.hasAttribute( 'data-price' ) ) {
						const priceElem = thumbnailElem.querySelector( '.price' );
						const priceOriginal = thumbnailVariationForm.getAttribute( 'data-price' );
						if ( priceElem && priceOriginal ) {
							priceElem.innerHTML = priceOriginal;
						}
					}

					// Reset add to cart button.
					hvsfw.addToCart.resetButton( thumbnailElem );
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
				hvsfw.swatch.setTermEnable( target );
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

				// Update add to cart button.
				hvsfw.addToCart.setButton( thumbnailElem, variation );
			}
		} );
	},
};

/**
 * Add To Cart Event.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.addToCart = {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.variationAddToCart();
	},

	/**
	 * Set the add to cart button in shop page.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} thumbnail The current product thumbnail.
	 * @param {Object} variation The current variation found.
	 */
	setButton( thumbnail, variation ) {
		if ( ! thumbnail || ! variation ) {
			return;
		}

		const variationId = variation.variation_id;
		const isBuyable = ( variation.is_purchasable && variation.is_in_stock );

		// Default: Add to cart.
		const addToCartBtnElem = thumbnail.querySelector( '.hvsfw-js-loop-add-to-cart-btn' );
		if ( addToCartBtnElem ) {
			const availableText = addToCartBtnElem.getAttribute( 'data-available-text' );
			const unavailableText = addToCartBtnElem.getAttribute( 'data-unavailable-text' );

			addToCartBtnElem.textContent = ( isBuyable ? availableText : unavailableText );
			addToCartBtnElem.setAttribute( 'data-is-available', ( isBuyable ? 'yes' : 'no' ) );
			addToCartBtnElem.setAttribute( 'data-variation_id', ( isBuyable ? variationId : 0 ) );
		}

		// HAFW: Add to cart button.
		if ( hvsfwLocal.plugin.isHAFWActive ) {
			const hafwSwatchBtnElem = thumbnail.querySelector( '.hafw-swatch-btn' );
			if ( hafwSwatchBtnElem ) {
				const hafwBtnDefaultElem = hafwSwatchBtnElem.querySelector( '.hafw-vpl' );
				const hafwBtnSimpleElem = hafwSwatchBtnElem.querySelector( '.hafw-spl' );
				if ( hafwBtnDefaultElem && hafwBtnSimpleElem ) {
					hafwSwatchBtnElem.setAttribute( 'data-type', ( isBuyable ? 'simple' : 'default' ) );
					hafwBtnSimpleElem.setAttribute( 'data-variation_id', ( isBuyable ? variationId : 0 ) );
				}
			}
		}
	},

	/**
	 * Reset the add to cart button in shop page.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} thumbnail The current product thumbnail.
	 */
	resetButton( thumbnail ) {
		if ( ! thumbnail ) {
			return;
		}

		// Default: Add to cart.
		const addToCartBtnElem = thumbnail.querySelector( '.hvsfw-js-loop-add-to-cart-btn' );
		if ( addToCartBtnElem ) {
			const unavailableText = addToCartBtnElem.getAttribute( 'data-unavailable-text' );

			addToCartBtnElem.textContent = unavailableText;
			addToCartBtnElem.setAttribute( 'data-is-available', 'no' );
			addToCartBtnElem.setAttribute( 'data-variation_id', 0 );
		}

		// HAFW: Add to cart button.
		if ( hvsfwLocal.plugin.isHAFWActive ) {
			const hafwSwatchBtnElem = thumbnail.querySelector( '.hafw-swatch-btn' );
			if ( hafwSwatchBtnElem ) {
				hafwSwatchBtnElem.setAttribute( 'data-type', 'default' );
			}
		}
	},

	/**
	 * Adding product variation to cart via AJAX in shop page.
	 *
	 * @since 1.0.0
	 */
	variationAddToCart() {
		hvsfw.fn.eventListener( 'click', '.hvsfw-js-loop-add-to-cart-btn', async function( e ) {
			e.preventDefault();
			const target = e.target;
			const productId = parseInt( target.getAttribute( 'data-product_id' ) );
			const variationId = parseInt( target.getAttribute( 'data-variation_id' ) );
			let quantity = parseInt( target.getAttribute( 'data-quantity' ) );

			const isAvailable = target.getAttribute( 'data-is-available' );
			if ( isAvailable === 'no' ) {
				const href = target.getAttribute( 'href' );
				if ( href ) {
					window.location.href = href;
				}
				return;
			}

			const classList = target.classList;
			if ( classList.contains( 'loading' ) || classList.contains( 'added' ) ) {
				return;
			}

			quantity = ( isNaN( quantity ) || quantity < 1 ? 1 : quantity );
			if ( isNaN( productId ) || productId <= 0 ) {
				hvsfw.prompt.errorMessage( 'INVALID_PRODUCT_ERROR' );
				return;
			}

			if ( isNaN( variationId ) || variationId <= 0 ) {
				hvsfw.prompt.errorMessage( 'INVALID_VARIATION_ERROR' );
				return;
			}

			classList.add( 'loading' );
			const res = await hvsfw.fn.fetch( {
				nonce: hvsfwLocal.nonce.variationAddToCart,
				action: 'hvsfw_variation_add_to_cart',
				productId,
				variationId,
				quantity,
			} );

			if ( res.success === true ) {
				if ( res.data.response === 'SUCCESSFULLY_ADDED_TO_CART' ) {
					// Show success notice.
					hvsfw.prompt.notice( res.data.notice );

					// Product toaster notifier.
					if ( hvsfwLocal.plugin.isHATFWActive ) {
						handyToasterNotifier.show( {
							type: 'product',
							title: 'Added To Cart',
							image: res.data.product_thumbnail,
							content: res.data.product_name,
						} );
					}

					// Trigger added_to_cart.
					jQuery( document.body ).trigger( 'added_to_cart', [
						res.data.fragments,
						res.data.cart_hash,
					] );

					classList.remove( 'loading' );
					classList.add( 'added' );
					setTimeout( function() {
						classList.remove( 'added' );
					}, 2000 );
				} else {
					// Show error message.
					hvsfw.prompt.notice( res.data.notice );
					classList.remove( 'loading' );
				}
			} else {
				// Show error message.
				hvsfw.prompt.errorMessage( res.data.error );
				classList.remove( 'loading' );
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
	variationFilter.init();
	hvsfw.swatch.init();
	hvsfw.addToCart.init();
} );
