export const state = () => ({
  folderId: null,
  foldersAll: []
})

export const getters = {
  folderId: (state) => {
    return state.folderId
  },
  folder: (state) => (folderId) => {
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
  selectFolder({ commit }, { rack, folder }) {
    commit('rack/SET_RACK_ID', rack.id)
    commit('SET_FOLDER_ID', folder.id)
  }
}

export const mutations = {
  SET_FOLDERS_ALL(state, { folders }) {
    state.foldersAll = folders
  },
  SET_FOLDER_ID(state, { folderId }) {
    state.folderId = folderId
  }
}
