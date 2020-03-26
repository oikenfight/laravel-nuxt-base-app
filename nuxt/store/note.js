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
  createNote({ commit }) {
    // TODO: crate item to DB
    const newNoteId = Math.floor(Math.random() * 1000) + 1 // 乱数生成、本来は DB で id 振られるはず。
    const newNote = {
      id: newNoteId,
      name: '',
      itemIds: []
    }
    commit('ADD_NOTE', { newNote })
    commit('SET_NOTE_ID', { newNoteId })
  },
  add({ commit }, { itemId }) {
    commit('ADD_ITEM', { itemId })
  },
  remove({ commit }, { itemId }) {
    // TODO: remove item from DB
    commit('DELETE_ITEM', { itemId })
    commit('DELETE_ITEM_FROM_NOTE', { itemId })
  },
  updateTitle({ commit }, { note }) {
    // TODO: update note
    commit('UPDATE', { note })
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
    console.log(note)
    const index = state.notesAll.findIndex((val) => val.id === note.id)
    state.notesAll[index] = note
  },
  ADD_ITEM(state, { itemId }) {
    const index = state.notesAll.findIndex((note) => note.id === state.noteId)
    state.notesAll[index].itemIds.push(itemId)
  },
  REMOVE_ITEM(state, { itemId }) {
    const noteIndex = state.notesAll.findIndex(
      (note) => note.id === state.noteId
    )
    const itemIndex = state.notesAll[noteIndex].itemIds.indexOf(itemId)
    delete state.notesAll[noteIndex].itemIds[itemIndex]
  }
}
