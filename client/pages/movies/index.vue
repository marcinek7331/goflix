<template>
  <div>
    <div v-if="loading.sliders" class="col-12 w-100">
      <div class="skeleton-item skeleton-image" style="height:85vh; width:100%"></div>
    </div>
    <Slider v-else :object="sliders"/>
    <div class="filter-container">
      <div class="col-xl-4 col-12 filter-rate">
        <div class="header">
          <h3>Ocena</h3>
          <p v-text="rate == null ? 'Dowolna' : rate"></p>
        </div>
        <div class="body">
          <div class="rating">
            <input type="radio" name="rating" v-model="rate" value="10" id="10"><label for="10">☆</label>
            <input type="radio" name="rating" v-model="rate" value="9" id="9"><label for="9">☆</label>
            <input type="radio" name="rating" v-model="rate" value="8" id="8"><label for="8">☆</label>
            <input type="radio" name="rating" v-model="rate" value="7" id="7"><label for="7">☆</label>
            <input type="radio" name="rating" v-model="rate" value="6" id="6"><label for="6">☆</label>
            <input type="radio" name="rating" v-model="rate" value="5" id="5"><label for="5">☆</label>
            <input type="radio" name="rating" v-model="rate" value="4" id="4"><label for="4">☆</label>
            <input type="radio" name="rating" v-model="rate" value="3" id="3"><label for="3">☆</label>
            <input type="radio" name="rating" v-model="rate" value="2" id="2"><label for="2">☆</label>
            <input type="radio" name="rating" v-model="rate" value="1" id="1"><label for="1">☆</label>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-12 filter-rate">
        <div class="header">
          <h3>Liczba ocen</h3>
          <p v-text="(value[0]==0 && value[1] == 1000000) ? 'DOWOLNA' : value[0].toLocaleString()+' - '+value[1].toLocaleString()"></p>
        </div>
        <div class="body">
          <vue-slider  :lazy="true" :interval="10000" :dotSize="dotSize" :min=0 :max=1000000 v-model="value"></vue-slider>
        </div>
      </div>
      <div class="col-12 filter-select">

        <div @click="modal.genres = true" class="col-xl-3 col-12 select">
          <p>Gatunek</p>
          <i class="fas fa-chevron-down"></i>
        </div>
        <div class="col-xl-3 col-12 select">
          <p>Kraj produkcji</p>
          <i class="fas fa-chevron-down"></i>
        </div>
        <div @click="modal.years = true" class="col-xl-3 col-12 select">
          <p>Lat produkcji</p>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </div>

    <Modal :activated.sync="modal.genres">
      <template v-slot:header>
        <h1>Wybierz gatunki</h1>
        <p><div class="modal-close" @click="close"><i class="icon-Close"></i></div></p>
      </template>
      <template v-slot:body>
        <Genres/>
      </template>
    </Modal>
    <Modal :activated.sync="modal.years">
      <template v-slot:header>
        <h1>Wybierz rok produkcji</h1>
      </template>
      <template v-slot:body>
        <Years/>

      </template>
    </Modal>
    <div class="dashboard-container">
      <div v-if="!loading.movies">
        <div id="item-list" v-for="(group, i) in moviesGroups" class="row">
            <poster v-for="movie in test.data.slice(i * moviesPerRow, (i + 1) * moviesPerRow)" :key="movie.id" :data="movie" :active="select" @click.native="selectMovie(movie.id, i)"/>
            <Card :key="i" v-if="i == card && Object.keys(moviet).length" :object="moviet" />
        </div>
      </div>
      <!-- <div v-else>
        <div id="item-list" class="row">
          <div v-for="n in 24" class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
            <div class="skeleton-item skeleton-image"></div>
            <div class="skeleton-item skeleton-copy-full"></div>
            <div class="skeleton-item skeleton-title"></div>
          </div>
        </div>
      </div> -->




      </div>


      <pagination :data="test" :onEachSide="3" @paginateTo="fetchMovies"/>



			</div>
  </div>
</template>

<script>
import Slider from '~/components/default/Slider'
import Filtrs from '~/components/default/Filtrs'
import Card from '~/components/default/Card'
import Genres from '~/components/default/Genres'
import Years from '~/components/default/Years'

import Poster from '~/components/default/Poster'
import Pagination from '~/components/global/Pagination'
import Modal from '~/components/global/Modal'

import axios from 'axios'
export default {
  middleware: ['auth', 'verify'],
  components: {Slider, Filtrs, Poster, Pagination,Card, Genres, Modal, Years},

  head () {
    return { title: 'Filmy' }
  },
  data: () => ({
    loading: {
      sliders: true,
      movies: true
    },
    movies: [
      {title: 'Riverdale',backdrop: 'https://image.tmdb.org/t/p/original/9hvhGtcsGhQY58pukw8w55UEUbL.jpg', poster: 'https://image.tmdb.org/t/p/original/4X7o1ssOEvp4BFLim1AZmPNcYbU.jpg'},
      {title: 'Kronika świąteczna: Część druga',backdrop: 'https://image.tmdb.org/t/p/original/7TC0Me75kIHNhB8O7O6quSI207p.jpg', poster: 'https://image.tmdb.org/t/p/original/6sG0kbEvAi3RRLcGGU5h8l3qAPa.jpg'},
      {title: 'Krudowie',backdrop: 'https://image.tmdb.org/t/p/original/wFN8llYh215M8i2fqWAcPV8CSyL.jpg', poster: 'https://image.tmdb.org/t/p/original/saL1Nj7kx7zrtn85VNQFSRfJkZf.jpg'},
      {title: 'After 2',backdrop: 'https://image.tmdb.org/t/p/original/6hgItrYQEG33y0I7yP2SRl2ei4w.jpg', poster: 'https://image.tmdb.org/t/p/original/qJi9AomfhOkvGy9EoBh3SAfCS3O.jpg'},

    ],
    modal: {
      genres: false,
      years: false,
      country: false
    },
    rate: null,
    card: null,
    select: 0,
    moviet: [],
    test: {},
    sliders: {},
    moviesPerRow: 6,

    dotSize: [30, 30],
    value: [0, 1000000]
  }),
  methods: {
    async fetchMovies(page = 1) {
      this.loading.movies = true
      this.test = {}
      this.card = null
      this.select = 0
      await axios.get('/movies/discover/'+page).then(({data}) => {
        this.test = data
      }).finally(() => {
        this.loading.movies = false
      })
    },
    async fetchSlidersMovies() {
      this.loading.sliders = true
      const {data} = await axios.get('/movies/sliders').finally(() => {
        this.loading.sliders = false
      })
      this.sliders = data.results
    },
    async selectMovie(id, card) {
      const {data} = await axios.get('/movies/detalis/'+id)
      this.moviet = data
      this.select = id
      this.card = card
    }
  },
  computed: {
    moviesGroups () {
      return Array.from(Array(Math.ceil(this.test.data.length / this.moviesPerRow)).keys())
    }
  },
  watch: {
      '$screen.width'() {
        this.card=null
        this.select = 0
        if(this.$screen.breakpoint == "md" || this.$screen.breakpoint == "sm") {
          this.moviesPerRow = 4;
        }
        else if(this.$screen.breakpoint == "xs") {
          this.moviesPerRow = 2;

        }
        else {
          this.moviesPerRow = 6;
        }
      }
  },
  mounted() {
    this.fetchMovies(),
    this.fetchSlidersMovies()



  }

}
</script>
