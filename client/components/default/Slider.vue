<template>
   <div v-if="object.length" class="progression-studios-dashboard-slider">
      <ul class="slides">
         <transition name="fade">
            <li @mouseover="pauseSlide" @mouseleave="startSlide" v-for="i in [currentIndex]" :key="i" class="progression_studios_animate_left flex-active-slide">
               <div class="progression-studios-slider-dashboard-image-background" :style="{ backgroundImage: 'url(' + currentBackdrop + ')' }">
                  <div class="progression-studios-slider-display-table">
                     <div class="progression-studios-slider-vertical-align">
                        <div class="container">
                           <div class="progression-studios-slider-dashboard-caption-width">
                              <div class="progression-studios-slider-caption-align">
                                 <h6>FILM</h6>
                                 <ul class="progression-studios-slider-rating">
                                   <li><i class="far fa-star"></i> {{currentVoteAvg}}</li>
                                   <li>{{currentOriginalLanguage.toUpperCase()}}</li>
                                   <li>{{currentYear.substr(0, 4)}}</li>

                                 </ul>
                                 <h2><a href="dashboard-movie-profile.html">{{currentTitle}}</a></h2>
                                 <ul class="progression-studios-slider-meta">

                                   <li v-for="genre in currentGenres" ><img :src="require(`~/assets/images/genres/${genre}.png`)" :alt="genre.id"><span>{{genre}}</span></li>

                                 </ul>
                                 <p class="progression-studios-slider-description">{{currentDescription}}</p>
                                 <a class="btn btn-green-pro btn-slider-pro btn-shadow-pro afterglow" href="#VideoLightbox-1"><i class="fas fa-play"></i> Oglądaj teraz</a>
                                 <div class="progression-studios-slider-more-options hide">
                                    <i class="fas fa-ellipsis-h"></i>
                                    <ul>
                                       <li><a href="#!">Add to Favorites</a></li>
                                       <li><a href="#!">Add to Watchlist</a></li>
                                       <li><a href="#!">Add to Playlist</a></li>
                                       <li><a href="#!">Share...</a></li>
                                       <li><a href="#!">Write A Review</a></li>
                                    </ul>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="progression-studios-slider-mobile-background-cover"></div>
               </div>
            </li>
         </transition>
      </ul>
      <ol class="flex-control-nav flex-control-paging">
         <li v-for="(i, index) in this.object.length">
            <a href="#" @click="select(index)" :class="index==currentPaging ? 'flex-active' : ''">{{index}}</a>
         </li>
      </ol>
      <ul class="flex-direction-nav">
         <li class="flex-nav-prev" @click="prev">
            <a class="flex-prev" href="#"></a>
         </li>
         <li class="flex-nav-next">
            <a class="flex-next" @click="next" href="#"></a>
         </li>
      </ul>
      <div class="gallery">
         <div class="gallery-container" @mouseover="pauseSlide" @mouseleave="startSlide">
            <div class="gallery-item gallery-item-selected"  :style="{ backgroundImage: 'url(' + currentPoster + ')' }">
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                  <path d="M32 0C14.3 0 0 14.3 0 32s14.3 32 32 32s32-14.3 32-32S49.7 0 32 0z M24.2 44.7V19.3L43 32L24.2 44.7z" style="fill: #fff"></path>
               </svg>
            </div>
            <img class="gallery-item gallery-item-next" v-lazy="nextPoster">
            <img class="gallery-item gallery-item-previous" v-lazy="prevPoster">
         </div>
      </div>
   </div>
</template>
<script>
export default {
  name: "Slider",
  props: {
    object: {
      type: Array,
      default: []
    }
  },
  data() {
    return {
      timer: null,
      currentIndex: 0
    };
  },

  mounted: function() {
    this.startSlide();
  },

  methods: {

    startSlide: function() {
      this.timer = setInterval(this.next,13000);
    },
    pauseSlide() {
      clearInterval(this.timer)
    },
    select(i) {


      this.currentIndex = i,
      clearInterval(this.timer)
      this.startSlide()
      console.log(this.currentIndex)
      console.log(this.nextPoster)
      console.log(this.prevPoster)
    },
    next: function() {
      if(this.currentIndex == this.object.length-1) {
        this.currentIndex = 0;
      }
      else {
        this.currentIndex += 1;

      }
      clearInterval(this.timer)
      this.startSlide()
    },
    prev: function() {
      if(this.currentIndex == 0) {
        this.currentIndex = this.object.length-1;
      }
      else {
        this.currentIndex -=1;
      }
      clearInterval(this.timer)
      this.startSlide()
    }
  },
  beforeDestroy () {
    clearInterval(this.timer)
  },
  computed: {
    currentGenres() {
      return this.object[this.currentPaging].genre_ids;
    },
    currentVoteAvg() {
      return this.object[this.currentPaging].vote_average;
    },
    currentOriginalLanguage() {
      return this.object[this.currentPaging].original_language;
    },
    currentPaging() {
      return Math.abs(this.currentIndex) % this.object.length;
    },
    currentBackdrop: function() {
      return "https://image.tmdb.org/t/p/w1280"+this.object[this.currentPaging].backdrop_path;
    },
    currentYear() {
      return this.object[this.currentPaging].release_date;
    },
    currentTitle() {
      return this.object[this.currentPaging].title;
    },
    currentDescription() {
      return this.object[this.currentPaging].overview;
    },
    currentPoster: function() {
      return "https://image.tmdb.org/t/p/w342/"+this.object[this.currentPaging].poster_path;
    },
    nextPoster: function() {
      return  this.currentIndex == this.object.length-1 ? "https://image.tmdb.org/t/p/w342/"+this.object[0].poster_path : "https://image.tmdb.org/t/p/w342/"+this.object[this.currentPaging+1].poster_path;
    },
    prevPoster: function() {
      return this.currentIndex == 0 ? "https://image.tmdb.org/t/p/w342"+this.object[this.object.length-1].poster_path : "https://image.tmdb.org/t/p/w342/"+this.object[this.currentPaging-1].poster_path;
    }
  }
};
</script>
