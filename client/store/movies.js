import axios from 'axios'

// state
export const state = () => ({
  movies: {},
  dataSliders: null
})

// getters
export const getters = {
  movies: state => state.movies,
  dataSliders: state=> state.dataSliders
}

// mutations
export const mutations = {
  FETCH_MOVIES_SUCCESS (state, movies) {
    state.movies = movies
  },
  FETCH_MOVIES_FAILURE (state) {
    state.movies = null
  },
  UPDATE_MOVIES (state, { movies }) {
    state.movies = movies
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
  async fetchMovies ({ commit }, payload) {
    try {
      const { data } = await axios.get('/movies/discover/'+payload)
      commit('FETCH_MOVIES_SUCCESS', data)
    } catch (e) {
      commit('FETCH_MOVIES_FAILURE')
    }
  },
  async fetchSliders ({ commit }) {
    try {
      const { data } = await axios.get('/sliders/movies')
      commit('FETCH_SLIDERS_SUCCESS', data)
    } catch (e) {
      commit('FETCH_SLIDERS_FAILURE')
    }
  },
  updateMovies ({ commit }, payload) {
    commit('UPDATE_MOVIES', payload)
  },
}
