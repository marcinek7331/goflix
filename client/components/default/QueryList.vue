<template>
  <div class="dashboard-container pt-5">
    <div id="item-list" v-for="(group, i) in searchedGroups" class="row">
        <poster v-for="movie in searched.results.slice(i * searchPerRow, (i + 1) * searchPerRow)" :key="movie.id"  @click.native="selectData(movie.id, i, movie.media_type)"  :type="movie.media_type" :data="movie" :active="selectedPoster"/>
        <Card :key="i" v-if="i == selectedCard && Object.keys(selectedData).length" :type='selectedType' :object="selectedData" />
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'

import axios from 'axios'
import Poster from '~/components/default/Poster'
import Card from '~/components/default/Card'

export default {
  name: 'QueryList',
  components: {
    Poster,
    Card
  },
  data: () => ({
    searched: [],
    searchPerRow: 6,
    selectedPoster: null,
    selectedCard: null,
    selectedData: {},
    selectedType: null,
    searchedGroups: [],
  }),
  computed: {
    query() {
      return this.$route.params.query
    }
  },
  methods: {
    async fetchSearch() {
      await axios.get('/search/'+this.$route.params.query).then(({data}) => {
        this.searched = data
      })
      this.searchedGroups = Array.from(Array(Math.ceil(this.searched.results.length / this.searchPerRow)).keys())
    },
    async selectData(id, card,type) {
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
    }
  },
  watch: {
    query: function(oldValue, newValue) {
      
      this.fetchSearch()
      this.selectedData = {}
      this.selectedPoster = null
      this.selectedCard = null
    },
  }
}

</script>
