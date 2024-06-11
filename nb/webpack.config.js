const { VueLoaderPlugin } = require("vue-loader");

const path = require("path");

module.exports = {
  mode: "development",
  entry: {
    app: "./assets/src/index.js",
    main: "./assets/src/main.js",
    products: "./assets/src/products.js",
  },
  resolve: {
    modules: [path.resolve(__dirname, "node_modules"), "node_modules"],
  },
  output: {
    path: path.resolve(__dirname, "assets/dist"),
    filename: "[name].js",
  },
  devtool: "source-map",
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.js$/,
        loader: "babel-loader",
      },
      {
        test: /\.css$/,
        use: ["vue-style-loader", "css-loader"],
      },
      {
        test: /\.scss$/,
        use: ["vue-style-loader", "css-loader", "sass-loader"],
      },
      {
        test: /\.js$/,
        loader: "babel-loader",
        exclude: (file) => /node_modules/.test(file) && !/\.vue\.js/.test(file),
      },
      // {
      //   test: /\.(png|svg|jpe?g|gif)$/,
      //   include: /images/,
      //   use: [
      //     {
      //       loader: "file-loader",
      //       options: {
      //         name: "[name].[ext]",
      //         outputPath: "images/",
      //         publicPath: "images/",
      //       },
      //     },
      //   ],
      // },
    ],
  },
  plugins: [new VueLoaderPlugin()],
  resolve: {
    alias: {
      vue$: "vue/dist/vue.runtime.esm.js",
    },
    extensions: ["*", ".js", ".vue", ".json"],
  },
};
