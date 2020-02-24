export default function({ $axios, store }) {
  // $axios.onResponse((config) => {
  //   $axios.setHeader('Access-Control-Allow-Origin', '*')
  //   if (store.state.token) {
  //     config.headers.common.Authorization = `Bearer ${store.state.token}`
  //   }
  //   return config
  // })
  if (process.client) {
    $axios.setBaseURL('http://localhost:8080')
  }
  // Change URL only for server
  if (process.server) {
    $axios.setBaseURL('http://nginx_api')
  }
  $axios.onRequest((config) => {
    console.log(store.state.token)
    if (store.state.token) {
      console.log('Making request to ' + config.url)
      config.headers.common.Authorization = store.state.token
      console.log(config)
      return config
    }
  })
}
