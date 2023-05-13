/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';
import { useState, useEffect } from '@wordpress/element';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import {
	Flex,
	FlexItem,
	Panel,
	PanelBody,
	Placeholder,
	BaseControl,
	SelectControl,
	TextControl,
	ColorPalette,
	ToggleControl,
	__experimentalGrid as Grid,
	__experimentalBoxControl as BoxControl,
	__experimentalUnitControl as UnitControl,
	__experimentalBorderBoxControl as BorderBoxControl,
	__experimentalToggleGroupControl as ToggleGroupControl,
    __experimentalToggleGroupControlOption as ToggleGroupControlOption,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import getFetch from './lib/getFetch';
import { helper } from './utils/Helper';
import { generalData } from './data/generalData';
import { attributeData } from './data/attributeData';
import {
	Section,
	Field,
	SearchList,
	SwatchList,
	SwatchSelect
} from './components';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId } ) {
	const blockProps = useBlockProps();
	const { 
		blockId,
		productAttributes,
		settings,
		searchList,
		title, 
		list,
		select
	} = attributes;

	const hasAttribute = attributeData.isFound( settings.attribute );
	
	/**
	 * Handle multiple input value.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {String} objectName 	The target object name in setAttributes.
	 * @param {String} propertyName The target property key of object.
	 * @param {String} newValue		The new value from input. 
	 */
	const handleValue = ( objectName, propertyName, newValue ) => {
		const { [ objectName ]: object } = attributes;
		setAttributes( { [ objectName ]: { ...object, [ propertyName ]: newValue } } );
	};

	/**
	 * Handle multiple input size.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {String} objectName 	The target object name in setAttributes
	 * @param {String} propertyName The target property key of object.
	 * @param {String} newSize		The new size from input size. 
	 */
	const handleSize = ( objectName, propertyName, newSize ) => {
		const { [ objectName ]: object } = attributes;
		setAttributes( { [ objectName ]: { ...object, [ propertyName ]: newSize } } );

		clearTimeout( generalData.timeout );
		generalData.timeout = setTimeout( () => {
			const validatedSize = helper.getValidateUnitSize( newSize );
			setAttributes( { [ objectName ]: { ...object, [ propertyName ]: validatedSize } } );
		}, 1000 );
	};

	/**
	 * Return the final display type based on block displayType and
	 * product attribute_type.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {String} The final display type.
	 */
	const getDisplayType = () => {
		const { attribute, displayType } = settings;

		if ( displayType === 'swatch' ) {
			const currentAttribute = attributeData.get( attribute );
			if ( ! helper.isObjectEmpty( currentAttribute ) ) {
				const displayTypes = [ 'button', 'color', 'image', 'select' ];
				if ( displayTypes.includes( currentAttribute.attribute_type ) ) {
					return currentAttribute.attribute_type;
				}
			}
		}

		return ( displayType !== 'swatch' ? displayType : 'select' );
	};

	/**
	 * Return the title text and set when first added in editor.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {String} The title text.
	 */
	const getTitleText = () => {
		if ( title.text !== null ) {
			return title.text;
		}

		const attribute = attributeData.get( settings.attribute );
		const newText = `Filter By ${ attribute.attribute_label }`;

		setAttributes( { title: { ...title, text: newText } } );
		return newText;
	};

	/**
	 * Returns the title inline style.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {Object} The title style.
	 */
	const getTitleStyle = () => {
		const { text, ...rest } = title;
		rest.display = 'block';
		
		return rest;
	};

	/**
	 * Use Effect Hoock.
	 * 
	 * @since 1.0.0
	 */
	useEffect( () => {
		/**
		 * Set the block attribute blockId.
		 * 
		 * @since 1.0.0
		 */
		const setBlockId = () => {
			if ( ! blockId ) {
				setAttributes( { blockId: clientId } );
			}
		};
		setBlockId();

		/**
		 * Set the block attribute productAttributes and
		 * localize it also in window.
		 * 
		 * @since 1.0.0
		 */
		const setProductAttributes = async () => {
			if ( window.hbvfData.productAttributes === undefined ) {
				const res = await getFetch( {
					nonce: hbvfData.nonce.getProductAttributes,
					action: 'hbvf_get_product_attributes'
				} );

				if ( res.success === true && res.data.response === 'SUCCESS' ) {
					setAttributes( { productAttributes: res.data.attributes } );
					window.hbvfData.productAttributes = res.data.attributes;
				}
			} else {
				setAttributes( { productAttributes: window.hbvfData.productAttributes } );
			}

			// Update searchList component state.
			setAttributes( { searchList: { ...searchList, state: 'default' } } );

			console.log( attributeData.getAll() );
		};
		setProductAttributes();

		
	}, [ productAttributes ] );

	return (
		<>
			<InspectorControls>
				<Panel>
					<Section>
						<PanelBody title="Product Attribute" initialOpen={ false }>
							<Field>
								<SearchList
									attributes={ attributes }
									setAttributes={ setAttributes }
									label={ __(
										'Search For A Product Attribute',
										'variation-filter'
									) }
								/>
							</Field>
						</PanelBody>
					</Section>
					<Section isShow={ hasAttribute }>
						<PanelBody title="General" initialOpen={ false }>
							<Field>
								<ToggleControl
									label={ __(
										'Show Product Count',
										'variation-filter'
									) }
									help={ __(
										'Shows the total product count on each term.',
										'variation-filter'
									) }
									checked={ settings.showCount }
									onChange={ ( value ) => handleValue( 'settings', 'showCount', value ) }
								/>
							</Field>
							<Field>
								<ToggleGroupControl
									label={ __(
										'Display Type',
										'variation-filter'
									) }
									help={ __(
										'Choose the display type representation.'
									) }
									value={ settings.displayType }
									onChange={ ( value ) => handleValue( 'settings', 'displayType', value ) }
								>
									<ToggleGroupControlOption 
										value="swatch"
										label={ __(
											'Swatch',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="select"
										label={ __(
											'Select',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="list"
										label={ __(
											'List',
											'variation-filter'
										) }
									/>
								</ToggleGroupControl>
							</Field>
							<Field>
								<ToggleGroupControl
									label={ __(
										'Query Type',
										'variation-filter'
									) }
									help={
										settings.queryType === 'AND' ? (
											__(
												'Choose to return filter results for all of the attributes selected.',
												'variation-filter'
											)
										):(
											__(
												'Choose to return filter results for any of the attributes selected.',
												'variation-filter'
											)
									) }
									value={ settings.queryType }
									onChange={ ( value ) => handleValue( 'settings', 'queryType', value ) }
								>
									<ToggleGroupControlOption 
										value="OR"
										label={ __(
											'OR',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="AND"
										label={ __(
											'AND',
											'variation-filter'
										) }
									/>
								</ToggleGroupControl>
							</Field>
						</PanelBody>
					</Section>
					<Section isShow={ hasAttribute }>
						<PanelBody title="Title" initialOpen={ false }>
							<Field>
								<TextControl
									label={ __(
										'Text',
										'variation-filter'
									) }
									value={ title.text }
									onChange={ ( value ) => handleValue( 'title', 'text', value ) }
								/>
							</Field>
							<Field>
								<UnitControl 
									label={ __(
										'Font Size',
										'variation-filter'
									) }
									value={ title.fontSize }
									onChange={ ( value ) => handleValue( 'title', 'fontSize', value ) }
								/>
							</Field>
							<Field>
								<SelectControl
									label={ __(
										'Font Weight',
										'variation-filter'
									) }
									value={ title.fontWeight }
									options={ generalData.fontWeightChoices }
									onChange={ ( value ) => handleValue( 'title', 'fontWeight', value ) }
								/>
							</Field>
							<Field>
								<UnitControl 
									label={ __(
										'Line Height',
										'variation-filter'
									) }
									value={ title.lineHeight }
									onChange={ ( value ) => handleValue( 'title', 'lineHeight', value ) }
								/>
							</Field>
							<Field>
								<UnitControl
									label={ __(
										'Margin Bottom',
										'variation-filter'
									) }
									value={ title.marginBottom }
									onChange={ ( value ) => handleValue( 'title', 'marginBottom', value ) }
								/>
							</Field>
							<Field>
								<BaseControl 
									label={ __(
										'Color',
										'variation-filter'
									) }
								>
									<ColorPalette 
										value={ title.color }
										clearable={ false }
										onChange={ ( value ) => handleValue( 'title', 'color', value ) }
									/>
								</BaseControl>
							</Field>
						</PanelBody>
					</Section>
					<Section>
						<PanelBody title="List Style" initialOpen={ false }>
							<Field>
								<UnitControl
									label={ __(
										'Font Size',
										'variation-filter'
									) }
									value={ list.fontSize }
									onChange={ ( value ) => handleValue( 'list', 'fontSize', value ) }
								/>
							</Field>
							<Field>
								<SelectControl
									label={ __(
										'Font Weight',
										'variation-filter'
									) }
									value={ list.fontWeight }
									options={ generalData.fontWeightChoices }
									onChange={ ( value ) => handleValue( 'list', 'fontWeight', value ) }
								/>
							</Field>
							<Field>
								<UnitControl
									label={ __(
										'Line Height',
										'variation-filter'
									) }
									value={ list.lineHeight }
									onChange={ ( value ) => handleValue( 'list', 'lineHeight', value ) }
								/>
							</Field>
							<Field>
								<UnitControl
									label={ __(
										'Margin Bottom',
										'variation-filter'
									) }
									value={ list.marginBottom }
									onChange={ ( value ) => handleValue( 'list', 'marginBottom', value ) }
								/>
							</Field>
							<Field>
								<Flex gap="12px">
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Text Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ list.color }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'list', 'color', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Text Color Active',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ list.colorActive }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'list', 'colorActive', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
								</Flex>
							</Field>
						</PanelBody>
					</Section>
					<Section>
						<PanelBody title="Select Style" initialOpen={ false }>
							<Field>
								<Grid>
									<Field>
										<UnitControl
											label={ __(
												'Width',
												'variation-filter'
											) }
											value={ select.width }
											onChange={ ( value ) => handleValue( 'select', 'width', value ) }
										/>
									</Field>
									<Field>
										<UnitControl
											label={ __(
												'Height',
												'variation-filter'
											) }
											value={ select.height }
											onChange={ ( value ) => handleValue( 'select', 'height', value ) }
										/>
									</Field>
								</Grid>
							</Field>
							<Field>
								<Grid>
									<Field>
										<UnitControl 
											label={ __(
												'Font Size',
												'variation-filter'
											) }
											value={ select.fontSize }
											onChange={ ( value ) => handleValue( 'select', 'fontSize', value ) }
										/>
									</Field>
									<Field>
										<SelectControl
											label={ __(
												'Font Weight',
												'variation-filter'
											) }
											value={ select.fontWeight }
											options={ generalData.fontWeightChoices }
											onChange={ ( value ) => handleValue( 'select', 'fontWeight', value ) }
										/>
									</Field>
								</Grid>
							</Field>
							<Field>
								<BoxControl
									label={ __(
										'Padding',
										'variation-filter'
									) }
									values={ select.padding }
									onChange={ ( value ) => handleValue( 'select', 'padding', value ) }
								/>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Border',
										'variation-filter'
									) }
									value={ select.border }
									onChange={ ( value ) => handleValue( 'select', 'border', value ) }
								/>
							</Field>
							<Field>
								<Flex gap="12px">
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Text Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ select.color }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'select', 'color', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Background Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ select.backgroundColor }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'select', 'backgroundColor', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
								</Flex>
							</Field>
						</PanelBody>
					</Section>
				</Panel>
			</InspectorControls>

			<div { ...blockProps }>
				{ hasAttribute ? (
					<div className='hbvf'>
						{ getTitleText() && (
							<label className='hbvf-title' style={ getTitleStyle() }>
								{ getTitleText() }
							</label>
						) }
						<div className='hbvf-swatch'>
							<SwatchList attributes={ attributes } />
							<SwatchSelect attributes={ attributes } />
						</div>
					</div>
					
				):(
					<Placeholder
						icon='filter'
						label={ __(
							'Handy Variation Filter',
							'variation-filter'
						) }
						instructions={ __(
							'Display product variation filter based on chosen variation attribute.',
							'variation-filter'
						) }
						isColumnLayout={ true }
					>
						<SearchList
							attributes={ attributes }
							setAttributes={ setAttributes }
							label={ __(
								'Search For A Product Attribute',
								'variation-filter'
							) }
						/>
					</Placeholder>
				) }
			</div>
		</>
	);
}