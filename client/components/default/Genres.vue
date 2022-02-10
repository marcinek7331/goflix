<template>
    <ul class="registration-genres-choice">
      <li @click="selectGenre(index)" v-for="(genre,index) in genres" :class="genre.active ? 'active':''">
        <i class="fas fa-check-circle"></i>

        <img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.name">
        <h6>{{genre.name}}</h6>
      </li>
    </ul>
</template>
<script>
export default {
  name: "Genres",
  data: () => ({
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
  }),
  methods: {
    selectGenre(id) {
      this.genres[id].active = !this.genres[id].active
    }
  }
};
</script>
