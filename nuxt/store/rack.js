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
  },
  async update({ commit }, { rack }) {
    const data = await this.$axios
      .$put('/api/rack/' + rack.id, { rack })
      .catch((error) => {
        console.log(error)
      })
    commit('UPDATE', { rack: data.rack })
  },
  async delete({ commit }, { rack }) {
    console.log(rack)
    await this.$axios.$delete('/api/rack/' + rack.id).catch((error) => {
      console.log(error)
    })
    commit('DELETE', { rack })
  }
}

export const mutations = {
  SET_RACKS_ALL(state, { racks }) {
    state.racksAll = racks
  },
  ADD(state, { rack }) {
    state.racksAll.push(rack)
  },
  UPDATE(state, { rack }) {
    const index = state.racksAll.findIndex((val) => val.id === rack.id)
    state.racksAll.splice(index, 1, rack) // state.racksAll[index] = rack だと vuex が変更を検知できない
  },
  DELETE(state, { rack }) {
    const index = state.racksAll.findIndex((val) => val.id === rack.id)
    state.racksAll.splice(index, 1)
  }
}
