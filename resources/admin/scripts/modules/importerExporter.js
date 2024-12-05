/**
 * Internal Dependencies.
 */
import {
	createTextFile,
	getFetch,
	getCheckboxValue,
	setAttribute,
	eventListener,
} from '../../../helpers';

/**
 * Internal Components.
 */
import prompt from '../components/prompt';
import toaster from '../components/toaster';

/**
 * Importer & Exporter Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const importerExporter = {
	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	init() {
		this.import.init();
		this.export.init();
	},

	/**
	 * Import Component.
	 *
	 * @since 1.0.0
	 */
	import: {
		/**
		 * Initialize Import.
		 *
		 * @since 1.0.0
		 */
		init() {
			this.onImportSetting();
			this.onSelectFile();
		},

		/**
		 * Import settings to wp_options, upload the text file containing
		 * the encrypted settings.
		 *
		 * @since 1.0.0
		 */
		onImportSetting() {
			eventListener( 'click', '#hd-import-setting-file-btn', async ( e ) => {
				const target = e.target;
				const state = target.getAttribute( 'data-state' );
				// eslint-disable-next-line @wordpress/no-unused-vars-before-return
				const fileUploaderElem = document.querySelector( '.hd-file-field__input' );
				if ( 'default' !== state ) {
					return;
				}

				const files = fileUploaderElem.files;
				if ( 0 === files.length ) {
					return;
				}

				const isContinueImporting = await prompt.dialog( {
					title: 'Import Settings',
					message:
						'Are you sure you want to import settings? This process will override the current settings and cannot be undone.',
					yes: 'Continue',
					no: 'Cancel',
				} );

				if ( false === isContinueImporting ) {
					return;
				}

				const file = files[ 0 ];
				if ( 'text/plain' !== file.type ) {
					prompt.errorMessage( 'INVALID_FILE_TYPE' );
					return;
				}

				const reader = new FileReader();
				reader.readAsText( file );
				reader.onload = async () => {
					prompt.loader( 'visible', 'Importing Settings...' );
					target.setAttribute( 'data-state', 'loading' );

					const fileContent = reader.result;
					const res = await getFetch( {
						// eslint-disable-next-line no-undef
						nonce: hvsfwLocal.module.importerExporter.nonce.importSettings,
						action: 'hvsfw_import_settings',
						settings: fileContent,
					} );

					if ( true === res.success ) {
						toaster.show( {
							color: 'success',
							title: 'Successfully Imported',
							content: 'Variation swatches settings has successfully imported.',
						} );
					} else {
						prompt.errorMessage( res.data.error );
					}

					prompt.loader( 'hide' );
					target.setAttribute( 'data-state', 'default' );
				};

				reader.onerror = () => {
					prompt.errorMessage( 'ERROR_READING_FILE' );
				};
			} );
		},

		/**
		 * On selecting a setting .txt file, update import button state.
		 *
		 * @since 1.0.0
		 */
		onSelectFile() {
			eventListener( 'change', '.hd-file-field__input', ( e ) => {
				const target = e.target;
				const files = target.files;
				const parentElem = target.closest( '.hd-file-field' );
				const labelElem = parentElem.querySelector( '.hd-file-field__label' );
				if ( 0 < files.length && parentElem && labelElem ) {
					labelElem.textContent = files[ 0 ].name;
					setAttribute.elem( '#hd-import-setting-file-btn', 'data-state', 'default' );
				}
			} );
		},
	},

	/**
	 * Export Component.
	 *
	 * @since 1.0.0
	 */
	export: {
		/**
		 * Initialize Export.
		 *
		 * @since 1.0.0
		 */
		init() {
			this.onExportSetting();
			this.onListenCheckbox();
			this.onListenExportAllCheckbox();
		},

		/**
		 * Export settings from wp_options and also create a text file
		 * containing all the settings.
		 *
		 * @since 1.0.0
		 */
		onExportSetting() {
			eventListener( 'click', '#hd-export-setting-file-btn', async ( e ) => {
				const target = e.target;
				const state = target.getAttribute( 'data-state' );
				const groups = getCheckboxValue( '.hd-export-setting-checkbox' );
				if ( 'default' !== state || 0 === groups.length ) {
					return;
				}

				// eslint-disable-next-line require-jsdoc
				const getFilename = () => {
					const date = new Date();
					return `HVSFW-DUPLICATE-SETTINGS-${ date.getFullYear() }-${ date.getDate() }-${
						date.getMonth() + 1
					}.txt`;
				};

				prompt.loader( 'visible', 'Exporting Settings...' );
				target.setAttribute( 'data-state', 'loading' );

				const res = await getFetch( {
					// eslint-disable-next-line no-undef
					nonce: hvsfwLocal.module.importerExporter.nonce.exportSettings,
					action: 'hvsfw_export_settings',
					groups,
				} );

				if ( true === res.success ) {
					createTextFile( getFilename(), res.data.settings );
					toaster.show( {
						color: 'success',
						title: 'Successfully Exported',
						content: 'Variation swatches settings has successfully exported.',
					} );
				} else {
					prompt.errorMessage( res.data.error );
				}

				prompt.loader( 'hide' );
				target.setAttribute( 'data-state', 'default' );
			} );
		},

		/**
		 * On listen all checkbox state.
		 *
		 * @since 1.0.0
		 */
		onListenCheckbox() {
			eventListener( 'change', '.hd-export-setting-checkbox', ( e ) => {
				const target = e.target;
				const value = target.value;
				if ( 0 === value.length ) {
					return;
				}

				// Update the state of export button.
				setTimeout( () => {
					const checkedCheckboxElems = document.querySelectorAll(
						'.hd-export-setting-checkbox:checked'
					);
					setAttribute.elem(
						'#hd-export-setting-file-btn',
						'data-state',
						0 < checkedCheckboxElems.length ? 'default' : 'disabled'
					);
				}, 300 );

				// Update export all checkbox check state based on child checkboxes.
				if ( 'ALL' !== value ) {
					const exportAllCheckboxElem = document.querySelector(
						'.hd-export-setting-checkbox[value="ALL"]'
					);
					const unCheckedCheckboxElems = document.querySelectorAll(
						'.hd-export-setting-checkbox:not([value="ALL"]):not(:checked)'
					);
					if ( exportAllCheckboxElem ) {
						const parentElem = exportAllCheckboxElem.closest( '.hd-checkbox-field' );
						if ( parentElem ) {
							parentElem.setAttribute(
								'data-state',
								0 < unCheckedCheckboxElems.length ? 'default' : 'active'
							);
						}

						exportAllCheckboxElem.checked =
							0 < unCheckedCheckboxElems.length ? false : true;
					}
				}
			} );
		},

		/**
		 * On listen export all checkbox state.
		 *
		 * @since 1.0.0
		 */
		onListenExportAllCheckbox() {
			eventListener( 'change', '.hd-export-setting-checkbox[value="ALL"]', ( e ) => {
				const target = e.target;
				const checkboxElems = document.querySelectorAll(
					'.hd-export-setting-checkbox:not([value="ALL"])'
				);
				if ( 0 < checkboxElems.length ) {
					checkboxElems.forEach( ( checkboxElem ) => {
						const parentElem = checkboxElem.closest( '.hd-checkbox-field' );
						if ( parentElem ) {
							parentElem.setAttribute(
								'data-state',
								target.checked ? 'active' : 'default'
							);
						}

						checkboxElem.checked = target.checked ? true : false;
					} );
				}
			} );
		},
	},
};

export default importerExporter;
