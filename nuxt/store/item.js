export const state = () => ({
  itemsAll: [],
  itemEdited: {}
})

export const getters = {
  item: (state) => (itemId) => {
    return state.itemsAll.find((item) => item.id === itemId)
  },
  items: (state) => (itemIds) => {
    return itemIds
      ? state.itemsAll.filter((item) => itemIds.includes(item.id))
      : {}
  },
  itemEdited: (state) => {
    return state.itemEdited
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/item').catch((err) => {
      console.log(err)
    })
    commit('SET_ITEMS_ALL', { items: data.items })
  },
  async create({ commit }, { note }) {
    const data = await this.$axios
      .$post('/api/item', { noteId: note.id })
      .catch((error) => {
        console.log(error)
      })
    commit('ADD', { item: data.item })
    return data.item
  },
  async update({ commit }, { item }) {
    const data = await this.$axios
      .$put('/api/item/' + item.id, { item })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { item: data.item })
  },
  async delete({ commit }, { item }) {
    await this.$axios.$delete('/api/item/' + item.id).catch((error) => {
      console.log(error)
    })
    commit('DELETE', { item })
  },
  setItemEdited({ commit }, { item }) {
    commit('SET_ITEM_EDITED', { item })
  }
}

export const mutations = {
  SET_ITEMS_ALL(state, { items }) {
    state.itemsAll = items
  },
  ADD(state, { item }) {
    state.itemsAll.push(item)
  },
  UPDATE(state, { item }) {
    const index = state.itemsAll.findIndex((val) => val.id === item.id)
    state.itemsAll.splice(index, 1, item) // state.racksAll[index] = rack だと vuex が変更を検知できない
  },
  DELETE(state, { item }) {
    const index = state.itemsAll.findIndex((val) => val.id === item.id)
    state.itemsAll.splice(index, 1)
  },
  SET_ITEM_EDITED(state, { item }) {
    state.itemEdited = Object.assign({}, item)
  },
  UPDATE_ITEM_BODY(state, value) {
    // body の先頭と末尾の余計な文字列を除く
    state.itemEdited.body = value
  }
}
