/**
 * Internal Dependencies.
 */
import { getFetch, isObject, setInlineStyle, eventListener } from '../../helpers';

/**
 * Module Dependencies.
 */
import variationFilterModule from './modules/variationFilter';

/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
( 'use strict' ); // eslint-disable-line no-unused-expressions

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hvsfw = hvsfw || {};

/**
 * Holds the variation filter events.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.variationFilter = variationFilterModule;

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
	 * @param {HTMLElement} notice Contains the notice to be printed.
	 */
	notice( notice ) {
		// eslint-disable-next-line no-undef
		if ( ! hvsfwLocal.setting.notice.isEnabled ) {
			return;
		}

		const noticeWrapperElem = document.querySelector( '.woocommerce-notices-wrapper' );
		if ( ! noticeWrapperElem || ! notice ) {
			return;
		}

		noticeWrapperElem.innerHTML = notice;
		/* eslint-disable no-undef */
		if ( hvsfwLocal.setting.notice.isAutoHide ) {
			const noticeSuccessElems = noticeWrapperElem.querySelectorAll( '.woocommerce-message' );
			const noticeErrorElems = noticeWrapperElem.querySelectorAll( '.woocommerce-error' );

			setTimeout( () => {
				if ( 0 < noticeSuccessElems.length ) {
					noticeSuccessElems.forEach( ( noticeSuccessElem ) => {
						noticeSuccessElem.remove();
					} );
				}

				if ( 0 < noticeErrorElems.length ) {
					noticeErrorElems.forEach( ( noticeErrorElem ) => {
						noticeErrorElem.remove();
					} );
				}
			}, hvsfwLocal.setting.notice.duration );
		}
		/* eslint-enable */
	},

	/**
	 * Prompts the toaster aler type - error.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error Contains the error name.
	 */
	errorMessage( error ) {
		const errors = [
			{
				error: 'NETWORK_ERROR',
				title: 'Network Error',
				content:
					'The network connection is lost, there might be a problem with your network.',
			},
			{
				error: 'SECURITY_ERROR',
				title: 'Security Error',
				content:
					'A security error occur. Please try again later or contact the website administrator for help.',
			},
			{
				error: 'MISSING_DATA_ERROR',
				title: 'Missing Data',
				content: 'There is a missing data that are required. Please check and try again.',
			},
			{
				error: 'INVALID_PRODUCT_ERROR',
				title: 'Invalid Product',
				content:
					"The product you're trying to add to the cart is invalid. Please check and try again.",
			},
			{
				error: 'NO_VARIATION_SELECTED_ERROR',
				title: 'No Variation Selected',
				content: 'Variation is required. Please select a variation and try again.',
			},
			{
				error: 'INVALID_VARIATION_ERROR',
				title: 'Invalid Variation',
				content:
					"The variation you're trying to add to the cart is invalid. Please check and try again.",
			},
		];

		const errorDetail = errors.find( ( value ) => {
			return value.error === error;
		} );

		/* eslint-disable no-undef, no-alert */
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
		/* eslint-enable */
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
	 * @param {Object} element Contains the target term element.
	 * @param {string} event   Contains the style event |enter|leave.
	 */
	setTermInlineStyle( element, event ) {
		if ( element && event ) {
			const styleEncoded = element.getAttribute( 'data-style' );
			if ( styleEncoded ) {
				const styleParsed = JSON.parse( styleEncoded );
				if ( styleParsed[ event ] ) {
					setInlineStyle( element, styleParsed[ event ] );
				}
			}
		}
	},

	/**
	 * Set all the terms enable in a certain variation form.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} form Contains the target variation form.
	 */
	setTermEnable( form ) {
		if ( ! form ) {
			return;
		}

		const selectElems = form.querySelectorAll( '.hvsfw-select' );
		if ( 0 < selectElems.length ) {
			selectElems.forEach( ( selectElem ) => {
				const attribute = selectElem.getAttribute( 'data-attribute' );
				if ( attribute ) {
					const selectInputElem = selectElem.querySelector(
						`select[name="attribute_${ attribute }"]`
					);
					if ( selectInputElem ) {
						const selectInputValues = Array.from( selectInputElem.options ).map(
							( e ) => {
								return e.value;
							}
						);

						const termElems = form.querySelectorAll(
							`.hvsfw-term[data-attribute="${ attribute }"]`
						);
						if ( 0 < termElems.length ) {
							termElems.forEach( ( termElem ) => {
								const termValue = termElem.getAttribute( 'data-value' );
								const isTermValueExists = selectInputValues.includes( termValue );
								termElem.setAttribute(
									'data-enable',
									isTermValueExists ? 'yes' : 'no'
								);
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
		if ( 0 < formElems.length ) {
			formElems.forEach( ( formElem ) => {
				hvsfw.swatch.setTermEnable( formElem );
			} );
		}
	},

	/**
	 * Set a certain term state.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} term  Contains the target term element.
	 * @param {string} state Contains the updated state value.
	 */
	setTermState( term, state ) {
		if ( term && [ 'default', 'active' ].includes( state ) ) {
			const styleState = 'active' === state ? 'enter' : 'leave';
			hvsfw.swatch.setTermInlineStyle( term, styleState );
			term.setAttribute( 'data-state', state );
		}
	},

	/**
	 * Set all the terms state in a certain variation form.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} form     Contains the target variation form.
	 * @param {string} selector Contains the term selector.
	 * @param {string} state    Contains the update state value
	 */
	setAllTermState( form, selector, state ) {
		if ( form && selector && [ 'default', 'active' ].includes( state ) ) {
			const termElems = form.querySelectorAll( selector );
			if ( 0 < termElems.length ) {
				termElems.forEach( ( termElem ) => {
					hvsfw.swatch.setTermState( termElem, state );
				} );
			}
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
		if ( 0 === totalAttribute ) {
			return;
		}

		let selectData = [];
		let totalValidAttribute = 0;
		let totalInvalidAttribute = 0;
		selectParentElems.forEach( ( selectParentElem ) => {
			const attributeName = selectParentElem.getAttribute( 'data-attribute' );
			if ( attributeName ) {
				const selectElem = selectParentElem.querySelector( 'select' );
				if ( selectElem ) {
					const selectName = selectElem.getAttribute( 'name' );
					const selectedOption = selectElem.querySelector(
						'option[selected="selected"]'
					);
					const selectedValue = selectedOption
						? selectedOption.getAttribute( 'value' )
						: null;
					selectData[ attributeName ] = {
						key: selectName,
						value: selectedValue,
					};

					if ( null === selectedValue ) {
						totalInvalidAttribute += 1;
					} else {
						totalValidAttribute += 1;
					}
				}
			}
		} );

		if ( 0 === totalValidAttribute ) {
			return;
		}

		selectData = Object.entries( selectData );
		if ( 0 === totalInvalidAttribute ) {
			const attributes = [];
			selectData.forEach( ( data ) => {
				attributes[ data[ 1 ].key ] = data[ 1 ].value;
			} );

			const currentVariation = variations.find( ( data ) => {
				return isObject.equal( attributes, data.attributes );
			} );

			let isVariationBuyable = false;
			// eslint-disable-next-line no-undefined
			if ( currentVariation !== undefined ) {
				if ( currentVariation.is_purchasable && currentVariation.is_in_stock ) {
					isVariationBuyable = true;
				}
			}

			selectData.forEach( ( data ) => {
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

		if ( 0 < totalInvalidAttribute ) {
			// Set term state to active.
			selectData.forEach( ( data ) => {
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
		setTimeout( () => {
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
		jQuery( '.hvsfw-term' ).on( 'mouseenter mouseleave', ( e ) => {
			const target = e.target;
			const enable = target.getAttribute( 'data-enable' );

			// Override inline style.
			const state = target.getAttribute( 'data-state' );
			if ( 'yes' === enable && 'default' === state ) {
				const styleEvent = 'mouseenter' === e.type ? 'enter' : 'leave';
				hvsfw.swatch.setTermInlineStyle( target, styleEvent );
			}

			// Showing and hiding tooltip.
			const tooltip = target.getAttribute( 'data-tooltip' );
			if ( 'yes' === enable && 'yes' === tooltip ) {
				const tooltipElem = target.querySelector( '.hvsfw-tooltip' );
				if ( tooltipElem ) {
					const tooltipVisibility = 'mouseenter' === e.type ? 'show' : 'hide';
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
		eventListener( 'click', '.hvsfw-term', ( e ) => {
			const target = e.target;
			const value = target.getAttribute( 'data-value' );
			const state = target.getAttribute( 'data-state' );
			const enable = target.getAttribute( 'data-enable' );
			const attribute = target.getAttribute( 'data-attribute' );
			if ( 'default' !== state || 'yes' !== enable || '' === value || ! attribute ) {
				return;
			}

			const formElem = target.closest( '.variations_form' );
			if ( formElem ) {
				const selectElem = formElem.querySelector(
					`select[name="attribute_${ attribute }"]`
				);
				if ( selectElem ) {
					selectElem.value = value;
					selectElem.dispatchEvent(
						new Event( 'change', {
							bubbles: true,
						} )
					);

					// Set term current & siblings state.
					const attributeElem = target.closest( '.hvsfw-attribute' );
					if ( attributeElem ) {
						const termElems = attributeElem.querySelectorAll(
							'.hvsfw-term:not([data-enable="no"])'
						);
						if ( 0 < termElems.length ) {
							termElems.forEach( ( termElem ) => {
								termElem.setAttribute( 'data-state', 'default' );
								hvsfw.swatch.setTermInlineStyle( termElem, 'leave' );
							} );

							target.setAttribute( 'data-state', 'active' );
							hvsfw.swatch.setTermInlineStyle( target, 'enter' );
						}
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
		eventListener( 'click', '.reset_variations', ( e ) => {
			const target = e.target;

			// Product Single Page.
			const variationForm = target.closest( '.variations_form' );
			if ( variationForm ) {
				// Reset all term state.
				hvsfw.swatch.setAllTermState(
					variationForm,
					'.hvsfw-term[data-state="active"]',
					'default'
				);
			}

			// Product Shop Page.
			const thumbnailElem = target.closest( 'li.product.product-type-variable' );
			if ( thumbnailElem ) {
				const thumbnailVariationForm = thumbnailElem.querySelector( '.variations_form' );
				if ( thumbnailVariationForm ) {
					// Reset thumbnail.
					if ( thumbnailVariationForm.hasAttribute( 'data-image' ) ) {
						const imageElem = thumbnailElem.querySelector(
							'img.attachment-woocommerce_thumbnail'
						);
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
		jQuery( '.variations_form' ).on( 'woocommerce_variation_select_change', ( e ) => {
			const target = e.target;

			setTimeout( () => {
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
		jQuery( '.variations_form' ).on( 'found_variation', ( e, variation ) => {
			const target = e.target;

			// Shop Page or Product Thumbnail.
			const thumbnailElem = target.closest( 'li.product.product-type-variable' );
			if ( thumbnailElem ) {
				// Update thumbnail.
				const imageElem = thumbnailElem.querySelector(
					'img.attachment-woocommerce_thumbnail'
				);
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
	 * @param {Object} thumbnail Contains the current product thumbnail.
	 * @param {Object} variation Contains the current variation found.
	 */
	setButton( thumbnail, variation ) {
		if ( ! thumbnail || ! variation ) {
			return;
		}

		const variationId = variation.variation_id;
		const isBuyable = variation.is_purchasable && variation.is_in_stock;

		// Default: Add to cart.
		const addToCartBtnElem = thumbnail.querySelector( '.hvsfw-js-loop-add-to-cart-btn' );
		if ( addToCartBtnElem ) {
			const availableText = addToCartBtnElem.getAttribute( 'data-available-text' );
			const unavailableText = addToCartBtnElem.getAttribute( 'data-unavailable-text' );

			addToCartBtnElem.textContent = isBuyable ? availableText : unavailableText;
			addToCartBtnElem.setAttribute( 'data-is-available', isBuyable ? 'yes' : 'no' );
			addToCartBtnElem.setAttribute( 'data-variation_id', isBuyable ? variationId : 0 );
		}

		// HAFW: Add to cart button.
		// eslint-disable-next-line no-undef
		if ( hvsfwLocal.plugin.isHAFWActive ) {
			const hafwSwatchBtnElem = thumbnail.querySelector( '.hafw-swatch-btn' );
			if ( hafwSwatchBtnElem ) {
				const hafwBtnDefaultElem = hafwSwatchBtnElem.querySelector( '.hafw-vpl' );
				const hafwBtnSimpleElem = hafwSwatchBtnElem.querySelector( '.hafw-spl' );
				if ( hafwBtnDefaultElem && hafwBtnSimpleElem ) {
					hafwSwatchBtnElem.setAttribute( 'data-type', isBuyable ? 'simple' : 'default' );
					hafwBtnSimpleElem.setAttribute(
						'data-variation_id',
						isBuyable ? variationId : 0
					);
				}
			}
		}
	},

	/**
	 * Reset the add to cart button in shop page.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} thumbnail Contains the current product thumbnail.
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
		// eslint-disable-next-line no-undef
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
		eventListener( 'click', '.hvsfw-js-loop-add-to-cart-btn', async ( e ) => {
			e.preventDefault();
			const target = e.target;
			/* eslint-disable @wordpress/no-unused-vars-before-return */
			const productId = parseInt( target.getAttribute( 'data-product_id' ) );
			const variationId = parseInt( target.getAttribute( 'data-variation_id' ) );
			let quantity = parseInt( target.getAttribute( 'data-quantity' ) );
			/* eslint-enable */

			const isAvailable = target.getAttribute( 'data-is-available' );
			if ( 'no' === isAvailable ) {
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

			quantity = isNaN( quantity ) || 1 > quantity ? 1 : quantity;
			if ( isNaN( productId ) || 0 >= productId ) {
				hvsfw.prompt.errorMessage( 'INVALID_PRODUCT_ERROR' );
				return;
			}

			if ( isNaN( variationId ) || 0 >= variationId ) {
				hvsfw.prompt.errorMessage( 'INVALID_VARIATION_ERROR' );
				return;
			}

			classList.add( 'loading' );
			const res = await getFetch( {
				// eslint-disable-next-line no-undef
				nonce: hvsfwLocal.nonce.variationAddToCart,
				action: 'hvsfw_variation_add_to_cart',
				productId,
				variationId,
				quantity,
			} );

			if ( true === res.success ) {
				if ( 'SUCCESSFULLY_ADDED_TO_CART' === res.data.response ) {
					// Show success notice.
					hvsfw.prompt.notice( res.data.notice );

					/* eslint-disable no-undef */
					if ( hvsfwLocal.plugin.isHATFWActive ) {
						handyToasterNotifier.show( {
							type: 'product',
							title: 'Added To Cart',
							image: res.data.product_thumbnail,
							content: res.data.product_name,
						} );
					}
					/* eslint-enable */

					// Trigger added_to_cart.
					jQuery( document.body ).trigger( 'added_to_cart', [
						res.data.fragments,
						res.data.cart_hash,
					] );

					classList.remove( 'loading' );
					classList.add( 'added' );
					setTimeout( () => {
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
	 * @param {Function} func Contains the callback function.
	 * @return {Function|void} The callback function.
	 */
	execute( func ) {
		if ( 'function' !== typeof func ) {
			return;
		}

		if ( 'interactive' === document.readyState || 'complete' === document.readyState ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute( () => {
	Object.entries( hvsfw ).forEach( ( fragment ) => {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );
