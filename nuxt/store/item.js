const itemEmpty = {
  id: 0,
  note_id: '',
  body: '',
  order_index: 0
}

export const state = () => ({
  activeIndex: null, // 選択中のitemのindex
  saveStatus: {
    saved: true, // 更新なし
    saving: false, // 更新中
    unsaved: false // 更新あり
  },
  isEditing: false, // 編集が止まったらitemsNoteに対して更新をかける
  editingStopTime: 0,
  itemsAll: [],
  itemsNote: [] // 表示中noteのitemリスト
})

export const getters = {
  item: (state) => (itemId) => {
    return state.itemsAll.find((item) => item.id === itemId)
  },
  items: (state) => (itemIds) => {
    return itemIds
      ? state.itemsAll.filter((item) => itemIds.includes(item.id))
      : {}
  },
  // 新規作成用のitemオブジェクト
  itemEmpty: () => {
    return itemEmpty
  },
  // 表示中noteのitemリスト
  itemsNote: (state) => {
    return state.itemsNote
  },
  // 編集中itemのindex
  activeIndex: (state) => {
    return state.activeIndex
  },
  // Save Status
  saveStatusIsSaved: (state) => {
    return state.saveStatus.saved
  },
  saveStatusIsSaving: (state) => {
    return state.saveStatus.saving
  },
  saveStatusIsUnsaved: (state) => {
    return state.saveStatus.unsaved
  },
  // noteの編集が一定時間以上経過したかどうか
  editingStopTime: (state) => {
    return state.editingStopTime
  },
  // 編集中itemのbody
  editedItemBody: (state) => {
    return state.itemsNote[state.activeIndex].body
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/item').catch((err) => {
      console.log(err)
    })
    commit('SET_ITEMS_ALL', { items: data.items })
  },
  async fetchNoteItems({ commit }, { note }) {
    const data = await this.$axios
      .$get('/api/item/note_items/' + note.id)
      .catch((error) => {
        console.log(error)
      })
    commit('SET_ITEMS_NOTE', { items: data.items })
    commit('SET_ITEMS_NOTE_ORDER_INDEX')
  },
  async create({ commit }, { note }) {
    const data = await this.$axios
      .$post('/api/item', { noteId: note.id })
      .catch((error) => {
        console.log(error)
      })
    return data.item
  },
  async update({ commit }, { item }) {
    const data = await this.$axios
      .$put('/api/item/' + item.id, { item })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { item: data.item })
  },
  async delete({ commit }, { item }) {
    await this.$axios.$delete('/api/item/' + item.id).catch((error) => {
      console.log(error)
    })
  }
}

export const mutations = {
  SET_ACTIVE_INDEX(state, { index }) {
    state.activeIndex = index
  },
  SET_ITEMS_ALL(state, { items }) {
    state.itemsAll = items
  },
  SET_ITEMS_NOTE(state, { items }) {
    state.itemsNote = items
  },
  SET_ITEMS_NOTE_ORDER_INDEX(state) {
    state.itemsNote.forEach((item, index) => {
      item.order_index = index
    })
  },
  ADD_NOTE_ITEM(state, { item, index }) {
    state.itemsNote.splice(index, 0, item)
  },
  UPDATE_NOTE_ITEM(state, { item, index }) {
    state.itemsNote.splice(index, 1, item) // state.itemsNote[index] = rack だと vuex が変更を検知できない
  },
  DELETE_NOTE_ITEM(state, { index }) {
    state.itemsNote.splice(index, 1)
  },
  UPDATE_EDITED_ITEM_BODY(state, { value }) {
    state.itemsNote[state.activeIndex].body = value
  },
  TOGGLE_SAVE_STATUS(state, { status }) {
    Object.keys(state.saveStatus).forEach((key) => {
      state.saveStatus[key] = key === status
    })
  },
  SET_EDITING_STOP_TIME(state, { time }) {
    state.editingStopTime = time
  }
}
