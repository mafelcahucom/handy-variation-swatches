/**
 * Internal dependencies
 */
import './section.scss';

/**
 * Section Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}  children The children component 
 * @param {boolean} isShow   The component show state.
 */
const Section = ( { children, isShow = true } ) => {
	const display = isShow ? 'block' : 'none';
	
	return (
		<div className='hvsfw-vf-section' style={ { display: display } }>
			{ children }
		</div>
	);
};

export default Section;