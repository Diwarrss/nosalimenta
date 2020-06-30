window.axios = require('axios');
export default {
  state:{
    allProvinces: {},
    allTracings: {},
    allProdLines: {}
  },
  mutations:{
    setProvinces(state, data) {
      state.allProvinces = data;
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
    }
  },
  getters:{

  }
}
