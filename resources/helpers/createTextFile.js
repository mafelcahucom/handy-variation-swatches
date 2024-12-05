/**
 * Create a text file from the text of the appended element.
 *
 * @since 1.0.0
 *
 * @param {string} filename Contains the filename that will used as name of .txt file.
 * @param {string} content  Contains the content of the .txt file.
 */
const createTextFile = ( filename, content ) => {
	if ( filename && content ) {
		const element = document.createElement( 'a' );
		element.setAttribute(
			'href',
			'data:text/plain;charset=utf-8,' + encodeURIComponent( content )
		);
		element.setAttribute( 'download', filename );
		element.style.display = 'none';
		document.body.appendChild( element );
		element.click();
		document.body.removeChild( element );
	}
};

export default createTextFile;
