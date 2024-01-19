/**
 * External Dependencies.
 */
import { __ } from '@wordpress/i18n';
import { useEffect } from '@wordpress/element';
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
 * Internal Dependencies.
 */
import Icon from './icon';
import { helper } from './utils/helper';
import { getFetch } from './lib/getFetch';
import { generalData } from './data/generalData';
import { attributeData } from './data/attributeData';
import {
	Section,
	Field,
	SearchList,
	SwatchList,
	SwatchSelect,
	SwatchButton,
	SwatchColor,
	SwatchImage
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
		select,
		button,
		color,
		image
	} = attributes;

	const hasAttribute = attributeData.isFound( settings.attribute );
	
	/**
	 * Handle multiple input value.
	 * 
	 * @since 1.0.0
	 * 
	 * @param {string} objectName 	Contains the target object name in setAttributes.
	 * @param {string} propertyName Contains the target property key of object.
	 * @param {string} newValue		Contains the new value from input. 
	 */
	const handleValue = ( objectName, propertyName, newValue ) => {
		const { [ objectName ]: object } = attributes;
		setAttributes( { [ objectName ]: { ...object, [ propertyName ]: newValue } } );
	};

	/**
	 * Return the final display type based on block displayType and
	 * product attribute_type.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {string} The final display type.
	 */
	const getDisplayType = () => {
		const { attribute, displayType } = settings;

		if ( displayType === 'swatch' ) {
			const currentAttribute = attributeData.get( attribute );
			if ( ! helper.isObjectEmpty( currentAttribute ) ) {
				const types = [ 'button', 'color', 'image', 'select' ];
				if ( types.includes( currentAttribute.attribute_type ) ) {
					return currentAttribute.attribute_type;
				}
			}
		}

		return ( displayType !== 'swatch' ? displayType : '' );
	};

	/**
	 * Return the title text and set when first added in editor.
	 * 
	 * @since 1.0.0
	 * 
	 * @return {string} The title text.
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
		 * Set the block attribute productAttributes and localize it also in window.
		 * 
		 * @since 1.0.0
		 */
		const setProductAttributes = async () => {
			if ( window.hvsfwVfData.productAttributes === undefined ) {
				const res = await getFetch( {
					nonce: hvsfwVfData.nonce.getProductAttributes,
					action: 'hvsfw_vf_get_product_attributes'
				} );

				if ( res.success === true && res.data.response === 'SUCCESS' ) {
					setAttributes( { productAttributes: res.data.attributes } );
					window.hvsfwVfData.productAttributes = res.data.attributes;
				}
			} else {
				setAttributes( { productAttributes: window.hvsfwVfData.productAttributes } );
			}

			// Update searchList component state.
			setAttributes( { searchList: { ...searchList, state: 'default' } } );
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
							<Field isShow={ [ 'list', 'select', 'button' ].includes( getDisplayType() ) }>
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
										settings.queryType === 'and' ? (
											__(
												'Choose to return filter results for any of the attributes selected.',
												'variation-filter'
											)
										):(
											__(
												'Choose to return filter results for all of the attributes selected.',
												'variation-filter'
											)
									) }
									value={ settings.queryType }
									onChange={ ( value ) => handleValue( 'settings', 'queryType', value ) }
								>
									<ToggleGroupControlOption 
										value="or"
										label={ __(
											'Or',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="and"
										label={ __(
											'And',
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
					<Section isShow={ getDisplayType() === 'list' }>
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
					<Section isShow={ getDisplayType() === 'select' }>
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
					<Section isShow={ getDisplayType() === 'button' }>
						<PanelBody title="Button Style" initialOpen={ false }>
							<Field>
								<ToggleGroupControl
									label={ __(
										'Shape',
										'variation-filter'
									) }
									value={ button.shape }
									onChange={ ( value ) => handleValue( 'button', 'shape', value ) }
								>
									<ToggleGroupControlOption 
										value="square"
										label={ __(
											'Square',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="circle"
										label={ __(
											'Circle',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="custom"
										label={ __(
											'Custom',
											'variation-filter'
										) }
									/>
								</ToggleGroupControl>
							</Field>
							<Field>
								<Grid>
									<Field>
										<UnitControl 
											label={ __(
												'Width',
												'variation-filter'
											) }
											value={ button.width }
											onChange={ ( value ) => handleValue( 'button', 'width', value ) }
										/>
									</Field>
									<Field>
										<UnitControl 
											label={ __(
												'Height',
												'variation-filter'
											) }
											value={ button.height }
											onChange={ ( value ) => handleValue( 'button', 'height', value ) }
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
											value={ button.fontSize }
											onChange={ ( value ) => handleValue( 'button', 'fontSize', value ) }
										/>
									</Field>
									<Field>
										<SelectControl
											label={ __(
												'Font Weight',
												'variation-filter'
											) }
											value={ button.fontWeight }
											options={ generalData.fontWeightChoices }
											onChange={ ( value ) => handleValue( 'button', 'fontWeight', value ) }
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
									values={ button.padding }
									onChange={ ( value ) => handleValue( 'button', 'padding', value ) }
								/>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Border',
										'variation-filter'
									) }
									value={ button.border }
									onChange={ ( value ) => handleValue( 'button', 'border', value ) }
								/>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Active Border',
										'variation-filter'
									) }
									value={ button.borderActive }
									onChange={ ( value ) => handleValue( 'button', 'borderActive', value ) }
								/>
							</Field>
							<Field isShow={ button.shape === 'custom' }>
								<UnitControl 
									label={ __(
										'Border Radius',
										'variation-filter'
									) }
									value={ button.borderRadius }
									onChange={ ( value ) => handleValue( 'button', 'borderRadius', value ) }
								/>
							</Field>
							<Field>
								<UnitControl 
									label={ __(
										'Gap',
										'variation-filter'
									) }
									value={ button.gap }
									onChange={ ( value ) => handleValue( 'button', 'gap', value ) }
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
													value={ button.color }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'button', 'color', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Text Active Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ button.colorActive }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'button', 'colorActive', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
								</Flex>
							</Field>
							<Field>
								<Flex gap="12px">
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Background Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ button.backgroundColor }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'button', 'backgroundColor', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
									<FlexItem isBlock={ true }>
										<Field>
											<BaseControl 
												label={ __(
													'Background Active Color',
													'variation-filter'
												) }
											>
												<ColorPalette 
													value={ button.backgroundColorActive }
													clearable={ false }
													onChange={ ( value ) => handleValue( 'button', 'backgroundColorActive', value ) }
												/>
											</BaseControl>
										</Field>
									</FlexItem>
								</Flex>
							</Field>
						</PanelBody>
					</Section>
					<Section isShow={ getDisplayType() === 'color' }>
						<PanelBody title="Color Style" initialOpen={ false }>
							<Field>
								<ToggleGroupControl
									label={ __(
										'Shape',
										'variation-filter'
									) }
									value={ color.shape }
									onChange={ ( value ) => handleValue( 'color', 'shape', value ) }
								>
									<ToggleGroupControlOption 
										value="square"
										label={ __(
											'Square',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="circle"
										label={ __(
											'Circle',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="custom"
										label={ __(
											'Custom',
											'variation-filter'
										) }
									/>
								</ToggleGroupControl>
							</Field>
							<Field isShow={ color.shape !== 'custom' }>
								<UnitControl 
									label={ __(
										'Size',
										'variation-filter'
									) }
									value={ color.size }
									onChange={ ( value ) => handleValue( 'color', 'size', value ) }
								/>
							</Field>
							<Field isShow={ color.shape === 'custom' }>
								<Grid>
									<Field>
										<UnitControl 
											label={ __(
												'Width',
												'variation-filter'
											) }
											value={ color.width }
											onChange={ ( value ) => handleValue( 'color', 'width', value ) }
										/>
									</Field>
									<Field>
										<UnitControl 
											label={ __(
												'Height',
												'variation-filter'
											) }
											value={ color.height }
											onChange={ ( value ) => handleValue( 'color', 'height', value ) }
										/>
									</Field>
								</Grid>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Border',
										'variation-filter'
									) }
									value={ color.border }
									onChange={ ( value ) => handleValue( 'color', 'border', value ) }
								/>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Active Border',
										'variation-filter'
									) }
									value={ color.borderActive }
									onChange={ ( value ) => handleValue( 'color', 'borderActive', value ) }
								/>
							</Field>
							<Field isShow={ color.shape === 'custom' }>
								<UnitControl 
									label={ __(
										'Border Radius',
										'variation-filter'
									) }
									value={ color.borderRadius }
									onChange={ ( value ) => handleValue( 'color', 'borderRadius', value ) }
								/>
							</Field>
							<Field>
								<UnitControl 
									label={ __(
										'Gap',
										'variation-filter'
									) }
									value={ color.gap }
									onChange={ ( value ) => handleValue( 'color', 'gap', value ) }
								/>
							</Field>
						</PanelBody>
					</Section>
					<Section isShow={ getDisplayType() === 'image' }>
						<PanelBody title="Image Style" initialOpen={ false }>
							<Field>
								<ToggleGroupControl
									label={ __(
										'Shape',
										'variation-filter'
									) }
									value={ image.shape }
									onChange={ ( value ) => handleValue( 'image', 'shape', value ) }
								>
									<ToggleGroupControlOption 
										value="square"
										label={ __(
											'Square',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="circle"
										label={ __(
											'Circle',
											'variation-filter'
										) }
									/>
									<ToggleGroupControlOption 
										value="custom"
										label={ __(
											'Custom',
											'variation-filter'
										) }
									/>
								</ToggleGroupControl>
							</Field>
							<Field isShow={ image.shape !== 'custom' }>
								<UnitControl 
									label={ __(
										'Size',
										'variation-filter'
									) }
									value={ image.size }
									onChange={ ( value ) => handleValue( 'image', 'size', value ) }
								/>
							</Field>
							<Field isShow={ image.shape === 'custom' }>
								<Grid>
									<Field>
										<UnitControl 
											label={ __(
												'Width',
												'variation-filter'
											) }
											value={ image.width }
											onChange={ ( value ) => handleValue( 'image', 'width', value ) }
										/>
									</Field>
									<Field>
										<UnitControl 
											label={ __(
												'Height',
												'variation-filter'
											) }
											value={ image.height }
											onChange={ ( value ) => handleValue( 'image', 'height', value ) }
										/>
									</Field>
								</Grid>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Border',
										'variation-filter'
									) }
									value={ image.border }
									onChange={ ( value ) => handleValue( 'image', 'border', value ) }
								/>
							</Field>
							<Field>
								<BorderBoxControl
									label={ __(
										'Active Border',
										'variation-filter'
									) }
									value={ image.borderActive }
									onChange={ ( value ) => handleValue( 'image', 'borderActive', value ) }
								/>
							</Field>
							<Field isShow={ image.shape === 'custom' }>
								<UnitControl 
									label={ __(
										'Border Radius',
										'variation-filter'
									) }
									value={ image.borderRadius }
									onChange={ ( value ) => handleValue( 'image', 'borderRadius', value ) }
								/>
							</Field>
							<Field>
								<UnitControl 
									label={ __(
										'Gap',
										'variation-filter'
									) }
									value={ image.gap }
									onChange={ ( value ) => handleValue( 'image', 'gap', value ) }
								/>
							</Field>
						</PanelBody>
					</Section>
				</Panel>
			</InspectorControls>

			<div { ...blockProps }>
				{ hasAttribute ? (
					<div className='hvsfw-vf'>
						{ getTitleText() && (
							<label className='hvsfw-vf-title' style={ getTitleStyle() }>
								{ getTitleText() }
							</label>
						) }
						<div className='hvsfw-vf-swatch'>
							{ ( () => {
								switch ( getDisplayType() ) {
									case 'list':
										return <SwatchList attributes={ attributes } />
									case 'select':
										return <SwatchSelect attributes={ attributes } />
									case 'button':
										return <SwatchButton attributes={ attributes } />
									case 'color':
										return <SwatchColor attributes={ attributes } />
									case 'image':
										return <SwatchImage attributes={ attributes } />
								}
							})()}
						</div>
					</div>
				):(
					<Placeholder
						icon={ Icon }
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