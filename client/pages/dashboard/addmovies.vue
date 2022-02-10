<template >
  <!-- <div class="container">
  <ul class="dashboard">
    <button @click="selectAllGrabMovie()" class="btn dashboard__btn">Dodaj całą stronę</button>
    <div class="row">
      <li class="col-2 dashboard__item" :class="movie.added ? 'dashboard__item--active' : ''" @click="selectGrabMovie(movie.link, index)" :key="index" v-for="(movie, index) in movies.data">
        <img class="dashboard__image" v-lazy="movie.poster" :alt="movie.title">
        <h1 class="dashboard__title">{{movie.title}}</h1>
        <p class="dashboard__year">{{movie.year}}</p>
      </li>
    </div>

  </ul>
  <pagination :data="movies" :onEachSide="3" @paginateTo="fetchGrabMovieList"/>
</div> -->
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Pagination from '~/components/global/Pagination'


export default {
  middleware: ['auth', 'verify', 'admin'],
  layout: 'dashboard',
  components: {
    Pagination
  },
  head () {
    return { title: 'dashboard' }
  },

  data: () => ({
    movies: [],
  }),
  async mounted() {
    //this.fetchGrabMovieList()
  },
  methods: {
    async fetchGrabMovieList(page = 1) {
      const {data} = await axios.get('/grab/getMovieList?page='+page)
      this.movies = data
    },
    async selectGrabMovie(link, index) {
      const {data} = await axios.get('/grab/getMovie?link='+link)
      this.movies.data[index].added = true
    },
    async selectAllGrabMovie() {
      await this.movies.data.forEach((movie, i) => {
        if(!movie.added) {
          this.selectGrabMovie(movie.link, i)
        }
      });

    }
  }
}
</script>
