<template>
  <div class="dashboard-container">
    <div id="item-list" v-for="(group, i) in moviesGroups" class="row">
        <poster v-for="movie in object.data.slice(i * moviesPerRow, (i + 1) * moviesPerRow)" :key="movie.id"  :type="'movie'" :data="movie" :active="selectPoster" @click.native="selectMovie(movie.id, i)"/>
        <Card :key="i" v-if="i == selectCard && Object.keys(movie).length" :type="'movie'" :object="movie" />
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import Poster from '~/components/default/Poster'
import Card from '~/components/default/Card'

export default {
  name: 'MoviesList',
  props: {
    object: {
      type: Object,
      default: []
    }
  },
  components: {
    Poster,
    Card
  },
  data: () => ({
    moviesPerRow: 6,
    selectPoster: null,
    selectCard: null,
    movie: {}
  }),
  methods: {
    async selectMovie(id, card) {
      const {data} = await axios.get('/movies/detalis/'+id)
      this.movie = data
      this.selectPoster = id
      this.selectCard = card
    }
  },
  computed: {
    moviesGroups () {
      return Array.from(Array(Math.ceil(this.object.data.length / this.moviesPerRow)).keys())
    }
  },
  watch: {
      object: function() {
          this.selectPoster = null
          this.selectCard = null
      },
      '$screen.width' () {
        this.selectPoster=null
        this.selectCard=null
        if(this.$screen.breakpoint == "md" || this.$screen.breakpoint == "sm") {
          this.moviesPerRow = 4
        }
        else if(this.$screen.breakpoint == "xs") {
          this.moviesPerRow = 2
        }
        else {
          this.moviesPerRow = 6
        }
      }
  },
}

</script>
