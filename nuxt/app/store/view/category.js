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
    const data = await this.$axios.$get('/api/view/categories').catch((err) => {
      console.log(err)
    })
    commit('SET_CATEGORIES_ALL', { categories: data.categories })
  }
}

export const mutations = {
  SET_CATEGORIES_ALL(state, { categories }) {
    state.categoriesAll = categories
  }
}
