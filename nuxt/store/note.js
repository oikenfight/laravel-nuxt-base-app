export const state = () => ({
  // 選択された NoteId
  noteId: null,
  // 全データ
  notesAll: []
})

export const getters = {
  noteId: (state) => {
    return state.noteId
  },
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
    // crate note
    const data = await this.$axios
      .$post('/api/note', { folder_id: folder.id })
      .catch((err) => {
        console.log(err)
      })
    commit('ADD', { note: data.note })
  },
  remove({ commit }, { itemId }) {
    // TODO: remove item from DB
    commit('DELETE_ITEM', { itemId })
    commit('DELETE_ITEM_FROM_NOTE', { itemId })
  },
  updateTitle({ commit }, { note }) {
    // TODO: update note
    commit('UPDATE', { note })
  },
  async addItem({ commit }, { noteId }) {
    // 新規 Item を作成
    const data = await this.$axios
      .$post('/api/item', { note_id: noteId })
      .catch((err) => {
        console.log(err)
      })
    commit('ADD_ITEM', { noteId, item: data.item })
    commit('UPDATE', { note: data.note })
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
    state.notesAll[index] = note
  },
  ADD_ITEM(state, { itemId }) {
    const index = state.notesAll.findIndex((note) => note.id === state.noteId)
    state.notesAll[index].item_ids.push(itemId)
  },
  REMOVE_ITEM(state, { itemId }) {
    const noteIndex = state.notesAll.findIndex(
      (note) => note.id === state.noteId
    )
    const itemIndex = state.notesAll[noteIndex].item_ids.indexOf(itemId)
    delete state.notesAll[noteIndex].item_ids[itemIndex]
  }
}
