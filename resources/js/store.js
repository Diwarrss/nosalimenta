window.axios = require('axios');
export default {
  state:{
    user: {},
    allProvinces: {},
    allTracings: {},
    allActivities: {},
    allProdLines: {},
    allMunicipalities: {},
    allDevelopedActivities: {}
  },
  mutations:{
    setUser(state, data) {
      state.user = data;
    },
    setProvinces(state, data) {
      state.allProvinces = data;
    },
    setActivities(state, data) {
      state.allActivities = data;
    },
    setProdLines(state, data) {
      state.allProdLines = data;
    },
    setTracings(state, data) {
      state.allTracings = data;
    },
    setMunicipalities(state , data){
      state.allMunicipalities = data
    },
    setDevelopedActivities(state , data){
      state.allDevelopedActivities = data[0]
    }
  },
  actions:{
    getUser: async function({ commit }) {
      const data = await axios.get('user')
      commit('setUser', data.data)
    },
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
    },
    getTracings: async function({ commit}) {
      const data = await axios.get('tracings')
      commit('setTracings', data.data)
    },
    getMunicipalities: async function({ commit}, id) {
      const data = await axios.get('municipalities', {
        params: {
          id: id
        }
      })
      commit('setMunicipalities', data.data)
    },
    getDevelopedActivities: async function({ commit}, id) {
      const data = await axios.get('tracings', {
        params: {
          id: id
        }
      })
      commit('setDevelopedActivities', data.data)
    },
  },
  getters:{

  }
}
