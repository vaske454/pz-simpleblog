const path = require('path');
const glob = require('glob');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

// Get all JS files in the assets/js directory
const entries = glob.sync(path.resolve(__dirname, 'assets/js/*.js')).reduce((entries, entry) => {
    const entryName = path.basename(entry, '.js'); // Use the file name without extension as the key
    entries[entryName] = entry;
    return entries;
}, {});

module.exports = {
    entry: entries,
    output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'public/build/js'),
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader'
                ],
                include: path.resolve(__dirname, 'assets/css'),
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].bundle.css', // Ensure CSS is output to the correct directory
        }),
    ],
    optimization: {
        minimizer: [
            new CssMinimizerPlugin(), // Minify CSS
            '...'
        ],
    },
    devtool: 'source-map', // Optional: Add source maps for easier debugging
};
