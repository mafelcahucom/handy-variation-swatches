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
        if ( elems.length === 0 ) {
            return;
        }

        elems.forEach( function( elem ) {
            elem.setAttribute( attribute, value );
        } );
    },

    /**
     * Remove a specific item in an array.
     *
     * @since 1.0.0
     * 
     * @param  {array} array Containing the array to be filtered.
     * @param  {mixed} item  The item to be removed in array.
     * @return {array} The filtered array.
     */
    removeArrayItem( array, item ) {
        return array.filter( function( value ) {
            return value !== item;
        });
    }
};

/**
 * Holds the product attribute swatch setting form.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
hvsfw.form = {

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init() {
        this.colorPicker();
        this.onChangeTypeField();
        this.onChangeStyleField();
        this.onChangeShapeField();
    },

    /**
     * Return the fields schema.
     *
     * @since 1.0.0
     * 
     * @return {Object} The fields schema.
     */
    getFieldSchema() {
        return {
            style: [
                {
                    id: 'hvsfw_style',
                    type: 'select',
                    default: 'default'
                }
            ],
            shape: [
                {
                    id: 'hvsfw_shape',
                    type: 'select',
                    default: 'square',
                }
            ],
            size: [
                {
                    id: 'hvsfw_size',
                    type: 'size',
                    default: '40px'
                }
            ],
            dimension: [
                {
                    id: 'hvsfw_width',
                    type: 'size',
                    default: '40px'
                },
                {
                    id: 'hvsfw_height',
                    type: 'size',
                    default: '40px'
                }
            ],
            font: [
                {
                    id: 'hvsfw_font_size',
                    type: 'size',
                    default: '14px'
                },
                {
                    id: 'hvsfw_font_weight',
                    type: 'select',
                    default: '500'
                }
            ],
            textColor: [
                {
                    id: 'hvsfw_font_color',
                    type: 'color',
                    default: '#000000'
                },
                {
                    id: 'hvsfw_font_hover_color',
                    type: 'color',
                    default: '#0071f2'
                }
            ],
            backgroundColor: [
                {
                    id: 'hvsfw_bg_color',
                    type: 'color',
                    default: '#ffffff'
                },
                {
                    id: 'hvsfw_bg_hover_color',
                    type: 'color',
                    default: '#ffffff'
                }
            ],
            padding: [
                {
                    id: 'hvsfw_padding_top',
                    type: 'text',
                    default: '5px'
                },
                {
                    id: 'hvsfw_padding_bottom',
                    type: 'text',
                    default: '5px'
                },
                {
                    id: 'hvsfw_padding_left',
                    type: 'text',
                    default: '5px'
                },
                {
                    id: 'hvsfw_padding_right',
                    type: 'text',
                    default: '5px'
                }
            ],
            border: [
                {
                    id: 'hvsfw_border_style',
                    type: 'select',
                    default: 'solid'
                },
                {
                    id: 'hvsfw_border_width',
                    type: 'size',
                    default: '1px'
                },
                {
                    id: 'hvsfw_border_color',
                    type: 'color',
                    default: '#000000'
                },
                {
                    id: 'hvsfw_border_hover_color',
                    type: 'color',
                    default: '#0071f2'
                }
            ],
            borderRadius: [
                {
                    id: 'hvsfw_border_radius',
                    type: 'size',
                    default: '0px'
                }
            ]
        };
    },

    /**
     * Return the list of fields.
     *
     * @since 1.0.0
     * 
     * @return {array} List of fields.
     */
    getAllFields() {
        return [
            'shape', 'size', 'dimension', 'font', 'textColor',
            'backgroundColor', 'padding', 'border', 'borderRadius' 
        ];
    },

    /**
     * Return the list of fields based on the swatch type.
     *
     * @since 1.0.0
     * 
     * @param  {string} type The type of swatch.
     * @return {array} List of fields on specific swatch type.
     */
    getSwatchTypeFields( type ) {
        if ( ! type ) {
            return;
        }

        const fields = {
            button: [
                'shape', 'dimension', 'font', 'textColor', 
                'backgroundColor', 'padding', 'border'
            ],
            color: [
                'shape', 'size', 'border'
            ],
            image: [
                'shape', 'size', 'border'
            ]
        };

        return fields[ type ];
    },

    /**
     * Set a certain field its default value.
     *
     * @since 1.0.0
     * 
     * @param {array} field Contains the field id, type and default value.
     */
    setFieldDefaultValue( field ) {
        if ( ! field ) {
            return;
        }

        const fieldElem = document.getElementById( field.id );
        if ( ! fieldElem ) {
            return;
        }

        switch ( field.type ) {
            case 'size':
                fieldElem.value = field.default;
                break;
            case 'select':
                fieldElem.value = field.default;
                break;
            case 'color':
                jQuery( `#${ field.id }` ).iris( 'color', field.default );
                break;
        }
    },

    /**
     * Set all the fields to its default value.
     *
     * @since 1.0.0
     * 
     * @param {array} fields Containing the fields to be set its value to default.
     */
    setAllFieldDefaultValue( fields = [] ) {
        Object.entries( this.getFieldSchema() ).forEach( function( schema ) {
            if ( fields ) {
                if ( fields.includes( schema[0] ) ) {
                    schema[1].forEach( function( field ) {
                        hvsfw.form.setFieldDefaultValue( field );
                    });
                }
            }
        });
    },

    /**
     * Set the field state for visibility.
     *
     * @since 1.0.0
     * 
     * @param {array}  fields Contains the list of fields to be modify state.
     * @param {string} state  The update state.
     */
    setAllFieldState( fields, state ) {
        if ( ! fields || ! state ) {
            return;
        }

        fields.forEach( function( field ) {
            hvsfw.fn.setAttribute( `.hvsfw-field[data-field="${ field }"]`, 'data-state', state );
        });
    },

    /**
     * Color Picker Field.
     *
     * @since 1.0.0
     */
    colorPicker() {
        const colorPickerElems = document.querySelectorAll( '.hvsfw-color-picker' );
        if ( colorPickerElems.length === 0 ) {
            return;
        }

        jQuery( '.hvsfw-color-picker' ).wpColorPicker({
            mode: 'hsl'
        });
    },

    /**
     * Update all fields state that are dependent in type field.
     *
     * @since 1.0.0
     */
    onChangeTypeField() {
        hvsfw.fn.eventListener( 'change', '#hvsfw_type', function( e ) {
            const target = e.target;
            const type = target.value;
            const styleElem = document.getElementById( 'hvsfw_style' );
            if ( ! styleElem || ! [ 'button', 'color', 'image' ].includes( type ) ) {
                return;
            }

            const style = styleElem.value;
            if ( ! [ 'default', 'custom' ].includes( style ) ) {
                return;
            }

            if ( style === 'default' ) {
                return;
            }

            const fields = hvsfw.form.getAllFields();

            hvsfw.form.setAllFieldState( fields, 'hide' );

            fields.push( 'style' );
            hvsfw.form.setAllFieldDefaultValue( fields );
        });
    },

    /**
     * Update all fields state that are dependent in style field.
     *
     * @since 1.0.0
     */
    onChangeStyleField() {
        hvsfw.fn.eventListener( 'change', '#hvsfw_style', function( e ) {
            const target = e.target;
            const style = target.value;
            const typeElem = document.getElementById( 'hvsfw_type' );
            if ( ! typeElem || ! [ 'default', 'custom' ].includes( style ) ) {
                return;
            }

            const type = typeElem.value;
            if ( ! [ 'button', 'color', 'image' ].includes( type ) ) {
                return;
            }

            const fields = hvsfw.form.getAllFields();
            const swatchFields = hvsfw.form.getSwatchTypeFields( type );

            hvsfw.form.setAllFieldState( fields, 'hide' );
            hvsfw.form.setAllFieldState( swatchFields, ( style === 'custom' ? 'show' : 'hide' ) );
            hvsfw.form.setAllFieldDefaultValue( swatchFields );
        });
    },

    /**
     * Update all fields state that are dependent in shape field.
     *
     * @since 1.0.0
     */
    onChangeShapeField() {
        hvsfw.fn.eventListener( 'change', '#hvsfw_shape', function( e ) {
            const target = e.target;
            const shape = target.value;
            const typeElem = document.getElementById( 'hvsfw_type' );
            if ( ! typeElem || ! [ 'square', 'circle', 'custom' ].includes( shape ) ) {
                return;
            }

            const type = typeElem.value;
            if ( ! [ 'button', 'color', 'image' ].includes( type ) ) {
                return;
            }

            const fields = hvsfw.fn.removeArrayItem( hvsfw.form.getAllFields(), 'shape' );
            const swatchFields = hvsfw.form.getSwatchTypeFields( type );

            hvsfw.form.setAllFieldState( fields, 'hide' );
            hvsfw.form.setAllFieldState( swatchFields, 'show' );
            if ( shape === 'custom' ) {
                hvsfw.fn.setAttribute( '.hvsfw-field[data-field="borderRadius"]', 'data-state', 'show' );

                if ( [ 'square', 'circle' ] ) {
                    hvsfw.fn.setAttribute( '.hvsfw-field[data-field="size"]', 'data-state', 'hide' );
                    hvsfw.fn.setAttribute( '.hvsfw-field[data-field="dimension"]', 'data-state', 'show' );
                }
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
    hvsfw.form.init(); // Handle the swatch setting form events.
} );