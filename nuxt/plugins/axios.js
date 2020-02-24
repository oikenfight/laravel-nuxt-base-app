export default function({ $axios, store }) {
  if (process.client) {
    $axios.setBaseURL('http://localhost:8080')
  }
  // Change URL only for server
  if (process.server) {
    $axios.setBaseURL('http://nginx_api')
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
