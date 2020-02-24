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
    state.token = token || null
  },
  setLoggedIn(state, bool) {
    state.loggedIn = bool
  }
}

export const actions = {
  // async nuxtServerInit({ commit }, { app }) {
  //   await app.$axios
  //     .$get('/api/user')
  //     .then((response) => {
  //       commit('setUser', response.user)
  //       commit('setLoggedIn', true)
  //     })
  //     .catch(() => {
  //       commit('setUser', null)
  //       commit('setLoggedIn', false)
  //     })
  // }
}
