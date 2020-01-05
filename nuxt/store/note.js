export const state = () => ({
  // アイテム
  items: {
    101: 'item101',
    102: 'item102',
    1101: 'item1101',
    1102: 'item1102',
    11201: 'item11201',
    11202: 'item11202',
    1201: 'item1201',
    1202: 'item1202',
    1301: 'item1301',
    1302: 'item1302',
    201: 'item201',
    2101: 'item2101',
    2201: 'item2201',
    2301: 'item2301'
  }
})

export const getters = {
  tree: (state) => {
    return state.items
  }
}

export const actions = {
  testAction(context, value) {
    // コミットすることで状態変更が反映される
    context.commit('TEST_MUTATION', value)
  }
}

export const mutations = {
  TEST_MUTATION(state, value) {
    state.list += [value]
  }
}
