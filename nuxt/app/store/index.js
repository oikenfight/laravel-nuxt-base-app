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
    const user = await dispatch('fetchUserByAccessToken', { token }).catch(
      (e) => {
        // 失敗した場合、ログアウト処理
        dispatch('logout').catch((e) => {
          error({ message: e.message, statusCode: e.statusCode })
        })
      }
    )

    // 初期データを取得
    if (user) {
      await dispatch('dispatchAll')
    }
  },
  async fetchUserByAccessToken({ commit, dispatch }, { token }) {
    commit('setToken', { token })
    const data = await this.$axios.$get('/api/user')
    commit('setUser', { user: data.user })
    return data.user
  },
  async login({ commit, error }, { user }) {
    try {
      // アクセストークンを取得
      await this.$axios
        .$post('/oauth/token', {
          grant_type: 'password',
          client_id: '3',
          client_secret: 'SHHESm5I6GBh3HLjuiUpJNgZxIW3zCby4BmIHy2u',
          username: user.email,
          password: user.password,
          scope: '*'
        })
        .then((response) => {
          commit('setToken', { token: response.access_token })
        })
      // ユーザ情報を取得
      const data = await this.$axios.$get('/api/user')
      commit('setUser', { user: data.user })
      return true
    } catch (e) {
      return false
    }
  },
  async logout({ commit, error }) {
    await this.$axios.$delete('/api/user/access_token').then((response) => {
      commit('setToken', { token: null })
    })
  },
  async register({ commit, error }, { user }) {
    await this.$axios
      .$post('/api/auth/register', { user })
      .then((response) => {
        return true
      })
      .catch((e) => {
        return false
      })
  },
  async dispatchAll({ dispatch }) {
    await Promise.all([
      dispatch('rack/fetchAll'),
      dispatch('folder/fetchAll'),
      dispatch('note/fetchAll'),
      dispatch('item/fetchAll'),
      dispatch('category/fetchAll')
    ])
  }
}