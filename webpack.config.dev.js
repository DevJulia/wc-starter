const path = require('path');

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');

const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin'); 

module.exports = {
  entry: {
    main: ['./assets/js/index.js', './assets/sass/main.scss'],
    home: ['./assets/js/pages/home.js'],
  },
  output: {
    filename: './assets/build/[name].js',
    path: path.resolve(__dirname),
    publicPath: './assets/build'
  },
  devtool: 'source-map',
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
        test: /\.(woff(2)?|ttf|eot|png|svg|gif)(\?v=\d+\.\d+\.\d+)?$/,
        use: {
          loader: 'url-loader',
          options: {
            limit: 50000,
            name: '[name].[ext]',
            outputPath: './assets/build', // Where files goes
            publicPath: './' // Relative path from main.min.css
          }
        }
      },
      // compile all .scss files to plain old css
      {
        test: /\.(sass|scss)$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'sass-loader',
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true
            }
          }
        ]
      }
    ]
  },
  plugins: [
    // clean out build directories on each build
    new CleanWebpackPlugin({cleanOnceBeforeBuildPatterns: ['./dist/*', './assets/build/*']}),
    // extract css into dedicated file
    new MiniCssExtractPlugin({
      //filename: './assets/build/main.css'
      moduleFilename: ({ name }) => `./assets/build/${name.replace('/js/', '/css/')}.css`,
    }),
    new BrowserSyncPlugin({
      files: [
        './../',
        './', 
        '!./node_modules',
        '!./yarn-error.log',
        '!./package.json',
        '!./style.css.map',
        '!./app.js.map'
      ],
      reloadDelay: 0
    })
  ],
  optimization: {
    minimize: false,
    minimizer: [
      // enable the js minification plugin
      new UglifyJSPlugin({
        cache: false,
        parallel: false
      }),
      // enable the css minification plugin
      new OptimizeCSSAssetsPlugin({})
    ]
  },
};
