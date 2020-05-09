export const state = () => ({
  categoriesAll: []
})

export const getters = {
  category: (state) => (categoryId) => {
    categoryId = parseInt(categoryId)
    return state.categoriesAll.find((category) => category.id === categoryId)
  },
  categoriesAll: (state) => {
    return state.categoriesAll
  },
  categories: (state) => (categoryIds) => {
    return state.categoriesAll.filter((category) =>
      categoryIds.includes(category.id)
    )
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/category').catch((err) => {
      console.log(err)
    })
    commit('SET_CATEGORIES_ALL', { categories: data.categories })
  },
  async create({ commit }) {
    const data = await this.$axios.$post('/api/category').catch((error) => {
      console.log(error)
    })
    commit('ADD', { category: data.category })
    return data.category
  },
  async update({ commit }, { category }) {
    const data = await this.$axios
      .$put('/api/category/' + category.id, { category })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { category: data.category })
  },
  async delete({ commit }, { category }) {
    await this.$axios.$delete('/api/category/' + category.id).catch((error) => {
      console.log(error)
    })
    commit('DELETE', { category })
  },
  addNote({ commit }, { category, note }) {
    commit('ADD_NOTE_ID', { category, note })
  }
}

export const mutations = {
  SET_CATEGORIES_ALL(state, { categories }) {
    state.categoriesAll = categories
  },
  ADD(state, { category }) {
    state.categoriesAll.push(category)
  },
  UPDATE(state, { category }) {
    const index = state.categoriesAll.findIndex((val) => val.id === category.id)
    state.categoriesAll.splice(index, 1, category) // state.categoriesAll[index] = category だと vuex が変更を検知できない
  },
  DELETE(state, { category }) {
    const index = state.categoriesAll.findIndex((val) => val.id === category.id)
    state.categoriesAll.splice(index, 1)
  },
  ADD_NOTE_ID(state, { category, note }) {
    category.note_ids.push(note.id)
  }
}
