const path = require('path');
const {VueLoaderPlugin} = require('vue-loader');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	entry: path.resolve(__dirname, 'resources/js/app.js'),
	output: {
		path: path.resolve(__dirname, 'public/js'),
		filename: "bundle.js",
		chunkFilename: "[name].bundle.js",
		publicPath: "/js/"
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
			    test: /\.(scss|css)$/,
			    use: ['vue-style-loader',
					'css-loader',
					{
						loader: "sass-loader",
						options: {
							additionalData: `
							@import 'resources/scss/variables.scss';
							@import 'resources/scss/functions.scss';
							`
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