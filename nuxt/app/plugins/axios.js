export default function({ $axios, store }) {
  // devの際はdockerでurlが異なる
  if (process.client) {
    console.log('here is axios client')
    $axios.setBaseURL(process.env.BASE_API_URL_CLIENT)
  }
  // Change URL only for server
  if (process.server) {
    console.log('here is axios server')
    console.log(process.env.BASE_API_URL_SERVER)
    $axios.setBaseURL(process.env.BASE_API_URL_SERVER)
  }
  $axios.onRequest((config) => {
    config.headers.common.Accept = 'application/json'
    // token がセットされている場合
    if (store.getters.token) {
      config.headers.common.Authorization = 'Bearer ' + store.getters.token
      return config
    }
  })
}
