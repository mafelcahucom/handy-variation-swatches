/**
 * Internal dependencies
 */
import isObject from './isObject';

/**
 * A global fetch handler for making HTTP requests and processing responses.
 *
 * @since 1.0.0
 *
 * @param {Object} payloads Contains the data payload of the request, to be specific, the URL query string.
 * @return {Promise} The `Promise` from a fullfilled HTTP request's response.
 */
const getFetch = async ( payloads ) => {
	let result = {
		success: false,
		data: {
			error: 'NETWORK_ERROR',
		},
	};

	if ( isObject.empty( payloads ) ) {
		result.data.error = 'MISSING_DATA_ERROR';
		return result;
	}

	try {
		// eslint-disable-next-line no-undef
		const response = await fetch( hvsfwLocal.url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: new URLSearchParams( payloads ),
		} );

		if ( response.ok ) {
			result = await response.json();
		}
	} catch ( e ) {
		console.log( 'error', e ); // eslint-disable-line no-console
	}

	return result;
};

export default getFetch;
