/**
 * Internal Dependencies.
 */
import { helper } from '../../utils/helper';
import { attributeData } from '../../data/attributeData';
import './swatchcolor.scss';

/**
 * Swatch Color Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
const SwatchColor = ( { attributes } ) => {
	const { settings, color } = attributes;
    const terms = attributeData.get( settings.attribute ).terms;

    /**
     * Handle the mouse enter event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e Contains the target element event.
     */
    const handleMouseEnter = ( e ) => {
        helper.setBorder( e.target, helper.getBorders( color.borderActive ) );
    };

    /**
     * Handle the mouse leave event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e Contains the target element event.
     */
    const handleMouseLeave = ( e ) => {
        helper.setBorder( e.target, helper.getBorders( color.border ) );
    }

    /**
     * Return the list inline style.
     * 
     * @since 1.0.0
     * 
     * @return {Object} Contains the styles.
     */
    const getInlineStyle = () => {
        const { shape, size, width, height, border, borderRadius } = color;

        let style = {
            width: size,
            height: size,
        };

        if ( shape === 'custom' ) {
            style.width = width;
            style.height = height;
            style.borderRadius = borderRadius;
        } else {
            style.borderRadius = ( shape === 'circle' ? '100%' : '0px' );
        }

        if ( ! helper.isObjectEmpty( border ) ) {
            const borders = helper.getBorders( border );
            style = { ...style, ...borders };
        }

        return style;
    };

    return (
        <div className='hvsfw-vf-swatch-color' style={ { gap: color.gap } }>
            { terms.map( ( term, index ) => {
                return (
                    <div
                        className='hvsfw-vf-swatch-color__box'
                        style={ getInlineStyle() }
                        onMouseEnter={ handleMouseEnter }
                        onMouseLeave={ handleMouseLeave }
                        key={ index }
                    >
                        <div 
                            className='hvsfw-vf-swatch-color__color'
                            style={ { 
                                background: helper.getLinearColor( term.meta )
                            } }
                        ></div>
                    </div>
                )
            } ) }
        </div>
    );
};

export default SwatchColor;