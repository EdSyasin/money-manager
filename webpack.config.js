const path = require('path');
const {VueLoaderPlugin} = require('vue-loader');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	entry: path.resolve(__dirname, 'resources/js/app.js'),
	output: {
		path: path.resolve(__dirname, 'public'),
		filename: "js/bundle.js",
		chunkFilename: "js/[name].bundle.js",
		publicPath: "/"
	},
	plugins: [
		new VueLoaderPlugin(),
		new MiniCssExtractPlugin({filename: 'style.css'})
	],
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: "vue-loader",
				options: {
					loaders: {
						ts: 'ts-loader'
					},
					esModule: true
				}
			},
			{
				test: /\.tsx?$/,
				loader: "ts-loader",
				exclude: [/node_modules/],
				options: {
					configFile: 'tsconfig.json',
					appendTsSuffixTo: [/\.vue$/]
				}
			},
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
			{
			    test: /\.(scss|css)$/,
			    use: ['vue-style-loader',
					'css-loader',
					{
						loader: "sass-loader",
						options: {
							additionalData: `
							@charset 'utf-8';
							@import 'resources/scss/variables.scss';
							@import 'resources/scss/functions.scss';
							@import 'resources/scss/mixins.scss';
							`
						}
					}
				]
			},
			{
				test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: 'fonts/'
						}
					}
				]
			}
		]
	},
	resolve: {
		extensions: ['.vue', '.js', '.ts', '.tsx'],
		alias: {
			'@': path.resolve(__dirname, 'resources/js')
		}

	}

}
