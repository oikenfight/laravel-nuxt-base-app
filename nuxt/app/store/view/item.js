export const state = () => ({
  // ノートのアイテム
  items: []
})

export const getters = {
  items: (state) => {
    return state.items
  },
  item: (state) => (itemId) => {
    itemId = parseInt(itemId)
    return state.items.find((item) => item.id === itemId)
  }
}

export const actions = {
  async fetch({ commit }, { noteId }) {
    const data = await this.$axios
      .$get('/api/view/note_items/' + noteId)
      .catch((err) => {
        console.log(err)
      })
    commit('SET_ITEMS', { items: Object.values(data.items) })
  }
}

export const mutations = {
  SET_ITEMS(state, { items }) {
    state.items = items
  }
}
