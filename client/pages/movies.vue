<template >
    <transition v-if="!loading" name="slide-fade" appear="appear">
      <div>
        <Slider :object="sliders.results"/>
        <MoviesFiltr @genres="openGenresModal" />
        <MoviesList :object="movies"/>
        <pagination :data="movies" :onEachSide="3" @paginateTo="fetchMovies"/>
        <Modal :activated.sync="modal.genres">
          <template v-slot:header>
            <h1>Wybierz gatunki</h1>
            <div class="modal-close" @click="close"><i class="icon-Close"></i></div>
          </template>
          <template v-slot:body>
              <Genres/>
          </template>
        </Modal>
      </div>

    </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Pagination from '~/components/global/Pagination'
import Slider from '~/components/default/Slider'
import MoviesList from './movies/MoviesList'
import MoviesFiltr from './movies/MoviesFiltr'
import Modal from '~/components/global/Modal'
import Genres from '~/components/default/Genres'
export default {
  middleware: ['auth', 'verify'],
  components: {
    Slider,
    Pagination,
    MoviesList,
    MoviesFiltr,
    Modal,
    Genres
  },
  head () {
    return { title: 'Filmy' }
  },
  computed: mapGetters({
    movies: 'movies/movies',
    sliders: 'movies/dataSliders',
    user: 'auth/user',

  }),
  data: () => ({
    loading: true,
    modal: {
      genres: false,
    }
  }),
  async mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start()
    })
    await this.fetchSlidersMovies()
    await this.fetchMovies()
    this.loading = false
    this.$nextTick(() => {
      this.$nuxt.$loading.finish()
    })
  },
  methods: {
    openGenresModal() {
      this.modal.genres = !this.modal.genres
    },
    async fetchSlidersMovies() {
      if(!this.sliders) {
        await this.$store.dispatch('movies/fetchSliders')
      }

    },
    async fetchMovies(page = 1) {
      await this.$store.dispatch('movies/fetchMovies', page)
    },

  }
}
</script>
