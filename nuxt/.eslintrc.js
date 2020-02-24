module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    es6: true
  },
  parserOptions: {
    parser: "babel-eslint"
  },
  plugins: [
    "prettier",
    "vue"
  ],
  extends: [
    "@nuxtjs",
    "eslint:recommended",
    "plugin:vue/recommended",
    "prettier/vue",
    "plugin:prettier/recommended",
    "prettier",
  ],
  // add your custom rules here
  rules: {
    // セミコロンなし
    "semi": [1, "never"],
    // アロー関数に括弧が必要（prettier との競合を避けるため）
    "arrow-parens": ["error", "always"],
    // 関数の括弧前のスペース不要（prettier と競合を避けるため）
    "space-before-function-paren": ["error", "never"],
    "prettier/prettier": [
      "error",
      {
        "singleQuote": true,
        "semi": false,
        "vueIndentScriptAndStyle": false,
        "arrowParens": "always"
      }
    ]
  }
}
