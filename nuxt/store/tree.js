export const state = () => ({
  rack: null,
  folder: null,
  note: null,
  notes: null,

  //
  // TODO: rack に folderIds をもたせる or リレーション用のデータストアを追加する
  //

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
  },

  // ファイル
  // noteId: [itemId, ...]
  allNotes: {
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
  note: (state) => {
    return state.note
  },
  allRacks: (state) => {
    return state.allRacks
  },
  allFolders: (state) => {
    return state.allFolders
  },
  allNotes: (state) => {
    return state.allNotes
  },
  folders: (state) => (rackId) => {
    return state.allFolders[rackId]
  },
  notes: (state) => {
    return state.notes
  }
  // notes: (state) => (noteIds) => {
  //   return noteIds.map((noteId) => {
  //     return state.notes[noteId]
  //   }, state)
  // },
  // notesByRack: (state, getters) => (rackId) => {
  //   // folders by target rackId
  //   const folders = state.folders[rackId]
  //   // noteIds by target folder
  //   const noteIds = folders.map((folder) => {
  //     return folder.noteIds
  //   })
  //   // notes by target noteIds
  //   return getters.notes(noteIds.flat())
  // },
  // notesByFolder: (state, getters) => (rackId, folderId) => {
  //   // folders by target rackId
  //   const folders = state.folders[rackId]
  //   // folder by target folderId
  //   const folder = folders.filter((folder) => folder.id === folderId)[0]
  //   // notes by target folder
  //   return getters.notes(folder.noteIds)
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
  selectNote(context, rack, folder, note) {
    context.commit('SET_FILE', note)
  }
}

export const mutations = {
  SET_RACK(state, rack) {
    state.rack = rack
  },
  SET_FOLDER(state, folder) {
    state.folder = folder
  },
  SET_FILE(state, note) {
    state.note = note
  },
  SET_MY_FILES_IN_RACK(state, rack) {
    console.log(rack)
    // folders by target rackId
    const folders = state.allFolders[rack.id]
    // noteIds by target folder
    const noteIds = folders.map((folder) => {
      return folder.noteIds
    })
    // notes by target noteIds
    state.notes = noteIds.flat().map((noteId) => {
      return state.allNotes[noteId]
    }, state)
  },
  SET_MY_FILES_IN_FOLDER(state, folder) {
    console.log(folder)
    // notes by noteIds of the target folder
    state.notes = folder.noteIds.map((noteId) => {
      return state.allNotes[noteId]
    }, state)
  }
}
