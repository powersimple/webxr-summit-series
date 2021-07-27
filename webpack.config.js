module.exports = {
    mode: 'development',
    entry: './xr/index.js',
    output: {
        filename: 'xr.js',
        path: __dirname
    },
    devtool: 'source-map',
    module: {
        rules: [{
            test: /\.(js|mjs)$/,
            exclude: /(node_modules)/,
            use: {
                loader: 'babel-loader'
            }
        }]
    },
    watchOptions: {
        ignored: [/node_modules/],
    }
};