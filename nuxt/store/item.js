export const state = () => ({
  itemId: null,
  itemsAll: []
})

export const getters = {
  itemId: (state) => {
    return state.itemId
  },
  item: (state) => (itemId) => {
    return state.itemsAll[itemId]
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/item').catch((err) => {
      console.log(err)
    })
    commit('SET_ITEMS_ALL', { items: data.items })
  },
  create({ commit }) {
    // TODO 新規アイテム作成
    // TODO Noteにアイテムを追加
  },
  delete({ commit }, { itemId }) {
    // TODO: delete item from DB
    commit('DELETE', { itemId })
    commit('note/REMOVE_ITEM', { itemId })
  },
  update({ commit }, { item }) {
    // TODO: update item body
    commit('UPDATE', { item })
  }
}

export const mutations = {
  SET_ITEMS_ALL(state, { items }) {
    state.itemsAll = items
  },
  ADD(state, { item }) {
    state.itemsAll[item.id] = ''
  },
  UPDATE(state, { item }) {
    // TODO 対象item の body を更新
  },
  DELETE(state, { itemId }) {
    delete state.itemsAll[itemId]
  }
}
