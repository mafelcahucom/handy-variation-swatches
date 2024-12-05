const defaultConfiguration = require( '@wordpress/scripts/config/webpack.config' );
const removeEmptyScriptsPlugin = require( 'webpack-remove-empty-scripts' );
const path = require( 'path' );

module.exports = {
	...defaultConfiguration,
	...{
		entry: {
			'admin/scripts/hvsfw-admin': path.resolve(
				process.cwd(),
				'resources/admin/scripts',
				'hvsfw-admin.js'
			),
			'admin/styles/hvsfw-admin': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hvsfw-admin.scss'
			),
            'admin/scripts/hvsfw-attribute': path.resolve(
				process.cwd(),
				'resources/admin/scripts',
				'hvsfw-attribute.js'
			),
			'admin/styles/hvsfw-attribute': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hvsfw-attribute.scss'
			),
            'admin/scripts/hvsfw-product': path.resolve(
				process.cwd(),
				'resources/admin/scripts',
				'hvsfw-product.js'
			),
			'admin/styles/hvsfw-product': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hvsfw-product.scss'
			),
            'admin/scripts/hvsfw-term': path.resolve(
				process.cwd(),
				'resources/admin/scripts',
				'hvsfw-term.js'
			),
			'admin/styles/hvsfw-term': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hvsfw-term.scss'
			),
            'admin/styles/hvsfw-home': path.resolve(
				process.cwd(),
				'resources/admin/styles',
				'hvsfw-home.scss'
			),
			'client/scripts/hvsfw-client': path.resolve(
				process.cwd(),
				'resources/client/scripts',
				'hvsfw-client.js'
			),
		},
		plugins: [
			...defaultConfiguration.plugins,
			new removeEmptyScriptsPlugin( {
				stage: removeEmptyScriptsPlugin.STAGE_AFTER_PROCESS_PLUGINS,
			} ),
		],
	},
};
