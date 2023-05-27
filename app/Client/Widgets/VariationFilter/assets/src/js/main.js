/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
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
	 * Sets the attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} selector  The element selector.
	 * @param {string} attribute The Attribute to be set.
	 * @param {string} value     The value of the attribute.
	 */
	setAttribute( selector, attribute, value ) {
		if ( ! selector || ! attribute ) {
			return;
		}

		const elems = document.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.setAttribute( attribute, value );
			} );
		}
	},

	/**
	 * Sets the children attribute of target elements.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} parent    The parent element.
	 * @param {string} selector  The element selector.
	 * @param {string} attribute The Attribute to be set.
	 * @param {string} value     The value of the attribute.
	 */
	setChildAttribute( parent, selector, attribute, value ) {
		if ( ! parent || ! selector || ! attribute ) {
			return;
		}

		const elems = parent.querySelectorAll( selector );
		if ( elems.length > 0 ) {
			elems.forEach( function( elem ) {
				elem.setAttribute( attribute, value );
			} );
		}
	},

	/**
	 * Returned the capitalized first letter of the string.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {string}  string  The string to be capitalize. 
	 * @return {string}
	 */
	getUcFirst( string ) {
		return string.charAt( 0 ) .toUpperCase() + string.slice( 1 );
	}
};

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
		hvsfw.fn.eventListener( 'click', '.hvsfw-vf-accordion__toggle-btn', function( e ) {
			e.preventDefault();
			const target = e.target;
			const state = target.getAttribute( 'data-state' );
			const bodyElem = target.closest( '.hvsfw-vf-accordion__header' ).nextElementSibling;
			if ( ! [ 'open', 'close' ].includes( state ) || ! bodyElem ) {
				return;
			}

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
		this.onWidgetUpdated();
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
	 * @param {Object} parent The form parent element.
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
	 * Set all the accordion visibility state based on 
	 * select attribute and select display type.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {Object}  parent  The form parent element.
	 */
	setAllAccordionState( parent ) {
		if ( ! parent ) {
			return;
		}

		const displayType = hvsfw.variationFilter.getDisplayType( parent );
		const accordions = [ 'list', 'select', 'button', 'color', 'image' ];
		accordions.forEach( function( value ) {
			const title = `${ hvsfw.fn.getUcFirst( value ) } Style`;
			const selector = `.hvsfw-vf-accordion[data-title="${ title }"]`;
			const accordion = parent.querySelector( selector );
			if ( accordion ) {
				accordion.setAttribute( 'data-show', ( displayType == value ? 'yes' : 'no' ) );
			}
		});
	},

	/**
	 * Fires an event after widget has been updated.
	 * 
	 * @since 1.0.0
	 */
	onWidgetUpdated() {
		jQuery( document ).on( 'widget-updated', function( e, widget ) {
			if ( widget[0] ) {
				const id = widget[0].getAttribute( 'id' );
				if ( id ) {
					jQuery( `#${ id } .hvsfw-vf-color` ).wpColorPicker({
						change: function( event, ui ) {
							jQuery( event.target ).val( ui.color.toString() );
							jQuery( event.target ).trigger( 'change' );
						}
					});
				}
			}
		});
	},

	/**
	 * Validate the size field after user is finish typing.
	 * 
	 * @since 1.0.0
	 */
	onChangeSizeField() {
		hvsfw.fn.eventListener( 'keyup', '.hvsfw-vf-size', function( e ) {
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
		hvsfw.fn.eventListener( 'change', '[data-input="[general][attribute]"]', function( e ) {
			const target = e.target;
			const parent = target.closest( '.hvsfw-vf' );
			if ( ! parent ) {
				return;
			}

			const updatedType = target.options[ target.selectedIndex ].getAttribute( 'data-type' );
			target.setAttribute( 'data-type', updatedType );
			hvsfw.variationFilter.setAllAccordionState( parent );
		});
	}, 

	/**
	 * Event when select display type is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectDisplayType() {
		hvsfw.fn.eventListener( 'change', '[data-input="[general][display_type]"]', function( e ) {
			const target = e.target;
			const parent = target.closest( '.hvsfw-vf' );
			if ( ! parent ) {
				return;
			}

			hvsfw.variationFilter.setAllAccordionState( parent );
		});
	},

	/**
	 * Event when button select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectButtonShape() {
		hvsfw.fn.eventListener( 'change', '[data-input="[button][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( ! parent || ! value ) {
				return;
			}

			hvsfw.fn.setChildAttribute( parent, '[data-field="[button][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
		});
	},

	/**
	 * Event when color select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectColorShape() {
		hvsfw.fn.eventListener( 'change', '[data-input="[color][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( ! parent || ! value ) {
				return;
			}

			hvsfw.fn.setChildAttribute( parent, '[data-field="[color][size]"]', 'data-show', ( value !== 'custom' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildAttribute( parent, '[data-field="[color][group][size]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildAttribute( parent, '[data-field="[color][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
		});
	},

	/**
	 * Event when image select shape is changed.
	 * 
	 * @since 1.0.0
	 */
	onChangeSelectImageShape() {
		hvsfw.fn.eventListener( 'change', '[data-input="[image][shape]"]', function( e ) {
			const target = e.target;
			const value = target.value;
			const parent = target.closest( '.hvsfw-vf' );
			if ( ! parent || ! value ) {
				return;
			}

			hvsfw.fn.setChildAttribute( parent, '[data-field="[image][size]"]', 'data-show', ( value !== 'custom' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildAttribute( parent, '[data-field="[image][group][size]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
			hvsfw.fn.setChildAttribute( parent, '[data-field="[image][border_radius]"]', 'data-show', ( value === 'custom' ? 'yes' : 'no' ) );
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
    hvsfw.accordion.init(); // Handle the accordion component.
    hvsfw.variationFilter.init(); // Handle the variation filter widget.
} );