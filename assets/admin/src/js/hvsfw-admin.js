/**
 * Internal Components.
 */
import header from './component/header';
import card from './component/card';
import tab from './component/tab';

/**
 * Internal Modules.
 */
import settingModule from './modules/setting';
import importerExporterModule from './modules/importerExporter';

/**
 * Strict mode.
 *
 * @since 1.0.0
 *
 * @author Mafel John Cahucom
 */
'use strict';

/**
 * Namespace.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
const hvsfw = hvsfw || {};

/**
 * Components.
 *
 * @since 1.0.0
 */
hvsfw.components = {

	/**
	 * Initialize Components.
	 *
	 * @since 1.0.0
	 */
	init() {
		header.init();
		card.init();
		tab.init();
	},
};

/**
 * Setting Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.setting = settingModule;

/**
 * Importer & Exporter Module.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
hvsfw.importerExporter = importerExporterModule;

/**
 * Is Dom Ready.
 *
 * @since 1.0.0
 */
hvsfw.domReady = {

	/**
	 * Execute the code when dom is ready.
	 *
	 * @param {Function} func Contains the callback function.
	 * @return {Function} The callback function.
	 */
	execute( func ) {
		if ( typeof func !== 'function' ) {
			return;
		}

		if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
			return func();
		}

		document.addEventListener( 'DOMContentLoaded', func, false );
	},
};

/**
 * Initialize App.
 *
 * @since 1.0.0
 */
hvsfw.domReady.execute( function() {
	Object.entries( hvsfw ).forEach( function( fragment ) {
		if ( 'init' in fragment[ 1 ] ) {
			fragment[ 1 ].init();
		}
	} );
} );
