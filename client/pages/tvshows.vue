<template >
    <transition v-if="!loader" name="slide-fade" appear="appear">
      <div>
        <!-- <Slider :object="sliders.results"/> -->
        <MoviesFiltr/>
        <TVShowsList :object="tvshows"/>
        <pagination :data="tvshows" :onEachSide="3" @paginateTo="fetchTVShows"/>
      </div>

    </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Pagination from '~/components/global/Pagination'
import Slider from '~/components/default/Slider'
import TVShowsList from './tvshows/TVShowsList'
import MoviesFiltr from './movies/MoviesFiltr'

export default {
  middleware: ['auth', 'verify'],
  components: {
    Slider,
    Pagination,
    TVShowsList,
    MoviesFiltr
  },
  head () {
    return { title: 'Seriale' }
  },
  computed: mapGetters({
    tvshows: 'tvshows/dataTVShows',
  }),
  data: () => ({
    loading: {
      sliders: true,
      movies: true
    },
    loader: true
  }),
  async mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start()
    })
    await this.fetchSlidersTVShows()
    await this.fetchTVShows()
    this.$nextTick(() => {
      this.$nuxt.$loading.finish()
    })
    this.loader = false
  },
  methods: {
    async fetchSlidersTVShows() {
      if(!this.sliders) {
        await this.$store.dispatch('tvshows/fetchSliders')
      }
    },
    async fetchTVShows(page = 1) {
      await this.$store.dispatch('tvshows/fetchTVShows', page)
    },

  }
}
</script>
