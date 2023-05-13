/**
 * Internal dependencies
 */
import { helper } from '../../utils/Helper';
import { attributeData } from '../../data/attributeData';
import './swatchselect.scss';

/**
 * Swatch Select Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
const SwatchSelect = ( { attributes } ) => {
	const { settings, select } = attributes;
    const terms = attributeData.get( settings.attribute ).terms;

    /**
     * Return the list inline style.
     * 
     * @since 1.0.0
     * 
     * @return {Object}
     */
    const getInlineStyle = () => {
        let { padding, border, ...rest } = select;

        if ( ! helper.isObjectEmpty( select.padding ) ) {
            rest.padding = helper.getPadding( select.padding );
        }
        
        if ( ! helper.isObjectEmpty( select.border ) ) {
            const borders = helper.getBorders( select.border );
            rest = { ...rest, ...borders };   
        }
        
        return rest;
    };

    return (
        <select className='hbvf-swatch-select' style={ getInlineStyle() }>
            { terms.map( ( term, index ) => {
                return (
                    <option key={ index }>
                        { term.name } { settings.showCount && `(${ term.count })` }
                    </option>
                )
            } ) }
        </select>
    );
};

export default SwatchSelect;