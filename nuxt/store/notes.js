export const state = () => ({
  // 選択された NoteId
  noteId: null,
  // 全データ
  notesAll: [],
  itemsAll: []
  // notesAll: [
  //   {
  //     id: 1,
  //     name: 'name1',
  //     itemIds: [101, 102, 103]
  //   },
  //   {
  //     id: 2,
  //     name: 'name2',
  //     itemIds: [201, 202]
  //   },
  //   {
  //     id: 3,
  //     name: 'name3',
  //     itemIds: [301]
  //   },
  //   {
  //     id: 4,
  //     name: 'name4',
  //     itemIds: []
  //   },
  //   {
  //     id: 5,
  //     name: 'name5',
  //     itemIds: []
  //   },
  //   {
  //     id: 6,
  //     name: '',
  //     itemIds: []
  //   }
  // ],
  //
  // // アイテム
  // itemsAll: {
  //   101: '# item101',
  //   102: '# item102',
  //   103: '# item102',
  //   201: '# item201',
  //   202: '# item202',
  //   301: '# item301'
  // }
})

export const getters = {
  noteId: (state) => {
    return state.noteId
  },
  item: (state) => (itemId) => {
    return state.itemsAll[itemId]
  },
  notes: (state) => (noteIds) => {
    return state.notesAll.filter((note) => noteIds.includes(note.id))
  },
  note: (state) => (noteId) => {
    return state.notesAll.find((note) => note.id === noteId)
  }
}

export const actions = {
  async getNotesAll(context) {
    await this.$axios.get('http://localhost:8080/api/note').then((response) => {
      context.commit('SET_NOTES_ALL', response.data.notes)
    })
  },
  async getItemsAll(context) {
    await this.$axios.get('http://localhost:8080/api/item').then((response) => {
      context.commit('SET_ITEMS_ALL', response.data.items)
    })
  },
  setNotes(context, noteIds) {
    context.commit('SET_NOTES', noteIds)
  },
  setNoteId(context, noteId) {
    context.commit('SET_NOTE_ID', noteId)
  },
  createNote(context) {
    // TODO: crate item to DB
    const newNoteId = Math.floor(Math.random() * 1000) + 1 // 乱数生成、本来は DB で id 振られるはず。
    const newNote = {
      id: newNoteId,
      name: '',
      itemIds: []
    }
    context.commit('ADD_NOTE', newNote)
    context.commit('SET_NOTE_ID', newNoteId)
  },
  addItem(context) {
    // TODO: crate item to DB
    const newItemId = Math.floor(Math.random() * 1000) + 1 // 乱数生成、本来は DB で id 振られるはず。
    // TODO: Item class とか作るか。 あとで書き直す。
    context.commit('ADD_ITEM', newItemId)
    context.commit('ADD_ITEM_TO_NOTE', newItemId)
  },
  updateItem(context, itemEdited) {
    // TODO: update item in DB
    context.commit('UPDATE_ITEM', itemEdited)
  },
  deleteItem(context, deleteItemId) {
    // TODO: delete item from DB
    context.commit('DELETE_ITEM', deleteItemId)
    context.commit('DELETE_ITEM_FROM_NOTE', deleteItemId)
  },
  updateTitle(context, newNoteTitle) {
    // TODO: update note
    context.commit('UPDATE_TITLE', newNoteTitle)
  }
}

export const mutations = {
  SET_NOTES_ALL(state, resNotes) {
    state.notesAll = resNotes
  },
  SET_ITEMS_ALL(state, resItems) {
    state.itemsAll = resItems
  },
  SET_NOTES(state, noteIds) {
    state.notes = noteIds.map((noteId) => {
      return state.notesAll[noteId]
    }, state)
  },
  SET_NOTE_ID(state, noteId) {
    state.noteId = noteId
  },
  ADD_NOTE(state, note) {
    state.notesAll.push(note)
  },
  UPDATE_TITLE(state, newNoteTitle) {
    const index = state.notesAll.findIndex((note) => note.id === state.noteId)
    state.notesAll[index].name = newNoteTitle
  },
  ADD_ITEM(state, newItemId) {
    state.itemsAll[newItemId] = ''
  },
  ADD_ITEM_TO_NOTE(state, newItemId) {
    const index = state.notesAll.findIndex((note) => note.id === state.noteId)
    state.notesAll[index].itemIds.push(newItemId)
  },
  UPDATE_ITEM(state, itemEdited) {
    state.itemsAll[itemEdited.id] = itemEdited
  },
  DELETE_ITEM(state, deleteItemId) {
    delete state.itemsAll[deleteItemId]
  },
  DELETE_ITEM_FROM_NOTE(state, deleteItemId) {
    const index = state.notesAll.findIndex((note) => note.id === state.noteId)
    state.notesAll[index].itemIds = state.notesAll[index].itemIds.filter(
      (itemId) => itemId !== deleteItemId
    )
  }
}
