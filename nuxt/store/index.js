const inBrowser = typeof window !== 'undefined'

export const state = () => ({
  loggedIn: false,
  user: null,
  token: null,
  folderIdSelected: null,
  rackIdSelected: null
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
  },
  folderIdSelected: (state) => {
    return state.folderIdSelected
  },
  rackIdSelected: (state) => {
    return state.rackIdSelected
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
  },
  setFolderId(state, { folderId }) {
    state.folderIdSelected = folderId
  },
  setRackId(state, { rackId }) {
    state.rackIdSelected = rackId
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
        console.log('here is error fetchUserByAccessToken')
        dispatch('logout').catch((e) => {
          error({ message: e.message, statusCode: e.statusCode })
        })
      }
    )
    console.log(user)

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
  async logout({ commit, error }) {
    await this.$axios.$delete('/api/user/access_token').then((response) => {
      commit('setToken', { token: null })
    })
  },
  async dispatchAll({ dispatch }) {
    await Promise.all([
      dispatch('rack/fetchAll'),
      dispatch('folder/fetchAll'),
      dispatch('note/fetchAll'),
      dispatch('item/fetchAll')
    ])
  },
  setFolderId({ commit }, { folderId }) {
    commit('setFolderId', { folderId })
  },
  setRackId({ commit }, { rackId }) {
    commit('setRackId', { rackId })
  }
}
