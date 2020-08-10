const colors = require('vuetify/es5/util/colors').default

const { ENV } = require('./configs/env')
require('dotenv').config()

const routerConfig = {}
if (ENV.BASE_URL) {
  routerConfig.base = ENV.BASE_URL
}

const generate = {}
if (ENV.GENERATE_ERROR_PAGE) {
  generate.routes = ['/403', '/404', '/500']
}

module.exports = {
  mode: 'universal',

  srcDir: 'app',

  env: {
    PASSPORT_PASSWORD_GRANT_CLIENT_ID:
      process.env.PASSPORT_PASSWORD_GRANT_CLIENT_ID,
    PASSPORT_PASSWORD_GRANT_CLIENT_SECRET:
      process.env.PASSPORT_PASSWORD_GRANT_CLIENT_SECRET,
    BASE_API_URL_CLIENT: process.env.BASE_API_URL_CLIENT,
    BASE_API_URL_SERVER: process.env.BASE_API_URL_SERVER
  },

  router: {
    ...routerConfig
  },

  render: {
    /**
     * compression を通すと2重に Gzip がかかりブラウザが表示できないので
     * なにもしないミドルウェアを定義しておく
     */
    compressor: (req, res, next) => {
      next()
    }
  },

  /*
   ** Headers of the page
   */
  head: {
    titleTemplate: '%s - ' + process.env.npm_package_name,
    title: process.env.npm_package_name || '',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      {
        hid: 'description',
        name: 'description',
        content: process.env.npm_package_description || ''
      }
    ],
    script: [
      {
        src:
          '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">'
      }
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }]
  },
  /*
   ** Customize the progress-bar color
   */
  loading: { color: '#fff' },
  /*
   ** Global CSS
   */
  css: [],
  /*
   ** Plugins to load before mounting the App
   */
  plugins: [
    'plugins/axios.js',
    '~/plugins/constants',
    { src: '~/plugins/v-markdown-editor.js', mode: 'client' }
  ],
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: [
    // Doc: https://github.com/nuxt-community/eslint-module
    '@nuxtjs/eslint-module',
    '@nuxtjs/vuetify'
  ],
  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/markdownit',
    // 'nuxt-material-design-icons',
    'nuxtjs-mdi-font',
    ['cookie-universal-nuxt', { parseJSON: false }],
    [
      '@nuxtjs/dotenv',
      {
        filename:
          process.env.NODE_ENV === 'production'
            ? '../.env.production'
            : '../.env.development'
      }
    ]
  ],
  /*
   ** Axios module configuration
   ** See https://axios.nuxtjs.org/options
   */
  axios: {
    credentials: false // CORS のワイルドカード指定を許可する（TODO true に修正する）
  },
  /*
   ** vuetify module configuration
   ** https://github.com/nuxt-community/vuetify-module
   */
  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: false,
      themes: {
        dark: {
          default: colors.teal.lighten1,
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        },
        light: {
          default: colors.teal.lighten1,
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        }
      }
    }
  },
  markdownit: {
    injected: true, // $mdを利用してmarkdownをhtmlにレンダリング
    breaks: true, // 改行コードを<br>に変換
    html: true, // HTML タグを有効
    linkify: true, // URLに似たテキストをリンクに自動変換
    typography: true // 言語に依存しない 置換 + 引用符 を有効
  },
  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  }
}
