export const state = () => ({
  loggedIn: false,
  user: null,
  token: null
})

export const getters = {
  isAuthenticated: (state) => {
    return state.loggedIn
  },
  user: (state) => {
    return state.user
  },
  token: (state) => {
    return state.token
  }
}

export const mutations = {
  setUser(state, user) {
    state.user = user || null
  },
  setToken(state, token) {
    // token をセット
    state.token = token || null
    // token を cookie に保存
    this.$cookies.set('token', token, {
      path: '/',
      maxAge: 60 * 60 * 24 * 7
    })
  },
  setLoggedIn(state, bool) {
    state.loggedIn = bool
  }
}

export const actions = {
  async nuxtServerInit({ commit }, { app }) {
    // cookie から token を取得
    const token = this.$cookies.get('token')
    if (token) {
      // token を vuex にセット
      commit('setToken', token)
      // ユーザを取得
      await app.$axios
        .$get('/api/user')
        .then((response) => {
          commit('setUser', response.user)
          commit('setLoggedIn', true)
        })
        .catch((error) => {
          commit('setUser', null)
          commit('setLoggedIn', false)
          console.log(error)
        })
    }
  }
}
