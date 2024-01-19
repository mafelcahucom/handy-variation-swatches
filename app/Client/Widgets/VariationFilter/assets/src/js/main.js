/**
 * Internal Dependencies.
 */
import {
	getUCFirst,
	setAttribute, 
	eventListener 
} from "../../../../../../../assets/helpers";

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
 * Holds Accordion Component.
 * 
 * @since 1.0.0
 * 
 * @type {Object}
 */
hvsfw.accordion = {

    /**
     * Initialize.
     * 
     * @since 1.0.0
     */
    init() {
		this.toggle();
    },

    /**
	 * Toggle accordion.
	 *
	 * @since 1.0.0
	 */
	toggle() {
		eventListener( 'click', '.hvsfw-vf-accordion__toggle-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const bodyElem = target.closest( '.hvsfw-vf-accordion__header' ).nextElementSibling;
			if ( bodyElem && [ 'open', 'close' ].includes( state ) ) {
				bodyElem.style.maxHeight = bodyElem.scrollHeight + 'px';
				if ( state === 'open' ) {
					setTimeout( function() {
						bodyElem.style.maxHeight = null;
					}, 300 );
					target.setAttribute( 'data-state', 'close' );
					bodyElem.setAttribute( 'data-state', 'close' );
				} else {
					setTimeout( function() {
						bodyElem.style.maxHeight = 'max-content';
					}, 500 );
					target.setAttribute( 'data-state', 'open' );
					bodyElem.setAttribute( 'data-state', 'open' );
				}
			}
		} );
	},
};

/**
 * Holds Variation Filter Widget.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.variationFilter = {

	/**
	 * Holds onchange size timer.
	 *
	 * @since 1.0.0
	 * 
	 * @type {number}
	 */
	timer: null,

    /**
     * Initialize.
     * 
     * @since 1.0.0
     */
    init() {
		this.setColorPickerField();
		this.onWidgetAddedAndUpdated();
       	this.onChangeSizeField();
		this.onChangeSelectAttribute();
		this.onChangeSelectDisplayType();
		this.onChangeSelectButtonShape();
		this.onChangeSelectColorShape();
		this.onChangeSelectImageShape();
    },

	/**
	 * Return the final display type based on attribute type and display type.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} parent Contains the form parent element.
	 */
	getDisplayType( parent ) {
		if ( ! parent ) {
			return;
		}

		const attributeElem = parent.querySelector( '[data-input="[general][attribute]"]' );
		const displayTypeElem = parent.querySelector( '[data-input="[general][display_type]"]' );
		if ( ! attributeElem || ! displayTypeElem ) {
			return;
		}

		const attributeType = attributeElem.getAttribute( 'data-type' );
		const displayType = displayTypeElem.value;
		if ( ! attributeType || ! displayType ) {
			return;
		}

		if ( displayType !== 'swatch' ) {
			return displayType;
		}

		if ( [ 'button', 'color', 'image' ].includes( attributeType ) ) {
			return attributeType;
		}

		return 'select';
	},

	/**
	 * Bind wpColorPicker to color picker fields.
	 * 
	 * @since 1.0.0
	 */
	setColorPickerField() {
		jQuery( '.hvsfw-vf-color' ).wpColorPicker({
			change: function( event, ui ) {
				jQuery( event.target ).val( ui.color.toString() );
				jQuery( event.target ).trigger( 'change' );
			}
		});
	},

	/**
	 * Set all the accordion visibility state based on select attribute 
	 * and select display type.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object} parent Contains form parent element.
	 */
	setAllAccordionState( parent ) {
		if ( parent ) {
			const displayType = hvsfw.variationFilter.getDisplayType( parent );
			const accordions = [ 'list', 'select', 'button', 'color', 'image' ];
			accordions.forEach( function( value ) {
				const title = `${ getUCFirst( value ) } Style`;
				const selector = `.hvsfw-vf-accordion[data-title="${ title }"]`;
				const accordion = parent.querySelector( selector );
				if ( accordion ) {
					accordion.setAttribute( 'data-show', ( displayType == value ? 'yes' : 'no' ) );
				}
			});
		}
	},

	/**
	 * Fires an event after widget has been added and updated.
	 * 
	 * @since 1.0.0
	 */
	onWidgetAddedAndUpdated() {
		jQuery( document ).on( 'widget-added widget-updated', function( e, widget ) {
			widget.find( '.hvsfw-vf-color' ).wpColorPicker( {
				change: function( event, ui ) {
					jQuery( event.target ).val( ui.color.toString() );
					jQuery( event.target ).trigger( 'change' );
				}
			} );
		});
	},

	/**
	 * Validate the size field after user is finish typing.
	 * 
	 * @since 1.0.0
	 */
	onChangeSizeField() {
		eventListener( 'keyup', '.hvsfw-vf-size', function( e ) {
			const target = e.target;
			const value = target.value;

			clearTimeout( hvsfw.variationFilter.timer );
			hvsfw.variationFilter.timer = setTimeout( function() {
				if ( value.length !== 0 ) {
					const unit = value.replace(/[0-9]/g, '');
					const number = value.match(/\d+/);
					
					if ( number === null ) {
						target.value = '0px';
						return;
					}

					if ( unit.length !== 0 ) {
						const units = [
							'cm', 'mm', 'in', 'px', 'pt', 'pc', 'em', 'ex', 
							'ch', 'rem', 'vw', 'vh', 'vmin', 'vmax', '%'
						];

						if ( units.includes( unit ) ) {
							target.value = `${ number[0] }${ unit }`;
							return;
						}
					}
					
					target.value = number;
					return;
				}
					
				target.value = '0px';
			}, 1000 );
		});
	},

	/**
	 * Event when select product attribute is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectAttribute() {
		eventListener( 'change', '[data-input="[general][attribute]"]', function( e ) {
			const target = e.target;
			const parent = target.closest( '.hvsfw-vf' );
			if ( parent ) {
				const updatedType = target.options[ target.selectedIndex ].getAttribute( 'data-type' );
				target.setAttribute( 'data-type', updatedType );
				hvsfw.variationFilter.setAllAccordionState( parent );
			}
		});
	}, 

	/**
	 * Event when select display type is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectDisplayType() {
		eventListener( 'change', '[data-input="[general][display_type]"]', function( e ) {
			const target = e.target;
			const parent = target.closest( '.hvsfw-vf' );
			if ( parent ) {
				hvsfw.variationFilter.setAllAccordionState( parent );
			}
		});
	},

	/**
	 * Event when button select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectButtonShape() {
		eventListener( 'change', '[data-input="[button][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( parent && value ) {
				setAttribute.child( parent, '[data-field="[button][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
			}
		});
	},

	/**
	 * Event when color select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectColorShape() {
		eventListener( 'change', '[data-input="[color][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( parent && value ) {
				setAttribute.child( parent, '[data-field="[color][size]"]', 'data-show', ( value !== 'custom' ? 'yes' : 'no' ) );
				setAttribute.child( parent, '[data-field="[color][group][size]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
				setAttribute.child( parent, '[data-field="[color][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
			}
		});
	},

	/**
	 * Event when image select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectImageShape() {
		eventListener( 'change', '[data-input="[image][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( parent && value ) {
				setAttribute.child( parent, '[data-field="[image][size]"]', 'data-show', ( value !== 'custom' ? 'yes' : 'no' ) );
				setAttribute.child( parent, '[data-field="[image][group][size]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
				setAttribute.child( parent, '[data-field="[image][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
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
	 * @param {Function} func Contains the callback function.
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

/**
 * Initialize Widget.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute( function() {
	Object.entries( hvsfw ).forEach( function( fragment ) {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );