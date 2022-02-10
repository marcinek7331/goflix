import axios from 'axios'

export const state = () => ({
  dataTVShows: {},
  dataSliders: {}
})

// getters
export const getters = {
  dataTVShows: state => state.dataTVShows,
  dataSliders: state => state.dataSliders,
}

// mutations
export const mutations = {
  FETCH_TVSHOWS_SUCCESS (state, tvshows) {
    state.dataTVShows = tvshows
  },
  FETCH_TVSHOWS_FAILURE (state) {
    state.dataTVShows = null
  },
  UPDATE_TVSHOWS (state, { tvshows }) {
    state.dataTVShows = tvshows
  },
  FETCH_SLIDERS_SUCCESS (state, sliders) {
    state.dataSliders = sliders
  },
  FETCH_SLIDERS_FAILURE (state) {
    state.dataSliders = null
  },
}

// actions
export const actions = {
  async fetchTVShows ({ commit }, payload) {
    try {
      const { data } = await axios.get('/tvshows/discover/'+payload)
      commit('FETCH_TVSHOWS_SUCCESS', data)
    } catch (e) {
      commit('FETCH_TVSHOWS_FAILURE')
    }
  },
  async fetchSliders ({ commit }) {
    try {
      const { data } = await axios.get('/sliders/tv')
      commit('FETCH_SLIDERS_SUCCESS', data)
    } catch (e) {
      commit('FETCH_SLIDERS_FAILURE')
    }
  },
  updateTVShows ({ commit }, payload) {
    commit('UPDATE_TVSHOWS', payload)
  },
}
