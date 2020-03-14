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
  select({ commit }, { itemId }) {
    commit('SET_ITEM', { itemId })
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
  update({ commit }, { body }) {
    // TODO: update item body
    commit('UPDATE', { body })
  }
}

export const mutations = {
  SET_ITEMS_ALL(state, items) {
    state.itemsAll = items
  },
  SET_ITEM_ID(state, { itemId }) {
    state.itemId = itemId
  },
  ADD(state, item) {
    state.itemsAll[item.id] = ''
  },
  UPDATE(state, { body }) {
    // TODO 対象item の body を更新
  },
  DELETE(state, { itemId }) {
    delete state.itemsAll[itemId]
  }
}
