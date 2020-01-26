export const state = () => ({
  rackId: null,
  folderId: null,
  noteIds: [],

  //
  // TODO: rack に folderIds をもたせる or リレーション用のデータストアを追加する
  //

  // ラック
  racksAll: [
    {
      id: 1,
      name: 'rack1'
    },
    {
      id: 2,
      name: 'rack2'
    },
    {
      id: 3,
      name: 'rack3'
    }
  ],

  // フォルダ
  // rackId: {folder}
  foldersAll: {
    1: [
      {
        id: 11,
        name: 'rack1-folder1',
        icon: 'mdi-folder',
        noteIds: [1, 2, 3]
      },
      {
        id: 12,
        name: 'rack1-folder2-test',
        icon: 'mdi-folder',
        noteIds: [4, 5]
      }
    ],
    2: [
      {
        id: 21,
        name: 'rack2-folder1',
        icon: 'mdi-folder',
        noteIds: [6]
      }
    ],
    3: []
  }
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
  folders: (state) => (rackId) => {
    return state.foldersAll[rackId]
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
  selectRack(context, rack) {
    context.commit('CREAR_FOLDER_ID')
    context.commit('SET_RACK_ID', rack.id)
    context.commit('SET_NOTEIDS_IN_RACK', rack)
  },
  selectFolder(context, { rack, folder }) {
    context.commit('SET_RACK_ID', rack.id)
    context.commit('SET_FOLDER_ID', folder.id)
    context.commit('SET_NOTEIDS_IN_FOLDER', folder)
  }
  // addNoteId(context, noteId) {
  //   context.commit('ADD_NOTE_ID', noteId)
  // }
}

export const mutations = {
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
    // folders by target rackId
    const folders = state.foldersAll[rack.id]
    // noteIds by target folder
    const noteIdsList = folders.map((folder) => {
      return folder.noteIds
    })
    state.noteIds = noteIdsList.flat()
  },
  SET_NOTEIDS_IN_FOLDER(state, folder) {
    state.noteIds = folder.noteIds
  }
  // ADD_NOTE_ID(state, noteId) {
  //   state.folder.
  // }
}
