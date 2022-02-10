<template>
   <div>
      <div id="content-sidebar-pro">
         <div id="content-sidebar-info">
           <img v-lazy="avatar" :alt="user.name">
            <div id="profile-sidebar-name">
               <h5>{{user.name}}</h5>
               <h6>{{user.email}}</h6>
            </div>
            <div id="profile-sidebar-gradient"></div>
            <router-link :to="{ name: 'settings.profile'}" class="edit-profile-sidebar"><i class="fas fa-pencil-alt"></i> </router-link>
         </div>
         <div class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Oglądniete</h3>
            <ul id="profile-watched-stats">
               <li><span>44</span> Filmów</li>
               <li><span>28</span> Seriali</li>
            </ul>
         </div>
         <div class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Ulubione gatunki</h3>
            <ul id="profile-favorite-genres">
               <li v-if="genre.active" v-for="genre in genres" :key="genre.id">
                  <img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.name">
                  <h6>{{genre.name}}</h6>
               </li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Przyjaciół: 10</h3>
            <ul id="friends-activity-profiles">
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/p200x200/133909720_2820236131636228_2109936314757960370_o.jpg?_nc_cat=108&ccb=2&_nc_sid=7206a8&_nc_ohc=4aX2w97rtaMAX_rpx7e&_nc_ht=scontent-waw1-1.xx&tp=6&oh=82ff39c0acd99bd52d1f61853bfb987a&oe=6030B7E9" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/s200x200/116599139_1368730513335952_4834820575293943800_o.jpg?_nc_cat=106&ccb=2&_nc_sid=7206a8&_nc_ohc=EYUAtGi_GaUAX9Z0mOY&_nc_ht=scontent-waw1-1.xx&tp=7&oh=cdd451d7c96002e7b4b382129d2121e7&oe=602E3EDB" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/p200x200/1689032_1465741370305223_383044318_n.jpg?_nc_cat=108&ccb=2&_nc_sid=7206a8&_nc_ohc=PSe-JieXBysAX-goyhz&_nc_ht=scontent-waw1-1.xx&tp=6&oh=48531855784172387649896752ca9dd8&oe=602FE42D" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.30497-1/c59.0.200.200a/p200x200/84241059_189132118950875_4138507100605120512_n.jpg?_nc_cat=1&ccb=2&_nc_sid=7206a8&_nc_ohc=0ryQAcHuGUEAX-xU-jv&_nc_ht=scontent-waw1-1.xx&tp=27&oh=98b44f2699a354900f6c9ce35967230f&oe=602DEF84" alt="Friend"></a></li>
               <li class="friends-activity-profiles-more"><a href="#!">+83</a></li>
            </ul>
            <div class="clearfix"></div>
         </div>
      </div>
      <main id="col-main-with-sidebar">
         <div class="dashboard-container">
            <ul class="dashboard-sub-menu">
               <li class="current" ><a href="dashboard-profile.html">Ulubione</a></li>
               <li ><a href="dashboard-favorites.html">Do obejrzenia</a></li>
            </ul>
            <div id="item-list" class="row">
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Niebo o północy / The Midnight Sky"><img src="https://image.tmdb.org/t/p/original/3R2MqjJB48k5bdqLrwsypaRj8M6.jpg" alt="Niebo o północy/The Midnight Sky" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Niebo o północy / The Midnight Sky</h1>
                     <div class="film_year">2020</div>
                     <!---->
                  </div>
               </div>
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Tenet / Tenet"><img src="https://image.tmdb.org/t/p/original/IveefzhRc6Zdd5gzQw3VFjitZP.jpg" alt="Tenet/Tenet" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Tenet / Tenet</h1>
                     <div class="film_year">2020</div>
                     <!---->
                  </div>
               </div>
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Jumanji: Następny poziom / Jumanji: The Next Level"><img src="https://image.tmdb.org/t/p/original/nyj0Y3IgpwBARdwfQrOh5X0ogws.jpg" alt="Jumanji: Następny poziom/Jumanji: The Next Level" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Jumanji: Następny poziom / Jumanji: The Next Level</h1>
                     <div class="film_year">2019</div>
                     <!---->
                  </div>
               </div>
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Battleship: Bitwa o Ziemię / Battleship"><img src="https://image.tmdb.org/t/p/original/mXb3hot6ZW4hMfpZSK7UtD70WgM.jpg" alt="Battleship: Bitwa o Ziemię/Battleship" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Battleship: Bitwa o Ziemię / Battleship</h1>
                     <div class="film_year">2012</div>
                     <!---->
                  </div>
               </div>
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Protektor / Safe"><img src="https://image.tmdb.org/t/p/original/1hM8cRM4dgFiskgSxVXvhykKkvw.jpg" alt="Protektor/Safe" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Protektor / Safe</h1>
                     <div class="film_year">2012</div>
                     <!---->
                  </div>
               </div>
               <div class="col-6 col-xs-4 col-md-3 col-sm-3 col-lg-2">
                  <div class="poster animation">
                     <div class="inner">
                        <a title="Nowi mutanci / The New Mutants"><img src="https://image.tmdb.org/t/p/original/cUPeAzQmmg91mecJgYAhYFBiZw8.jpg" alt="Nowi mutanci/The New Mutants" class="img-responsive"></a>
                        <div class="glimmer"></div>
                        <p class="play"></p>
                     </div>
                     <h1 class="film_title">Nowi mutanci / The New Mutants</h1>
                     <div class="film_year">2020</div>
                     <!---->
                  </div>
               </div>
               <!---->
            </div>
            <ul class="page-numbers">
               <li><a class="previous page-numbers" href="#!"><i class="fas fa-chevron-left"></i></a></li>
               <li><span class="page-numbers current">1</span></li>
               <li><a class="page-numbers" href="#!">2</a></li>
               <li><a class="page-numbers" href="#!">3</a></li>
               <li><a class="page-numbers" href="#!">4</a></li>
               <li><a class="next page-numbers" href="#!"><i class="fas fa-chevron-right"></i></a></li>
            </ul>
         </div>
         <!-- close .dashboard-container -->
      </main>
   </div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Profile',
  middleware: ['auth', 'verify'],
  computed: {
    ...mapGetters({
      user: 'auth/user',
      genres: 'genres/genres'
    }),
    avatar() {
      return this.user.photo == null ? 'https://eu.ui-avatars.com/api/?format=svg&size=512&length=1&name='+this.user.name : this.user.photo
    }
  },
  created () {
    this.genres.forEach((genre, index) => {
      if(this.user.genres!=null&&this.user.genres.includes(genre.id)) {
        this.genres[index].active = true
      }
    })
  },
}

</script>
