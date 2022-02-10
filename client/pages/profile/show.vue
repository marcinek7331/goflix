<template>
   <div>
      <div id="content-sidebar-pro">
         <div id="content-sidebar-info">
            <img v-if="Object.keys(user).length" src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-9/122358604_1739196446254680_8252637286782976101_o.jpg?_nc_cat=108&ccb=2&_nc_sid=09cbfe&_nc_ohc=FGKqmYZfsaQAX-ARcs8&_nc_ht=scontent-waw1-1.xx&oh=0f89df203a0e131f1a9ce4f222c8963f&oe=60303CBE" :alt="user.name">
            <div v-else class="skeleton-item skeleton-image"></div>
            <div v-if="Object.keys(user).length" id="profile-sidebar-name">
               <h5>{{user.name}}</h5>
               <h6>{{user.email}}</h6>
            </div>
            <div id="profile-sidebar-gradient"></div>
            <router-link v-if="user.id === currentUser.id":to="{ name: 'settings.profile'}" class="edit-profile-sidebar"><i class="fas fa-pencil-alt"></i> </router-link>
         </div>
         <div class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Oglądniete</h3>
            <ul id="profile-watched-stats">
               <li><span>0</span> Filmów</li>
               <li><span>0</span> Seriali</li>
            </ul>
         </div>
         <div v-if="Object.keys(user).length" class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Ulubione gatunki</h3>
            <ul  id="profile-favorite-genres">
               <li v-if="genre.active" v-for="genre in genres" :key="genre.id">
                  <img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.name">
                  <h6>{{genre.name}}</h6>
               </li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div v-else class="content-sidebar-section">
           <h3 class="content-sidebar-sub-header">Ulubione gatunki</h3>
           <ul id="profile-favorite-genres">
             <li style="margin: 2px" v-for="i in 6" class="skeleton-item skeleton-squre"></li>
           </ul>
         </div>
         <div v-if="Object.keys(user).length" class="content-sidebar-section">
            <h3 class="content-sidebar-sub-header">Przyjaciół: 10</h3>
            <ul  id="friends-activity-profiles">
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/p200x200/133909720_2820236131636228_2109936314757960370_o.jpg?_nc_cat=108&ccb=2&_nc_sid=7206a8&_nc_ohc=4aX2w97rtaMAX_rpx7e&_nc_ht=scontent-waw1-1.xx&tp=6&oh=82ff39c0acd99bd52d1f61853bfb987a&oe=6030B7E9" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/s200x200/116599139_1368730513335952_4834820575293943800_o.jpg?_nc_cat=106&ccb=2&_nc_sid=7206a8&_nc_ohc=EYUAtGi_GaUAX9Z0mOY&_nc_ht=scontent-waw1-1.xx&tp=7&oh=cdd451d7c96002e7b4b382129d2121e7&oe=602E3EDB" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.0-1/p200x200/1689032_1465741370305223_383044318_n.jpg?_nc_cat=108&ccb=2&_nc_sid=7206a8&_nc_ohc=PSe-JieXBysAX-goyhz&_nc_ht=scontent-waw1-1.xx&tp=6&oh=48531855784172387649896752ca9dd8&oe=602FE42D" alt="Friend"></a></li>
               <li><a href="#!"><img src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.30497-1/c59.0.200.200a/p200x200/84241059_189132118950875_4138507100605120512_n.jpg?_nc_cat=1&ccb=2&_nc_sid=7206a8&_nc_ohc=0ryQAcHuGUEAX-xU-jv&_nc_ht=scontent-waw1-1.xx&tp=27&oh=98b44f2699a354900f6c9ce35967230f&oe=602DEF84" alt="Friend"></a></li>
               <li class="friends-activity-profiles-more"><a href="#!">+83</a></li>
            </ul>
            <div class="clearfix"></div>
         </div>
         <div v-else class="content-sidebar-section">
           <h3 class="content-sidebar-sub-header">Przyjaciół: 10</h3>
           <ul  id="friends-activity-profiles">
             <li style="margin: 2px" v-for="i in 5" class="skeleton-item skeleton-circle"></li>
           </ul>
           <div class="clearfix"></div>
         </div>
      </div>
      <main id="col-main-with-sidebar">
         <div class="dashboard-container">
            <ul class="dashboard-sub-menu">
               <li class="current"><a href="dashboard-profile.html">Ulubione</a></li>
               <li ><a href="dashboard-favorites.html">Do obejrzenia</a></li>
            </ul>
         </div>
      </main>
   </div>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  name: 'Profile',
  middleware: ['auth', 'verify'],

  data: () => ({
    user: {},
  }),

  computed: mapGetters({
    currentUser: 'auth/user',
    genres: 'genres/genres'
  }),
  methods: {
    fetchUser() {
      axios
      .get('/user/'+this.$route.params.id+'/profile')
      .then(response => {
        if(response.status === 200) {
          this.user = response.data
          this.fetchGenres()
        }
      })
    },
    fetchGenres() {
      this.genres.forEach((genre, index) => {
        if(this.user.genres!=null&&this.user.genres.includes(genre.id)) {
          this.genres[index].active = true
        }
      })
    }
  },
  mounted () {
    this.fetchUser()

  },
}

</script>
