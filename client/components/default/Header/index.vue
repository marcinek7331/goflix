<template>
   <header v-click-outside="close" id="videohead-pro" :class="active ? 'sticky-header active-mobile-icon-pro' : 'sticky-header'">
      <div id="video-logo-background"><router-link :to="{ name: 'home'}"><img src="~assets/images/logo.png" alt="Logo"></router-link></div>
      <div id="video-search-header">
         <input v-model="query" type="text" placeholder="Wyszukaj film lub serial" aria-label="Search">
      </div>
      <div id="mobile-bars-icon-pro" @click="toggle" class="noselect"><i class="fas fa-bars"></i></div>
      <Menu/>
      <Notification/>
      <div class="clearfix"></div>
      <nav   id="mobile-navigation-pro" :class="active ? 'active ': ''">
         <ul id="mobile-menu-pro">
           <li>
             <router-link :to="{ name: 'home'}">
              <span class="icon-Reel"></span>
              Filmy
            </router-link>
           </li>
            <li>
              <router-link :to="{ name: 'tvshows'}">
               <span class="icon-Old-TV"></span>
               Seriale
             </router-link>
            <li>
            <li>
               <a href="dashboard-new-arrivals.html">
               <span class="icon-Movie-Ticket"></span>
               Nowości
               </a>
            </li>
            <li>
               <a href="dashboard-coming-soon.html">
               <span class="icon-Clock"></span>
               Moja lista
               </a>
            </li>
            <li>
               <a href="#!">
               <i class="far fa-bell"></i>
               <span class="user-notification-count">3</span>
               Powiadomienia
               </a>
            </li>
         </ul>
         <div class="clearfix"></div>
         <div id="search-mobile-nav-pro">
            <input type="text" placeholder="Wyszukaj film lub serial" aria-label="Search">
         </div>
      </nav>
   </header>
</template>
<script>
import { mapGetters } from 'vuex'
import ClickOutside from 'vue-click-outside'
import Menu from '~/components/default/Header/Menu'
import Notification from '~/components/default/Header/Notification'

export default {
  name: 'Header',
  components: {
    Menu, Notification
  },
  computed: {
    query:{
        get: function(){
          return this.$route.query.query
        },
        set: function(newQuery){
          if(this.$route.name != 'search') {
            if(newQuery.length >=3) {
              this.$router.push({ name: 'search', query: { query: newQuery } })
            }
          }
          else {
            const query = { ...this.$route.params, query: newQuery }
            this.$router.replace({ query })
          }
        }
    }
  },

  data() {
    return {
      active: false,
    };
  },
  methods: {
    toggle() {
      this.active = !this.active
    },
    close() {
      this.active = false
    },
  },
  mounted() {

    this.popupItem = this.$el.querySelector('#mobile-navigation-pro')
  },
  directives: {
    ClickOutside
  },
}

</script>
