// TODO: plugins/constantsを参照できるようにしたい
const noteStatuses = {
  nonReleased: 0,
  released: 1,
  all: 2
}

export const state = () => ({
  // 全データ
  notesAll: [],
  displayedStatus: 2
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
    return state.notesAll.filter(
      (note) => note.status === noteStatuses.released
    )
  },
  folderNotesByStatus: (state) => ({ folderId, noteStatus }) => {
    folderId = parseInt(folderId)
    noteStatus = parseInt(noteStatus)
    let notes = state.notesAll.filter((note) => note.folder_id === folderId)
    if (
      noteStatus === noteStatuses.released ||
      noteStatus === noteStatuses.nonReleased
    ) {
      notes = notes.filter((note) => note.status === noteStatus)
    }
    return notes
  },
  categoryNotesByStatus: (state) => ({ categoryId, noteStatus }) => {
    categoryId = parseInt(categoryId)
    noteStatus = parseInt(noteStatus)
    let notes = state.notesAll.filter((note) => note.category_id === categoryId)
    if (
      noteStatus === noteStatuses.released ||
      noteStatus === noteStatuses.nonReleased
    ) {
      notes = notes.filter((note) => note.status === noteStatus)
    }
    return notes
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
  addItem({ commit }, { note, item, index }) {
    commit('ADD_ITEM', { note, item, index })
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
  ADD_ITEM(state, { note, item, index }) {
    // 指定された位置（index）の次に新しい item を追加
    note.item_ids.splice(index, 0, item.id)
  },
  DELETE_ITEM(state, { note, item }) {
    note.item_ids = note.item_ids.filter((id) => id !== item.id)
  },
  REPLACE_NOTE_ITEM(state, { note, oldItemId, newItemId }) {
    console.log(note)
    const index = note.item_ids.findIndex((id) => id === oldItemId)
    note.item_ids.splice(index, 1, newItemId)
  }
}
