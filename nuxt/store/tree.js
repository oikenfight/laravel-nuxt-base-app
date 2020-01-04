export const state = () => ({
  rack: null,
  folder: null,
  file: null,
  myFiles: null,
  // ラック
  allRacks: [
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
  allFolders: {
    1: [
      {
        id: 11,
        name: 'rack1-folder1',
        icon: 'mdi-folder',
        fileIds: [1, 2, 3]
      },
      {
        id: 12,
        name: 'rack1-folder2-test',
        icon: 'mdi-folder',
        fileIds: [4, 5]
      }
    ],
    2: [
      {
        id: 21,
        name: 'rack2-folder1',
        icon: 'mdi-folder',
        fileIds: [6]
      }
    ],
    3: []
  },

  // ファイル
  // fileId: [itemId, ...]
  allFiles: {
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
  }
})

export const getters = {
  rack: (state) => {
    return state.rack
  },
  folder: (state) => {
    return state.folder
  },
  file: (state) => {
    return state.file
  },
  allRacks: (state) => {
    return state.myRacks
  },
  allFolders: (state) => {
    return state.allFolders
  },
  allFiles: (state) => {
    return state.myFiles
  },
  myFolders: (state) => (rackId) => {
    return state.myFolders[rackId]
  }
  // files: (state) => (fileIds) => {
  //   return fileIds.map((fileId) => {
  //     return state.files[fileId]
  //   }, state)
  // },
  // filesByRack: (state, getters) => (rackId) => {
  //   // folders by target rackId
  //   const folders = state.folders[rackId]
  //   // fileIds by target folder
  //   const fileIds = folders.map((folder) => {
  //     return folder.fileIds
  //   })
  //   // files by target fileIds
  //   return getters.files(fileIds.flat())
  // },
  // filesByFolder: (state, getters) => (rackId, folderId) => {
  //   // folders by target rackId
  //   const folders = state.folders[rackId]
  //   // folder by target folderId
  //   const folder = folders.filter((folder) => folder.id === folderId)[0]
  //   // files by target folder
  //   return getters.files(folder.fileIds)
  // },
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
    context.commit('SET_RACK', rack)
    context.commit('SET_MY_FILES_IN_RACK', rack)
  },
  selectFolder(context, { rack, folder }) {
    context.commit('SET_RACK', rack)
    context.commit('SET_FOLDER', folder)
    context.commit('SET_MY_FILES_IN_FOLDER', folder)
  },
  selectFile(context, rack, folder, file) {
    context.commit('SET_FILE', file)
  }
}

export const mutations = {
  SET_RACK(state, rack) {
    state.rack = rack
  },
  SET_FOLDER(state, folder) {
    state.folder = folder
  },
  SET_FILE(state, file) {
    state.file = file
  },
  SET_MY_FILES_IN_RACK(state, rack) {
    // folders by target rackId
    const folders = state.folders[rack.id]
    // fileIds by target folder
    const fileIds = folders.map((folder) => {
      return folder.fileIds
    })
    // files by target fileIds
    state.myFiles = fileIds.flat().map((fileId) => {
      return state.files[fileId]
    }, state)
  },
  SET_MY_FILES_IN_FOLDER(state, folder) {
    // files by fileIds of the target folder
    state.myFiles = folder.fileIds.map((fileId) => {
      return state.files[fileId]
    }, state)
  }
}
