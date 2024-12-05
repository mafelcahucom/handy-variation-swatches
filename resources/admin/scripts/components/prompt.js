/**
 * Internal Dependencies.
 */
import { setText, setAttribute, eventListener } from '../../../helpers';

/**
 * Internal Components.
 */
import toaster from './toaster';

/**
 * Prompt Components.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const prompt = {
	/**
	 * Show or hide screen loader, and also can set the title.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} visibility Contains the visibility state of the screen loader.
	 * @param {string} title      Contains the title or message of the screen loader.
	 */
	loader( visibility, title = 'Please Wait...' ) {
		if ( visibility ) {
			if ( 'visible' === visibility ) {
				setText.elem( '#hd-prompt-loader-title', title );
			}

			setAttribute.elem( '#hd-prompt-loader', 'data-state', visibility );
		}
	},

	/**
	 * Prompt Modal Dialog.
	 *
	 * @since 1.0.0
	 *
	 * @param {Object} args         Contains all the parameter for prompting a modal dialog.
	 * @param {string} args.title   Contains the title of the modal dialog.
	 * @param {string} args.message Contains the content or message of the modal dialog.
	 * @param {string} args.yes     Contains the yes button label.
	 * @param {string} args.no      contains the no button label.
	 * @return {Promise|void} The promise for users dialog result.
	 */
	dialog( args = {} ) {
		const promptElem = document.getElementById( 'hd-prompt-dialog' );
		if ( ! promptElem ) {
			return;
		}

		setText.elem( '#hd-prompt-dialog-title', args.title ? args.title : 'Title' );
		setText.elem( '#hd-prompt-dialog-message', args.message ? args.message : 'Message' );
		setText.elem( '#hd-prompt-dialog-no-btn', args.no ? args.no : 'No' );
		setText.elem( '#hd-prompt-dialog-yes-btn', args.yes ? args.yes : 'Yes' );
		setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'visible' );

		return new Promise( ( resolve ) => {
			eventListener( 'click', '#hd-prompt-dialog-no-btn', () => {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );

			eventListener( 'click', '#hd-prompt-dialog-yes-btn', () => {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( true );
			} );

			eventListener( 'click', '#hd-prompt-dialog-close-btn', () => {
				setAttribute.elem( '#hd-prompt-dialog', 'data-state', 'hide' );
				resolve( false );
			} );
		} );
	},

	/**
	 * Prompts error message using toaster.
	 *
	 * @since 1.0.0
	 *
	 * @param {string} error Contains the error type or name.
	 */
	errorMessage( error ) {
		const errors = [
			{
				error: 'NETWORK_ERROR',
				title: 'Network Error',
				content:
					'The network connection is lost, there might be a problem with your network.',
			},
			{
				error: 'SECURITY_ERROR',
				title: 'Security Error',
				content:
					'A security error occur. Please try again later or contact the website administrator for help.',
			},
			{
				error: 'MISSING_DATA_ERROR',
				title: 'Missing Data',
				content: 'There is a missing data that are required. Please check and try again.',
			},
			{
				error: 'DB_QUERY_ERROR',
				title: 'Database Error',
				content:
					'A database error occur. Please try again later or contact the plugin developer.',
			},
			{
				error: 'INVALID_FILE_TYPE',
				title: 'Invalid File Type',
				content: 'Invalid file type. Please make sure the file type is .txt.',
			},
			{
				error: 'CORRUPTED_SETTING_FILE',
				title: 'Corrupted Setting File',
				content:
					'The setting text file is corrupted or missing data or containing an invalid data. Please check and try again.',
			},
			{
				error: 'ERROR_READING_FILE',
				title: 'Error Reading File',
				content: 'Error in reading the file. Please contact your developer and try again.',
			},
		];

		const errorDetail = errors.find( ( value ) => {
			return value.error === error;
		} );

		if ( errorDetail ) {
			toaster.show( {
				color: 'danger',
				title: errorDetail.title,
				content: errorDetail.content,
			} );
		}
	},
};

export default prompt;
