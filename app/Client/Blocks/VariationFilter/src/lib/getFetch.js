/**
 * Get Fetch Handler.
 * 
 * @since 1.0.0
 * 
 * @author Mafel John Cahucom
 * 
 * @type {Function}
 * @param {Object} params Containing the parameters.
 * @return {Object} Fetch response
 */
const getFetch = async ( params ) => {
    let result = {
        success: false,
        data: {
            error: 'NETWORK_ERROR',
        },
    };

    if ( Object.keys( params ).length === 0 ) {
        result.data.error = 'MISSING_DATA_ERROR';
        return result;
    }

    try {
        const response = await fetch( hbvfData.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams( params ),
        } );

        if ( response.ok ) {
            result = await response.json();
        }
    } catch ( e ) {
        console.log( 'error', e );
    }

    return result;
};

export default getFetch;