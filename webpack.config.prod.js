const path = require('path')

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')

const { CleanWebpackPlugin } = require('clean-webpack-plugin')

// const isEnvDev = process.env.NODE_ENV === 'local'

module.exports = {
  entry: ['./assets/js/index.js', './assets/sass/main.scss'],
  output: {
    filename: './dist/main.min.js',
    path: path.resolve(__dirname),
    publicPath: './dist'
  },
  module: {
    rules: [
      // perform js babelization on all .js files
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg|png|gif)(\?v=\d+\.\d+\.\d+)?$/,
        use: {
          loader: 'url-loader',
          options: {
            limit: 50000,
            name: '[hash].[ext]',
            outputPath: './dist', // Where files goes
            publicPath: './' // Relative path from main.min.css
          }
        }
      },
      // compile all .scss files to plain old css
      {
        test: /\.(sass|scss)$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
      }
    ]
  },
  plugins: [
    // clean out build directories on each build
    new CleanWebpackPlugin({cleanOnceBeforeBuildPatterns: ['./dist/*']}),
    // extract css into dedicated file
    new MiniCssExtractPlugin({
      filename: './dist/main.min.css'
    })
  ],
  optimization: {
    minimize: true,
    minimizer: [
      // enable the js minification plugin
      new UglifyJSPlugin({
        cache: true,
        parallel: true
      }),
      // enable the css minification plugin
      new OptimizeCSSAssetsPlugin({})
    ]
  }
}
