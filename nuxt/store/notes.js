export const state = () => ({
  // 選択された NoteId
  noteId: null,
  // 全データ
  notesAll: [
    {
      id: 1,
      title: 'title1',
      itemIds: [101, 102, 103]
    },
    {
      id: 2,
      title: 'title2',
      itemIds: [201, 202]
    },
    {
      id: 3,
      title: 'title3',
      itemIds: [301]
    },
    {
      id: 4,
      title: 'title4',
      itemIds: []
    },
    {
      id: 5,
      title: 'title5',
      itemIds: []
    },
    {
      id: 6,
      title: '',
      itemIds: []
    }
  ],

  // アイテム
  itemsAll: {
    101: '# item101',
    102: '# item102',
    103: '# item102',
    201: '# item201',
    202: '# item202',
    301: '# item301'
  }
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
  setNotes(context, noteIds) {
    context.commit('SET_NOTES', noteIds)
  },
  setNoteId(context, noteId) {
    context.commit('SET_NOTE_ID', noteId)
  },
  addItem(context, item) {
    // TODO: crate item to DB
    const itemId = Math.floor(Math.random() * 1000) + 1 // 乱数生成、本来は DB で id 振られるはず。
    // TODO: Item class とか作るか。 あとで書き直す。
    const newItem = {}
    newItem[itemId] = ''
    context.commit('ADD_ITEM_TO_ITEMS', newItem)
  },
  updateItem(context, itemEdited) {
    // TODO: update item in DB
    context.commit('UPDATE_ITEM', itemEdited)
  },
  delete(context, item) {
    // TODO: delete item from DB
    context.commit('DELETE_ITEM', item)
  },
  updateTitle(context, newNoteTitle) {
    // TODO: update note
    context.commit('UPDATE_TITLE', newNoteTitle)
  }
}

export const mutations = {
  SET_NOTES(state, noteIds) {
    state.notes = noteIds.map((noteId) => {
      return state.notesAll[noteId]
    }, state)
  },
  SET_NOTE_ID(state, noteId) {
    state.noteId = noteId
  },
  UPDATE_TITLE(state, newNoteTitle) {
    const index = state.notes.findIndex((note) => note === state.note)
    state.note.title = newNoteTitle
    state.notes[index] = state.note
  },
  ADD_ITEM_TO_ITEMS(state, newItem) {
    state.itemsAll.push(newItem)
  },
  UPDATE_ITEM(state, itemEdited) {
    state.itemsAll[itemEdited.id] = itemEdited.body
  },
  DELETE_ITEM(state, item) {}
}
