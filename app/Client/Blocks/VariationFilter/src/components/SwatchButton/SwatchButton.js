/**
 * Internal dependencies
 */
import { helper } from '../../utils/Helper';
import { attributeData } from '../../data/attributeData';
import './swatchbutton.scss';

/**
 * Swatch Button Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object} attributes Contains the block attributes.
 */
const SwatchButton = ( { attributes } ) => {
	const { settings, button } = attributes;
    const terms = attributeData.get( settings.attribute ).terms;

    /**
     * Handle the mouse enter event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e The target element event.
     */
    const handleMouseEnter = ( e ) => {
        const target = e.target;
        const { colorActive, backgroundColorActive, borderActive } = button;

        target.style.color = colorActive;
        target.style.backgroundColor = backgroundColorActive;
        helper.setBorder( target, helper.getBorders( borderActive ) );
    };

    /**
     * Handle the mouse leave event.
     * 
     * @since 1.0.0
     * 
     * @param {Object} e The target element event.
     */
    const handleMouseLeave = ( e ) => {
        const target = e.target;
        const { color, backgroundColor, border } = button;
        
        target.style.color = color;
        target.style.backgroundColor = backgroundColor;
        helper.setBorder( target, helper.getBorders( border ) );
    }

    /**
     * Return the list inline style.
     * 
     * @since 1.0.0
     * 
     * @return {Object} Contains the styles.
     */
    const getInlineStyle = () => {
        const { 
            shape, width, height, fontSize, fontWeight, color, 
            backgroundColor, padding, border, borderRadius 
        } = button;

        let style = {
            minWidth: width,
            minHeight: height,
            color: color,
            fontSize: fontSize,
            fontWeight: fontWeight,
            backgroundColor: backgroundColor,
            borderRadius: borderRadius
        };

        if ( [ 'square', 'circle' ].includes( shape ) ) {
            style.borderRadius = ( shape === 'circle' ? '100%' : '0px' );
        }

        if ( ! helper.isObjectEmpty( padding ) ) {
            style.padding = helper.getPadding( padding );
        }

        if ( ! helper.isObjectEmpty( border ) ) {
            const borders = helper.getBorders( border );
            style = { ...style, ...borders };
        }

        return style;
    };

    return (
        <div className='hvsfw-vf-swatch-button' style={ { gap: button.gap } }>
            { terms.map( ( term, index ) => {
                return (
                    <div 
                        className='hvsfw-vf-swatch-button__box'
                        style={ getInlineStyle() }
                        onMouseEnter={ handleMouseEnter }
                        onMouseLeave={ handleMouseLeave }
                        key={ index }
                    >
                        { term.name } { settings.showCount && `(${ term.count })` }
                    </div>
                )
            } ) }
        </div>
    );
};

export default SwatchButton;