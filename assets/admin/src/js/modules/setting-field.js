/**
 * Setting Field Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 * @author Mafel John Cahucom
 */
const settingField = {

	/**
	 * Holds the type field selector.
	 *
	 * @since 1.0.0
	 *
	 * @type {string}
	 */
	type: '',

	/**
	 * Holds the style field selector.
	 *
	 * @since 1.0.0
	 *
	 * @type {string}
	 */
	style: '',

	/**
	 * Holds the shape filed selector.
	 *
	 * @since 1.0.0
	 *
	 * @type {string}
	 */
	shape: '',

	/**
	 * Holds the selector prefix.
	 *
	 * @since 1.0.0
	 *
	 * @type {string}
	 */
	prefix: '',

	/**
	 * Initialize
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} params       Contains the necessary parameters.
	 * @param {string} params.page  The page of this module will be used [ attribute, product ].
	 * @param {string} params.type  The class or selector of select type field.
	 * @param {string} params.style The class or selector of select style field.
	 * @param {string} params.shape The class or selector of select shape field.
	 */
	init( params ) {
		if ( ! params.page || ! params.type || ! params.style || ! params.shape ) {
			return;
		}

		// Set properties.
		this.page = params.page;
		this.type = params.type;
		this.style = params.style;
		this.shape = params.shape;

		// Load events.
		this.onChangeTypeField();
		this.onChangeStyleField();
		this.onChangeShapeField();
	},

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
	 * @param {Array} array Containing the array to be filtered.
	 * @param {Array} item  The item to be removed in array.
	 * @return {Array} The filtered array.
	 */
	removeArrayItem( array, item ) {
		return array.filter( function( value ) {
			return value !== item;
		} );
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
					id: 'style',
					type: 'select',
					default: 'default',
				},
			],
			shape: [
				{
					id: 'shape',
					type: 'select',
					default: 'square',
				},
			],
			size: [
				{
					id: 'size',
					type: 'size',
					default: '40px',
				},
			],
			dimension: [
				{
					id: 'width',
					type: 'size',
					default: '40px',
				},
				{
					id: 'height',
					type: 'size',
					default: '40px',
				},
			],
			font: [
				{
					id: 'font_size',
					type: 'size',
					default: '14px',
				},
				{
					id: 'font_weight',
					type: 'select',
					default: '500',
				},
			],
			text_color: [
				{
					id: 'font_color',
					type: 'color',
					default: '#000000',
				},
				{
					id: 'font_hover_color',
					type: 'color',
					default: '#0071f2',
				},
			],
			background_color: [
				{
					id: 'background_color',
					type: 'color',
					default: '#ffffff',
				},
				{
					id: 'background_hover_color',
					type: 'color',
					default: '#ffffff',
				},
			],
			padding: [
				{
					id: 'padding_top',
					type: 'size',
					default: '5px',
				},
				{
					id: 'padding_bottom',
					type: 'size',
					default: '5px',
				},
				{
					id: 'padding_left',
					type: 'size',
					default: '5px',
				},
				{
					id: 'padding_right',
					type: 'size',
					default: '5px',
				},
			],
			border: [
				{
					id: 'border_style',
					type: 'select',
					default: 'solid',
				},
				{
					id: 'border_width',
					type: 'size',
					default: '1px',
				},
				{
					id: 'border_color',
					type: 'color',
					default: '#000000',
				},
				{
					id: 'border_hover_color',
					type: 'color',
					default: '#0071f2',
				},
			],
			border_radius: [
				{
					id: 'border_radius',
					type: 'size',
					default: '0px',
				},
			],
			gap: [
				{
					id: 'gap',
					type: 'size',
					default: '10px'
				}
			]
		};
	},

	/**
	 * Return the list of group field.
	 *
	 * @since 1.0.0
	 *
	 * @return {Array} List of group field.
	 */
	getGroupFields() {
		return [
			'shape', 'size', 'dimension', 'font', 'text_color',
			'background_color', 'padding', 'border', 'border_radius', 'gap'
		];
	},

	/**
	 * Return the list of fields based on the type.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} type The type value.
	 * @return {Array} List of fields on specific type.
	 */
	getFieldsByType( type ) {
		if ( ! type ) {
			return;
		}

		const fields = {
			button: [
				'shape', 'dimension', 'font', 'text_color',
				'background_color', 'padding', 'border', 'gap'
			],
			color: [
				'shape', 'size', 'border', 'gap'
			],
			image: [
				'shape', 'size', 'border', 'gap'
			],
		};

		return fields[ type ];
	},

	/**
	 * Return the type element selector.
	 *
	 * @since 1.0.0
	 *
	 * @return {string} The type selector.
	 */
	getTypeSelector() {
		let typeSelector = settingField.type;
		if ( settingField.page === 'product' ) {
			typeSelector = `.hvsfw-setting-field-type[data-prefix="${ settingField.prefix }"]`;
		}

		return typeSelector;
	},

	/**
	 * Set a certain field's default value.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array} field Contains the field schema id, type and default value.
	 */
	setFieldDefaultValue( field ) {
		if ( ! field ) {
			return;
		}

		const selector = settingField.prefix + '_' + field.id;
		const fieldElem = document.getElementById( selector );
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
				jQuery( fieldElem ).iris( 'color', field.default );
				break;
		}
	},

	/**
	 * Set all fields default value.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array} fields Containing the fields to be set its value to default.
	 */
	setAllFieldDefaultValue( fields = [] ) {
		Object.entries( this.getFieldSchema() ).forEach( function( schema ) {
			if ( fields ) {
				if ( fields.includes( schema[ 0 ] ) ) {
					schema[ 1 ].forEach( function( field ) {
						settingField.setFieldDefaultValue( field );
					} );
				}
			}
		} );
	},

	/**
	 * Set each group field visibility.
	 *
	 * @since 1.0.0
	 *
	 * @param {Array}  groups     Contains the names of the group field to be modified.
	 * @param {string} visibility The updated visibility state.
	 */
	setGroupFieldsVisibility( groups, visibility ) {
		if ( groups && visibility ) {
			groups.forEach( function( group ) {
				settingField.setAttribute( `[data-group-field="${ settingField.prefix }_${ group }"]`, 'data-visible', visibility );
			} );
		}
	},

	/**
	 * Update all fields state that are dependent in type field.
	 *
	 * @since 1.0.0
	 */
	onChangeTypeField() {
		this.eventListener( 'change', this.type, function( e ) {
			const target = e.target;
			const type = target.value;
			const prefix = target.getAttribute( 'data-prefix' );
			const validTypes = [ 'default', 'select', 'button', 'color', 'image', 'assorted' ];
			if ( ! prefix || ! validTypes.includes( type ) ) {
				return;
			}

			// Set prefix property.
			settingField.prefix = prefix;

			const styleElem = document.getElementById( `${ prefix }_style` );
			if ( ! styleElem ) {
				return;
			}

			const groups = settingField.getGroupFields();
			if ( [ 'default', 'select', 'assorted' ].includes( type ) ) {
				groups.push( 'style' );
				settingField.setGroupFieldsVisibility( groups, 'no' );
				return;
			}

			settingField.setGroupFieldsVisibility( [ 'style' ], 'yes' );
			const style = styleElem.value;
			if ( ! [ 'default', 'custom' ].includes( style ) ) {
				return;
			}

			if ( style === 'default' ) {
				return;
			}

			settingField.setGroupFieldsVisibility( groups, 'no' );

			groups.push( 'style' );
			settingField.setAllFieldDefaultValue( groups );
		} );
	},

	/**
	 * Update all fields state that are dependent in style field.
	 *
	 * @since 1.0.0
	 */
	onChangeStyleField() {
		this.eventListener( 'change', this.style, function( e ) {
			const target = e.target;
			const style = target.value;
			const prefix = target.getAttribute( 'data-prefix' );
			if ( ! prefix || ! [ 'default', 'custom' ].includes( style ) ) {
				return;
			}

			// Set prefix property.
			settingField.prefix = prefix;

			const typeElem = document.querySelector( settingField.getTypeSelector() );
			if ( ! typeElem ) {
				return;
			}

			const type = typeElem.value;
			if ( ! [ 'button', 'color', 'image' ].includes( type ) ) {
				return;
			}

			const groups = settingField.getGroupFields();
			const fields = settingField.getFieldsByType( type );

			settingField.setGroupFieldsVisibility( groups, 'no' );
			settingField.setGroupFieldsVisibility( fields, ( style === 'custom' ? 'yes' : 'no' ) );

			fields.push( 'dimension', 'border_radius' );
			settingField.setAllFieldDefaultValue( fields );
		} );
	},

	/**
	 * Update all fields state that are dependent in shape field.
	 *
	 * @since 1.0.0
	 */
	onChangeShapeField() {
		this.eventListener( 'change', this.shape, function( e ) {
			const target = e.target;
			const shape = target.value;
			const prefix = target.getAttribute( 'data-prefix' );
			if ( ! prefix || ! [ 'square', 'circle', 'custom' ].includes( shape ) ) {
				return;
			}

			// Set prefix property.
			settingField.prefix = prefix;

			const typeElem = document.querySelector( settingField.getTypeSelector() );
			if ( ! typeElem ) {
				return;
			}

			const type = typeElem.value;
			if ( ! [ 'button', 'color', 'image' ].includes( type ) ) {
				return;
			}

			const groups = settingField.removeArrayItem( settingField.getGroupFields(), 'shape' );
			const fields = settingField.getFieldsByType( type );

			settingField.setGroupFieldsVisibility( groups, 'no' );
			settingField.setGroupFieldsVisibility( fields, 'yes' );
			if ( shape === 'custom' ) {
				settingField.setAttribute( `[data-group-field="${ prefix }_border_radius"]`, 'data-visible', 'yes' );

				if ( [ 'color', 'image' ].includes( type ) ) {
					settingField.setAttribute( `[data-group-field="${ prefix }_size"]`, 'data-visible', 'no' );
					settingField.setAttribute( `[data-group-field="${ prefix }_dimension"]`, 'data-visible', 'yes' );
				}
			}
		} );
	},
};

export default settingField;
