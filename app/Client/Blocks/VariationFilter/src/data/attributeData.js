/**
 * Product Attributes Data.
 * 
 * @since 1.0.0
 * 
 * @type   {Object}
 * @author Mafel John Cahucom
 */
const data = {
    
    /**
	 * Checks if there's an available variation attributes.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {boolean} The flag whether the variation attributes is empty.
	 */
	isEmpty: () => {
		return data.getAll().length === 0;
	},

	/**
	 * Checks if the attribute name is found in product attributes.
	 * 
	 * @since 1.0.0
	 * 
	 * @param  {string} name Contains the name of the product attribute.
	 * @return {boolean} The flag whether the key is exists.
	 */
	isFound: ( name ) => {
		if ( ! name ) {
			return false;
		}

		return Object.keys( data.get( name ) ).length > 0;
	},

    /**
	 * Returns all the product attributes into an array.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {Array} The converted array attributes.
	 */
	getAll: () => {
        const attributes = window.hvsfwVfData.productAttributes;
        if ( attributes === null || attributes === undefined ) {
            return [];
        }

		return Object.entries( attributes ).map( ( attribute ) => {
			return attribute[1];
		});
	},

	/**
	 * Returns certain product attribute based on attribute name.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {string} name Contains the name of the product attribute.
	 */
	get: ( name ) => {
		if ( ! name || data.getAll().length === 0 ) {
			return {};
		}

		const found = data.getAll().filter( ( attribute ) => {
			return attribute.attribute_name === name;
		});

		return ( found.length > 0 ? found[0] : {} );
	},

    /**
	 * Returns the product attribute value and label.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {Array} Contains the SelectControl options.
	 */
	getSelectOptions: () => {
		const options = [];
        
        if ( ! data.isEmpty() ) {
            data.getAll().forEach( ( attribute ) => {
                options.push( {
                    value: attribute.attribute_name,
                    label: attribute.attribute_label
                });
            });
        }

		return options;
	}
};

export { data as attributeData };