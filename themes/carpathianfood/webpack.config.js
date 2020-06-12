const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require( 'path' );

module.exports = {
    ...defaultConfig,
    entry: {
        "gutenberg-input-block.min": path.resolve( process.cwd(), 'Frontend/src/js/', 'gutenberg-input-block.js' ),
    },
    output: {
        filename: '[name].js',
        path: path.resolve( process.cwd(), 'Frontend/assets/js' ),
    },
    module: {
        ...defaultConfig.module,
        rules: [
            ...defaultConfig.module.rules,
        ]
    }
};
