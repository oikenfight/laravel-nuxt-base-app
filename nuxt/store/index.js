const inBrowser = typeof window !== 'undefined'

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
  setUser(state, { user }) {
    state.user = user
    state.loggedIn = Boolean(user)
  },
  setToken(state, { token }) {
    state.token = token

    // Token 保存/削除
    if (inBrowser) {
      if (token) {
        this.$cookies.set('token', token, {
          path: '/',
          maxAge: 60 * 60 * 24 * 7
        })
      } else {
        this.$cookies.remove('token')
      }
    }
  }
}

export const actions = {
  async nuxtServerInit({ dispatch, commit, state }, { error }) {
    // cookie から token を取得
    const token = this.$cookies.get('token')

    if (!token) {
      return Promise.resolve()
    }

    // トークンからユーザを取得
    await dispatch('fetchUserByAccessToken', { token }).catch((e) => {
      // 失敗した場合、ログアウト処理
      dispatch('logout').catch((e) => {
        error({ message: e.message, statusCode: e.statusCode })
      })
      return Promise.resolve()
    })

    // 初期データを取得
    await Promise.all([
      dispatch('rack/fetchAll'),
      dispatch('folder/fetchAll'),
      dispatch('note/fetchAll'),
      dispatch('item/fetchAll')
    ])
  },
  async fetchUserByAccessToken({ commit, dispatch }, { token }) {
    commit('setToken', { token })
    await this.$axios.$get('/api/user').then((user) => {
      commit('setUser', { user })
    })
  },
  async logout({ commit, error }) {
    await this.$axios.$delete('/api/user/access_token').then((response) => {
      commit('setToken', null)
    })
  }
}
