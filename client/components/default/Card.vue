<template>
   <div v-if="type=='movie'" class="movie_card" @mouseover="playVideo" @mouseleave="pauseVideo">
      <div class="info_section">
         <div class="movie_header">
            <div class="locandina">
               <img  :src="'https://image.tmdb.org/t/p/w185'+object.poster_path" />
            </div>
            <h1>{{object.title}}</h1>
            <h4>{{object.release_date.substr(0, 4)}}</h4>
            <div class="d-flex align-items-center">
               <span class="minutes">{{object.runtime}} min</span>
               <ul class="progression-studios-slider-meta">
                  <li v-for="genre in object.genres" ><img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.id"><span>{{genre.name}}</span></li>
               </ul>
            </div>
         </div>
         <div class="movie_desc">
            <p class="text">
               {{object.overview.substr(0, 280)+'...'}}
            </p>
            <ul class="progression-studios-staring-slider profile-favorite-genres pb-3">
               <li v-for="n in 5">
                  <a href="#!"><img :src="'https://image.tmdb.org/t/p/w45_and_h45_face/'+object.casts.cast[n].profile_path" :alt="object.casts.cast[n].name" draggable="false" /></a>
               </li>
            </ul>
            <button class="btn btn-green-pro btn-slider-pro btn-shadow-pro mr-2">
            <i class="fas fa-play"></i> Oglądaj
            </button>
            <button class="btn btn-slider-pro">
            <i class="fas fa-plus"></i> Dodaj do listy
            </button>
         </div>
      </div>
      <div class="blur_back" :style="{ backgroundImage: 'url(https://image.tmdb.org/t/p/original' + object.backdrop_path + ')' }">
         <youtube :video-id="object.video" height="100%" width="70%" :player-vars="playerVars" ref="youtube" @playing="playing"></youtube>
      </div>
   </div>
   <div v-else class="movie_card" @mouseover="playVideo" @mouseleave="pauseVideo">
      <div class="info_section">
         <div class="movie_header">
            <div class="locandina">
               <img  :src="'https://image.tmdb.org/t/p/w185'+object.poster_path" />
            </div>
            <h1>{{object.name}}</h1>
            <h4>{{object.first_air_date.substr(0, 4)}}</h4>
            <div class="d-flex align-items-center">
               <ul class="progression-studios-slider-meta">
                  <li v-for="genre in object.genres" ><img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.id"><span>{{genre.name}}</span></li>
               </ul>
            </div>
         </div>
         <div class="movie_desc">
            <p class="text">
               {{object.overview.substr(0, 280)+'...'}}
            </p>
            <ul class="progression-studios-staring-slider profile-favorite-genres pb-3">
               <li v-for="n in object.credits.cast.lenght > 5 ? 5: object.credits.cast.lenght">
                  <a href="#!"><img :src="'https://image.tmdb.org/t/p/w45_and_h45_face/'+object.credits.cast[n].profile_path" :alt="object.credits.cast[n].name" draggable="false" /></a>
               </li>
            </ul>
            <button class="btn btn-green-pro btn-slider-pro btn-shadow-pro mr-2">
            <i class="fas fa-play"></i> Oglądaj
            </button>
            <button class="btn btn-slider-pro">
            <i class="fas fa-plus"></i> Dodaj do listy
            </button>
         </div>
      </div>
      <div class="blur_back" :style="{ backgroundImage: 'url(https://image.tmdb.org/t/p/original' + object.backdrop_path + ')' }">
         <youtube :video-id="object.video" height="100%" width="70%" :player-vars="playerVars" ref="youtube" @playing="playing"></youtube>
      </div>
   </div>
</template>
<script>
export default {
  name: 'Card',
  props: {
    object: {
      type: Object,
      default: {}
    },
    type: {
      type: String
    }
  },
  mounted() {
    this.player.addEventListener('onStateChange', this.youtubStateChange)
  },
  methods: {
    playVideo() {
      this.player.playVideo();
    },
    pauseVideo() {
      this.player.pauseVideo()
    },
    playing() {
      //
    },
    playMovie() {
    //this.$router.push({name: 'player', params:{id: this.movie}})
    },
  },
  computed: {
    player() {
        return this.$refs.youtube.player
    }
  },
  data: () => ({
    playerVars: {
      rel: 0,
      showinfo: 0,
      showsearch: 0,
      controls: 0,
      loop: 1,
      enablejsapi: 1,
      cc_load_policy: 1,
      cc_lang_pref: 'pl',
      iv_load_policy: 3
    },
  }),

}
</script>
