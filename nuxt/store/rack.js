export const state = () => ({
  rackId: null,
  racksAll: []
})

export const getters = {
  rackId: (state) => {
    return state.rackId
  },
  rack: (state) => (rackId) => {
    return state.racksAll.find((rack) => rack.id === rackId)
  },
  racksAll: (state) => {
    return state.racksAll
  }
}

export const actions = {
  async fetchAll({ commit }) {
    const data = await this.$axios.$get('/api/rack').catch((error) => {
      console.log(error)
    })
    commit('SET_RACKS_ALL', { racks: data.racks })
  },
  async create({ commit }) {
    const data = await this.$axios.$post('/api/rack').catch((error) => {
      console.log(error)
    })
    commit('ADD', { rack: data.rack })
  }
}

export const mutations = {
  SET_RACKS_ALL(state, { racks }) {
    state.racksAll = racks
  },
  ADD(state, { rack }) {
    state.racksAll.push(rack)
  }
}
