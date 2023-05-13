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
     * @return {Object}
     */
    const getInlineStyle = () => {
        const { colorActive, marginBottom, ...rest } = list;
        return rest;
    };

    return (
        <ul className='hbvf-swatch-list'>
            { terms.map( ( term ) => {
                return (
                    <li style={ { marginBottom: list.marginBottom } }>
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