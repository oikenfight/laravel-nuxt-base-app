export const state = () => ({
  // 全データ
  notesAll: []
})

export const getters = {
  note: (state) => (noteId) => {
    noteId = parseInt(noteId)
    return state.notesAll.find((note) => note.id === noteId)
  },
  notes: (state) => (noteIds) => {
    return noteIds
      ? state.notesAll.filter((note) => noteIds.includes(note.id))
      : {}
  },
  notesAll: (state) => {
    return state.notesAll
  },
  notesCategory: (state) => (categoryId) => {
    categoryId = parseInt(categoryId)
    return state.notesAll.filter((note) => note.category_id === categoryId)
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/view/note').catch((err) => {
      console.log(err)
    })
    commit('SET_NOTES_ALL', { notes: Object.values(data.notes) })
  }
}

export const mutations = {
  SET_NOTES_ALL(state, { notes }) {
    state.notesAll = notes
  }
}
