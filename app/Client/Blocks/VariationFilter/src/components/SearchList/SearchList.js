/**
 * External Dependencies
 */
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';

/**
 * Internal Dependencies
 */
import { attributeData } from '../../data/attributeData';
import './searchlist.scss';

/**
 * Search List Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}   attributes    Contains the block attributes. 
 * @param {Function} setAttributes Contains the block attributes setter.
 */
const SearchList = ( { attributes, setAttributes, label } ) => {
    const { blockId, settings, searchList } = attributes;
    const [ keyword, setKeyword ] = useState('');
    const [ matchedOptions, setMatchedOptions ] = useState([]);

    /**
     * Handle the search input onChange event and also
     * perform a simple search filter.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e Contais the target element event.
     */
    const handleKeyword = ( e ) => {
        setKeyword( e.target.value );

        const attributeOptions = attributeData.getSelectOptions();
        const matches = attributeOptions.filter( ( attributeOption ) => {
            const regex = new RegExp( `^${ keyword }`, 'gi' );
            return attributeOption.label.match( regex );
        });
        setMatchedOptions( matches );
    };

    /**
     * Handle the attribute radio button onChange event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e Contains the target element event.
     */
    const handleAttributeRadio = ( e ) => {
        setAttributes( { settings: { ...settings, attribute: e.target.value } } );
    };

    /**
     * Returns the product attributes label and value for select options.
     * 
     * @since 1.0.0
     * 
     * @return {Array} Contains the label and value of product attributes.
     */
    const getAttributeOptions = () => {
        return keyword ? matchedOptions : attributeData.getSelectOptions();
    };

    /**
     * Check if a certain radio button is checked.
     * 
     * @since 1.0.0
     * 
     * @param  {string} value Contains the value of the radio button. 
     * @return {boolean} The flag whether the radio butto is checked.
     */
    const isRadioChecked = ( value ) => {
        return settings.attribute === value;
    };

    /**
     * Return the current item state active or default.
     * 
     * @since 1.0.0
     * 
     * @param  {string} value Contains the value of the current item. 
     * @return {string} The new item state.
     */
    const getItemState = ( value ) => {
        return settings.attribute === value ? 'active' : 'default';
    };

    /**
     * Return the attribute list empty message placeholder.
     * 
     * @since 1.0.0
     * 
     * @return {string} The placeholder message.
     */
    const getPlaceholderMessage = () => {
        if ( searchList.state === 'loading' ) {
            return 'Fetching Product Attributes.';
        }

        if ( keyword ) {
            return `No results for ${ keyword }.`;
        }

        return 'No Product Attributes Found.'
    };

	return (
        <div className='hvsfw-vf-search-list'>
            <div className='hvsfw-vf-srl__mb-15'>
                { label && (
                    <label className='hvsfw-vf-srl__label'>
                        { __(
                            label,
                            'variation-filter'
                        ) }
                    </label>
                ) }
                <input 
                    type="text" 
                    className='hvsfw-vf-srl__search-input'
                    disabled={ attributeData.isEmpty() ? 'disabled' : '' }
                    onChange={ handleKeyword }
                />
            </div>
            { getAttributeOptions().length > 0 ? (
                <ul className='hvsfw-vf-srl__list'>
                    { getAttributeOptions().map( ( option, index ) => {
                        return (
                            <li 
                                className='hvsfw-vf-srl__list__item' 
                                state={ getItemState( option.value ) } 
                                key={ index }
                            >
                                <label htmlFor={ `hvsfw-vf-attribute-${ blockId }-${ index }` }>
                                    <input 
                                        type='radio'
                                        id={ `hvsfw-vf-attribute-${ blockId }-${ index }` }
                                        name={ `hvsfw-vf-attribute-${ blockId }` }
                                        value={ option.value }
                                        checked={ isRadioChecked( option.value ) }
                                        onChange={ handleAttributeRadio }
                                    />
                                    <span>{ option.label }</span>
                                </label>
                            </li>
                        )
                    } ) }
                </ul>
            ):(
                <p className='hvsfw-vf-srl__placeholder'>
                    { __(
                        getPlaceholderMessage(),
                        'variation-filter'
                    ) }
                </p>
            ) }
        </div>
	);
};

export default SearchList;