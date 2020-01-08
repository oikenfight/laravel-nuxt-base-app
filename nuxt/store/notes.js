export const state = () => ({
  // 選択した note が持つアイテム
  notes: {},

  // noteId: [itemId, ...]
  notesAll: {
    1: {
      title: 'title1',
      itemIds: [1, 2, 3]
    },
    2: {
      title: 'title2',
      itemIds: [4, 5]
    },
    3: {
      title: 'title3',
      itemIds: [6]
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
    1101: '# item1101',
    1102: '# item1102',
    11201: '# item11201',
    11202: '# item11202',
    1201: '# item1201',
    1202: '# item1202',
    1301: '# item1301',
    1302: '# item1302',
    201: '# item201',
    2101: '# item2101',
    2201: '# item2201',
    2301: '# item2301'
  }
})

export const getters = {
  item: (state) => (itemId) => {
    return state.itemsAll[itemId]
  },
  notes: (state) => {
    return state.notes
  },
  note: (state) => (noteId) => {
    return state.notesAll[noteId]
  }
}

export const actions = {
  setNotes(context, noteIds) {
    context.commit('SET_NOTES', noteIds)
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
  ADD_ITEM(state, item) {},
  UPDATE_ITEM(state, item) {},
  DELETE_ITEM(state, item) {}
}
