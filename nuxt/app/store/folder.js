export const state = () => ({
  folderId: null,
  foldersAll: []
})

export const getters = {
  folderId: (state) => {
    return state.folderId
  },
  folder: (state) => (folderId) => {
    folderId = parseInt(folderId)
    return state.foldersAll.find((folder) => folder.id === folderId)
  },
  foldersAll: (state) => {
    return state.foldersAll
  },
  folders: (state) => (folderIds) => {
    return state.foldersAll.filter((folder) => folderIds.includes(folder.id))
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/folder').catch((err) => {
      console.log(err)
    })
    commit('SET_FOLDERS_ALL', { folders: data.folders })
  },
  async create({ commit }, { rack }) {
    const data = await this.$axios
      .$post('/api/folder', { rackId: rack.id })
      .catch((error) => {
        console.log(error)
      })
    commit('ADD', { folder: data.folder })
    return data.folder
  },
  async update({ commit }, { folder }) {
    const data = await this.$axios
      .$put('/api/folder/' + folder.id, { folder })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { folder: data.folder })
  },
  async delete({ commit }, { folder }) {
    await this.$axios.$delete('/api/folder/' + folder.id).catch((error) => {
      console.log(error)
    })
    commit('DELETE', { folder })
  },
  addNote({ commit }, { folder, note }) {
    commit('ADD_NOTE_ID', { folder, note })
  }
}

export const mutations = {
  SET_FOLDERS_ALL(state, { folders }) {
    state.foldersAll = folders
  },
  ADD(state, { folder }) {
    state.foldersAll.push(folder)
  },
  UPDATE(state, { folder }) {
    const index = state.foldersAll.findIndex((val) => val.id === folder.id)
    state.foldersAll.splice(index, 1, folder) // state.foldersAll[index] = folder だと vuex が変更を検知できない
  },
  DELETE(state, { folder }) {
    const index = state.foldersAll.findIndex((val) => val.id === folder.id)
    state.foldersAll.splice(index, 1)
  },
  ADD_NOTE_ID(state, { folder, note }) {
    folder.note_ids.push(note.id)
  }
}
