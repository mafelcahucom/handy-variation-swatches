/**
 * Internal dependencies
 */
import './field.scss';

/**
 * Field Component.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @component
 * @param {Object}  children The children component 
 * @param {boolean} isShow   The component show state.
 */
const Field = ( { children, isShow = true } ) => {
	const display = isShow ? 'block' : 'none';
	
	return (
		<div className='hvsfw-vf-field' style={ { display: display } }>
			{ children }
		</div>
	);
};

export default Field;