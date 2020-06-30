window.axios = require('axios');
export default {
  state:{
    allProvinces: {},
    allTracings: {},
    allActivities: {},
    allProdLines: {}
  },
  mutations:{
    setProvinces(state, data) {
      state.allProvinces = data;
    },
    setActivities(state, data) {
      state.allActivities = data;
    },
    setProdLines(state, data) {
      state.allProdLines = data;
    },
  },
  actions:{
    getProvinces: async function({ commit }) {
      const data = await axios.get('provinces')
      commit('setProvinces', data.data)
    },
    getProdLines: async function({ commit}) {
      const data = await axios.get('production-lines')
      commit('setProdLines', data.data)
    },
    getActivities: async function({ commit}) {
      const data = await axios.get('activities')
      commit('setActivities', data.data)
    }
  },
  getters:{

  }
}
