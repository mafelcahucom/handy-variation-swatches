/**
 * Internal dependencies
 */
import { attributeData } from '../../data/attributeData';
import './swatchlist.scss';

/**
 * Swatch List Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
const SwatchList = ( { attributes } ) => {
	const { settings, list } = attributes;
    const terms = attributeData.get( settings.attribute ).terms;

    /**
     * Handle the mouse enter event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e The target element event.
     */
    const handleMouseEnter = ( e ) => {
        e.target.style.color = list.colorActive;
    };

    /**
     * Handle the mouse leave event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e The target element event.
     */
    const handleMouseLeave = ( e ) => {
        e.target.style.color = list.color;
    }

    /**
     * Return the list inline style.
     * 
     * @since 1.0.0
     * 
     * @return {Object} Contains the style.
     */
    const getInlineStyle = () => {
        const { colorActive, marginBottom, ...style } = list;
        return style;
    };

    return (
        <ul className='hvsfw-vf-swatch-list'>
            { terms.map( ( term, index ) => {
                return (
                    <li style={ { marginBottom: list.marginBottom } } key={ index }>
                        <span 
                            style={ getInlineStyle() }
                            onMouseEnter={ handleMouseEnter }
                            onMouseLeave={ handleMouseLeave }
                        >
                            { term.name } { settings.showCount && `(${ term.count })` } 
                        </span>
                    </li>
                )
            } ) }
        </ul>
    );
};

export default SwatchList;