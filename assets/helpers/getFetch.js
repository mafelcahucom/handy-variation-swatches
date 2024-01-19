/**
 * Internal dependencies
 */
import isObject from './isObject';

/**
 * Fetch Handler.
 * 
 * @since 1.0.0
 * 
 * @param  {Object} params Contains the url parameter for fetching.
 * @return {Promise} The fetched result.
 */
const getFetch = async function( params ) {
    let result = {
        success: false,
        data: {
            error: 'NETWORK_ERROR',
        }
    };

    if ( isObject.empty( params ) ) {
        result.data.error = 'MISSING_DATA_ERROR';
		return result;
    }

    try {
        const response = await fetch( hvsfwLocal.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams( params )
        } );

        if ( response.ok ) {
            result = await response.json();
        }
    } catch( e ) {
        console.log('error', e);
    }

    return result;
};

export default getFetch;