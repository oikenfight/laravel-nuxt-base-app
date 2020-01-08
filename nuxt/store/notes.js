export const state = () => ({
  // 選択された Note
  note: null,
  // Rack or Folder 内の Notes
  notes: {},
  // 全データ（{noteId: [itemId, ...]}, ...）
  notesAll: {
    1: {
      title: 'title1',
      itemIds: [101, 102, 103]
    },
    2: {
      title: 'title2',
      itemIds: [201, 202]
    },
    3: {
      title: 'title3',
      itemIds: [301]
    },
    4: {
      title: 'title4',
      itemIds: []
    },
    5: {
      title: 'title5',
      itemIds: []
    },
    6: {
      title: '',
      itemIds: []
    }
  },

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
  item: (state) => (itemId) => {
    return state.itemsAll[itemId]
  },
  notes: (state) => {
    return state.notes
  },
  note: (state) => {
    return state.note
  }
}

export const actions = {
  setNotes(context, noteIds) {
    context.commit('SET_NOTES', noteIds)
  },
  setNote(context, note) {
    context.commit('SET_NOTE', note)
  },
  add(context, item) {
    // TODO: crate item to DB
    context.commit('ADD_ITEM', item)
  },
  update(context, item) {
    // TODO: update item in DB
    context.commit('UPDATE_ITEM', item)
  },
  delete(context, item) {
    // TODO: delete item from DB
    context.commit('DELETE_ITEM', item)
  },
  inputTitle(context, note) {
    context.commit('UPDATE_NOTE_TITLE', note)
  }
}

export const mutations = {
  SET_NOTES(state, noteIds) {
    state.notes = noteIds.map((noteId) => {
      return state.notesAll[noteId]
    }, state)
  },
  SET_NOTE(state, note) {
    state.note = note
  },
  ADD_ITEM(state, item) {},
  UPDATE_ITEM(state, item) {},
  DELETE_ITEM(state, item) {}
}
