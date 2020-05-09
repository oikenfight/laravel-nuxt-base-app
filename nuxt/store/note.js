const noteStatus = {
  nonReleased: 0,
  released: 1
}

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
  notesReleased: (state) => {
    return state.notesAll.filter((note) => note.status === noteStatus.released)
  },
  notesReleasedOfCategory: (state) => (categoryId) => {
    categoryId = parseInt(categoryId)
    return state.notesAll
      .filter((note) => note.status === noteStatus.released)
      .filter((note) => note.category_id === categoryId)
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/note').catch((err) => {
      console.log(err)
    })
    commit('SET_NOTES_ALL', { notes: data.notes })
  },
  async create({ commit }, { folder }) {
    const data = await this.$axios
      .$post('/api/note', { folderId: folder.id })
      .catch((error) => {
        console.log(error)
      })
    commit('ADD', { note: data.note })
    return data.note
  },
  async update({ commit }, { note }) {
    const data = await this.$axios
      .$put('/api/note/' + note.id, { note })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { note: data.note })
  },
  async delete({ commit }, { note }) {
    await this.$axios.$delete('/api/note/' + note.id).catch((error) => {
      console.log(error)
    })
    commit('DELETE', { note })
  },
  addItem({ commit }, { note, item }) {
    commit('ADD_ITEM', { note, item })
  },
  deleteItem({ commit }, { note, item }) {
    commit('DELETE_ITEM', { note, item })
  }
}

export const mutations = {
  SET_NOTES_ALL(state, { notes }) {
    state.notesAll = notes
  },
  ADD(state, { note }) {
    state.notesAll.push(note)
  },
  UPDATE(state, { note }) {
    const index = state.notesAll.findIndex((val) => val.id === note.id)
    state.notesAll.splice(index, 1, note) // state.racksAll[index] = rack だと vuex が変更を検知できない
  },
  DELETE(state, { note }) {
    const index = state.notesAll.findIndex((val) => val.id === note.id)
    state.notesAll.splice(index, 1)
  },
  ADD_ITEM(state, { note, item }) {
    note.item_ids.push(item.id)
  },
  DELETE_ITEM(state, { note, item }) {
    note.item_ids = note.item_ids.filter((id) => id !== item.id)
  },
  REMOVE_ITEM(state, { itemId }) {
    const noteIndex = state.notesAll.findIndex(
      (note) => note.id === state.noteId
    )
    const itemIndex = state.notesAll[noteIndex].item_ids.indexOf(itemId)
    delete state.notesAll[noteIndex].item_ids[itemIndex]
  }
}
