<template >
  <div class="dashboard-container pt-5">
    <div v-if="searchedLength > 0" id="item-list" v-for="(group, i) in searchedGroups" class="row">
        <poster v-for="movie in searched.results.slice(i * searchPerRow, (i + 1) * searchPerRow)" :key="movie.id"  @click.native="selectData(movie.id, i, movie.media_type)"  :type="movie.media_type" :data="movie" :active="selectedPoster"/>
        <Card :key="i" v-if="i == selectedCard && Object.keys(selectedData).length" :type='selectedType' :object="selectedData" />
    </div>
    <div v-if="searchedLength == 0" class="alert alert-danger">
      <h4>Taki film lub serial nie istnieje...</h4>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import Poster from '~/components/default/Poster'
import Card from '~/components/default/Card'

export default {
  name: 'Search',
  middleware: ['auth', 'verify'],
  components: {
    Poster,
    Card
  },
  head () {
    return { title: 'Filmy' }
  },
  computed: {
    query() {
      return this.$route.query.query
    }
  },
  data: () => ({
    searched: [],
    searchedGroups: [],
    searchedLength: null,
    searchPerRow: 6,
    selectedPoster: null,
    selectedCard: null,
    selectedData: {},
    selectedType: null,

    searchedLocationBack: null

  }),
  async mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start()
    })
    this.fetchSearch()
    this.$nextTick(() => {
      this.$nuxt.$loading.finish()
    })
  },
  methods: {
    async fetchSearch() {
      await this.resetData()
      await axios.get('/search/'+this.query).then(({data}) => {
        this.searched = data
      })
      this.searchedGroups = Array.from(Array(Math.ceil(this.searched.results.length / this.searchPerRow)).keys())
      this.searchedLength = this.searched.results.length

    },
    async selectData(id, card,type) {
      await this.resetData()
      let data = null;
      if(type=='movie') {
         data = await axios.get('/movies/detalis/'+id)
      }
      else {
        data = await axios.get('/tvshows/detalis/'+id)
      }
      this.selectedData = data.data
      this.selectedPoster = id
      this.selectedCard = card
      this.selectedType = type
    },
    async resetData() {
      this.selectedData = {}
      this.selectedPoster = null
      this.selectedCard = null
    }
  },
  beforeRouteEnter(to, from, next) {
        next((vm) => {
            vm.searchedLocationBack = from;
        });
    },
  watch: {
    query: function() {
      if(this.query == "") {
        return this.$router.push({path: this.searchedLocationBack.path})
      }
      return this.fetchSearch()
    },
  }
}
</script>
