// webpack v4
const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const CleanWebpackPlugin = require('clean-webpack-plugin');
const folder = __dirname;

let pathsToClean = [
    './dist/*.*'
]

let cleanOptions = {
    root:     folder,
    exclude:  ['app.js'],
    verbose:  true,
    dry:      false
}

module.exports = {
    entry: { 
        app: './assets/js/app.js'
    },
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: '[name].pack.js',
        chunkFilename: '[name].[chunkhash].pack.js',
        publicPath: "/dist/"
    },
    devtool: "source-map",
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                  fallback: 'style-loader',
                  use: [
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        }
                    }, 
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                  ]
                })
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '[name].[ext]',
                        outputPath: 'fonts/'
                    }
                }]
            }
        ]
    },
    plugins: [ 
        new ExtractTextPlugin({
            filename: '[name].css'
        }),
        new CleanWebpackPlugin( pathsToClean, cleanOptions )
    ],
    optimization: {
        minimizer: [
          new UglifyJsPlugin(),
          new OptimizeCSSAssetsPlugin()
        ]
    }
};