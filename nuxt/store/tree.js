import axios from 'axios'

export const state = () => ({
  rackId: null,
  folderId: null,
  noteIds: [],
  racksAll: [],
  foldersAll: []

  //
  // TODO: rack に folderIds をもたせる or リレーション用のデータストアを追加する
  //

  // // ラック
  // racksAll: [
  //   {
  //     id: 1,
  //     name: 'rack1',
  //     folderIds: [11, 12]
  //   },
  //   {
  //     id: 2,
  //     name: 'rack2',
  //     folderIds: [21]
  //   },
  //   {
  //     id: 3,
  //     name: 'rack3',
  //     folderIds: []
  //   }
  // ],
  //
  // // フォルダ
  // // rackId: {folder}
  // foldersAll: [
  //   {
  //     id: 11,
  //     name: 'rack1-folder1',
  //     icon: 'mdi-folder',
  //     noteIds: [1, 2, 3]
  //   },
  //   {
  //     id: 12,
  //     name: 'rack1-folder2-test',
  //     icon: 'mdi-folder',
  //     noteIds: [4, 5]
  //   },
  //   {
  //     id: 21,
  //     name: 'rack2-folder1',
  //     icon: 'mdi-folder',
  //     noteIds: [6]
  //   }
  // ]
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
  getRacksAll(context) {
    axios.get('http://localhost:8080/api/rack').then((response) => {
      console.log(response.data)
      context.commit('SET_RACKS_ALL', response.data.racks)
    })
  },
  getFoldersAll(context) {
    axios.get('http://localhost:8080/api/folder').then((response) => {
      console.log(response.data)
      context.commit('SET_FOLDERS_ALL', response.data.folders)
    })
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
  CREAR_RACK_ID(state) {
    state.rackId = null
  },
  CREAR_FOLDER_ID(state) {
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
