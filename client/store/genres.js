import axios from 'axios'

export const state = () => ({
  genres: [
    {id: 28, name: 'Akcja', active: false},
    {id: 16, name: 'Animacja', active: false},
    {id: 99, name: 'Dokumentalny', active: false},
    {id: 18, name: 'Dramat', active: false},
    {id: 10751, name: 'Familijny', active: false},
    {id: 14, name: 'Fantastyczny', active: false},
    {id: 36, name: 'Historyczny', active: false},
    {id: 27, name: 'Horror', active: false},
    {id: 35, name: 'Komedia', active: false},
    {id: 80, name: 'Kryminał', active: false},
    {id: 10402, name: 'Muzyczny', active: false},
    {id: 12, name: 'Przygodowy', active: false},
    {id: 10749, name: 'Romantyczny', active: false},
    {id: 878, name: 'Sci-fi', active: false},
    {id: 9648, name: 'Tajemnica', active: false},
    {id: 53, name: 'Thiller', active: false},
    {id: 37, name: 'Western', active: false},
    {id: 10752, name: 'Wojenny', active: false},
  ],
})

export const getters = {
  genres: state => state.genres,
}

export const mutations = {
  UPDATE_GENRES (state, id ) {
    state.genres[id].active = !state.genres[id].active
  }
}

export const actions = {
  updateGenres ({ commit }, payload) {
    commit('UPDATE_GENRES', payload)
  },
}
