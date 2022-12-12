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
 * Holds the color swatch setting form.
 *
 * @since 1.0.0
 * 
 * @type {Object}
 */
hvsfw.colorPicker = {

    /**
     * Holds the color picker parent element.
     *
     * @since 1.0.0
     * 
     * @type {Object}
     */
    parentElem: null,

    /**
     * Holds the color picker list element.
     *
     * @since 1.0.0
     * 
     * @type {Object}
     */
    listElem: null,

    /**
     * Initialize.
     *
     * @since 1.0.0
     */
    init() {
        if ( ! this.constructor() ) {
            return;
        }

        this.setOnLoad();
        this.addNew();
        this.delete();
    },

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    constructor() {
        // Set all element property.
        if ( ! this.setElementProperties() ) {
            return false;
        }

        return true;
    },

    /**
     * Set all element property values.
     *
     * @since 1.0.0
     *
     * @return {boolean} Check if all property element has a value.
     */
    setElementProperties() {
        // Set parentElem property.
        const parentElem = document.getElementById( 'hvsfw-color-picker' );
        if ( ! parentElem ) {
            return false;
        }

        hvsfw.colorPicker.parentElem = parentElem;

        // Set listElem property.
        const listElem = parentElem.querySelector( '.hvsfw-color-picker__list' );
        if ( ! listElem ) {
            return false;
        }

        hvsfw.colorPicker.listElem = listElem;

        return true;
    },

    /**
     * Set the color picker.
     *
     * @since 1.0.0
     * 
     * @param {integer} id The id of the color picker or the item number.
     */
    setColorPicker( id ) {
        if ( ! id ) {
            return;
        }

        jQuery( `.hvsfw-color-picker-input[data-item="${ id }"]` ).wpColorPicker();
    },

    /**
     * Return the current total count of color picker fields.
     *
     * @since 1.0.0
     * 
     * @return {integer} The total count of color picker fields.
     */
    getTotalItem() {
        const parentElem = hvsfw.colorPicker.parentElem;
        const totalItems = parseInt( parentElem.getAttribute( 'data-count' ) );

        return ( isNaN( totalItems ) ? 0 : totalItems );
    },

    /**
     * Returns the new created color picker component element.
     *
     * @since 1.0.0
     * 
     * @param  {integer} id  Contains the color picker id or item number. 
     * @return {HTMLElement} Color picker component.
     */
    fieldComponent( id ) {
        if ( ! id ) {
            return;
        }

        const element = document.createElement( 'div' );
        element.className = 'hvsfw-color-picker__item';
        element.setAttribute( 'data-item', id );
        element.innerHTML = `
            <div class="hvsfw-col__left">
                <input type="text" name="hvsfw_colors[]" class="hvsfw-color-picker-input" data-item="${ id }" value="#ffffff">
            </div>
            <div class="hvsfw-col__right">
                <button type="button" class="hvsfw-js-color-picker-delete-btn hvsfw-color-picker__delete-btn button" data-item="${ id }">Delete</button>
            </div>
        `;

        return element;
    },

    /**
     * Set the color picker field on load.
     *
     * @since 1.0.0
     */
    setOnLoad() {
        const totalItems = hvsfw.colorPicker.getTotalItem();

        for( let i = 1; i <= totalItems; i++ ) {
            hvsfw.colorPicker.setColorPicker( i );
        }
    },

    /**
     * Add new color picker input field.
     *
     * @since 1.0.0
     */
    addNew() {
        hvsfw.fn.eventListener( 'click', '.hvsfw-js-color-picker-add-btn', function( e ) {
            e.preventDefault();
            const parentElem = hvsfw.colorPicker.parentElem;
            const listElem = hvsfw.colorPicker.listElem;
            const totalItems = hvsfw.colorPicker.getTotalItem() + 1;
            const fieldComponent = hvsfw.colorPicker.fieldComponent( totalItems );

            parentElem.setAttribute( 'data-count', totalItems );
            listElem.appendChild( fieldComponent );
            hvsfw.colorPicker.setColorPicker( totalItems );
        });
    },

    /**
     * Delete a certain color picker.
     *
     * @since 1.0.0
     */
    delete() {
        hvsfw.fn.eventListener( 'click', '.hvsfw-js-color-picker-delete-btn', function( e ) {
            e.preventDefault();
            const target = e.target;
            const item = target.getAttribute( 'data-item' );
            const itemElem = target.closest( `.hvsfw-color-picker__item[data-item="${ item }"]` );
            if ( itemElem ) {
                itemElem.remove();
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
    hvsfw.colorPicker.init(); // Handle the color swatch setting form events.
} );