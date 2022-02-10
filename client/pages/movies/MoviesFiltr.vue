<template>
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
      <div @click="openGenresModal()" class="col-xl-3 col-12 select">
        <p>Gatunek</p>
        <i class="fas fa-chevron-down"></i>
      </div>
      <div class="col-xl-3 col-12 select">
        <p>Kraj produkcji</p>
        <i class="fas fa-chevron-down"></i>
      </div>
      <div class="col-xl-3 col-12 select">
        <p>Lat produkcji</p>
        <i class="fas fa-chevron-down"></i>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'MoviesFiltr',
  data: () => ({
    rate: null,
    dotSize: [30, 30],
    value: [0, 1000000]
  }),
  methods: {
    openGenresModal() {
      this.$emit('genres')
    }
  }
}
</script>
