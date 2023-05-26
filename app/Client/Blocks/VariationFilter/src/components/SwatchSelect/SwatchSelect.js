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
    const attribute = attributeData.get( settings.attribute );
    const terms = attribute.terms;

    /**
     * Return the list inline style.
     * 
     * @since 1.0.0
     * 
     * @return {Object} Contains the style.
     */
    const getInlineStyle = () => {
        let { padding, border, ...style } = select;

        if ( ! helper.isObjectEmpty( select.padding ) ) {
            style.padding = helper.getPadding( select.padding );
        }
        
        if ( ! helper.isObjectEmpty( select.border ) ) {
            const borders = helper.getBorders( select.border );
            style = { ...style, ...borders };   
        }
        
        return style;
    };

    return (
        <select className='hvsfw-vf-swatch-select' style={ getInlineStyle() }>
            <option>
                Select { attribute.attribute_label }
            </option>
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