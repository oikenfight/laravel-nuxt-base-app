export const state = () => ({
  rackId: null,
  folderId: null,
  noteIds: [],
  racksAll: [],
  foldersAll: []
})

export const getters = {
  rackId: (state) => {
    return state.rackId
  },
  folderId: (state) => {
    return state.folderId
  },
  rack: (state) => (rackId) => {
    return state.racksAll.find((rack) => rack.id === rackId)
  },
  folder: (state) => (folderId) => {
    return state.foldersAll.find((folder) => folder.id === folderId)
  },
  racksAll: (state) => {
    return state.racksAll
  },
  foldersAll: (state) => {
    return state.foldersAll
  },
  folders: (state) => (folderIds) => {
    return state.foldersAll.filter((folder) => folderIds.includes(folder.id))
  },
  noteIds: (state) => {
    return state.noteIds
  }
  // treeItems: (state) => {
  //   // ファイル名、構成ファイル情報を付与してツリーを完成して返却
  //   const assenbleItems = (tree) => {
  //     // 各ファイルについて
  //     return tree.map((treeItem) => {
  //       // ファイル名、構成ファイルID情報を追加
  //       treeItem.name = state.names[treeItem.id]
  //       treeItem.itemIds = state.itemIds[treeItem.id]
  //       // サブディレクトリが存在する場合
  //       if (typeof treeItem.children === 'object') {
  //         assenbleItems(treeItem.children)
  //       }
  //       return treeItem
  //     })
  //   }
  //   return assenbleItems(state.tree)
  // }
}

export const actions = {
  async getRacksAll(context) {
    // await this.$axios.$get('/api/rack').then((response) => {
    //   context.commit('SET_RACKS_ALL', response.data.racks)
    // })
    const data = await this.$axios
      .$get('http://localhost:8080/api/rack')
      .catch((err) => {
        console.log(err)
      })
    console.log(data)
    console.log('here is getRacksAll')
    context.commit('SET_RACKS_ALL', data.racks)
  },
  async getFoldersAll(context) {
    const data = await this.$axios
      .$get('http://localhost:8080/api/folder')
      .catch((err) => {
        console.log(err)
      })
    console.log(data)
    console.log('here is getFoldersAll')
    context.commit('SET_FOLDERS_ALL', data.folders)
  },
  selectRack(context, rack) {
    context.commit('CREAR_FOLDER_ID')
    context.commit('SET_RACK_ID', rack.id)
    context.commit('SET_NOTEIDS_IN_RACK', rack)
  },
  selectFolder(context, { rack, folder }) {
    context.commit('SET_RACK_ID', rack.id)
    context.commit('SET_FOLDER_ID', folder.id)
    context.commit('SET_NOTEIDS_IN_FOLDER', folder)
  },
  addNoteId(context, noteId) {
    context.commit('ADD_NOTE_ID', noteId)
  }
}

export const mutations = {
  SET_RACKS_ALL(state, resRacks) {
    state.racksAll = resRacks
  },
  SET_FOLDERS_ALL(state, resFolders) {
    state.foldersAll = resFolders
  },
  CLEAR_RACK_ID(state) {
    state.rackId = null
  },
  CLEAR_FOLDER_ID(state) {
    state.folderId = null
  },
  SET_RACK_ID(state, rackId) {
    state.rackId = rackId
  },
  SET_FOLDER_ID(state, folderId) {
    state.folderId = folderId
  },
  SET_NOTEIDS_IN_RACK(state, rack) {
    // Rack内のFoldersのnoteIdsを集める
    const noteIdsList = state.foldersAll.map((folder) => {
      if (rack.folderIds.includes(folder.id)) {
        return folder.noteIds
      }
    })
    state.noteIds = noteIdsList.flat()
  },
  SET_NOTEIDS_IN_FOLDER(state, folder) {
    state.noteIds = folder.noteIds
  },
  ADD_NOTE_ID(state, noteId) {
    const index = state.foldersAll.findIndex(
      (folder) => folder.id === state.folderId
    )
    state.foldersAll[index].noteIds.push(noteId)
  }
}
