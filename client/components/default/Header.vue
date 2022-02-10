<template>
   <header v-if="user" id="videohead-pro" class="sticky-header">
      <div id="video-logo-background"><router-link :to="{ name: 'home'}"><img src="~assets/images/logo.png" alt="Logo"></router-link></div>
      <div id="video-search-header">
         <div id="search-icon-more"></div>
         <input type="text" placeholder="Wyszukaj film lub serial" aria-label="Search">
      </div>
      <!-- close .video-search-header -->
      <div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
      <div id="header-user-profile" v-click-outside="closeMenu" @click="toggleMenu" :class="menu ? 'active' : 'hide'">
         <div id="header-user-profile-click" class="noselect">
            <img :src="user.photo_url" :alt="user.name">
            <div id="header-username">{{user.name}}</div>
            <i class="fas fa-angle-down"></i>
         </div>
         <div id="header-user-profile-menu">
            <ul>
               <li><a href="dashboard-profile.html"><span class="icon-User"></span>Mój profil</a></li>
               <li><a href="dashboard-favorites.html"><span class="icon-Favorite-Window"></span>Moje ulubione</a></li>
               <li><router-link :to="{ name: 'settings.profile' }"><span class="icon-Gears"></span>Szczegóły Konta</router-link></li>
               <li><a href="#!"><span class="icon-Life-Safer"></span>Pomoc</a></li>

               <li v-if="user.role == 2"><router-link :to="{ name: 'admin-verify' }"><span class="icon-Gears"></span>Weryfikacja</router-link></li>
               <li><a @click="logout"><span class="icon-Power-3"></span>Wyloguj się</a></li>
            </ul>
         </div>
      </div>
      <div id="header-user-notification" v-click-outside="closeNotification" @click="toggleNotification" :class="notification ? 'active' : 'hide'" >
         <div id="header-user-notification-click" class="noselect">
            <i class="far fa-bell"></i>
            <span class="user-notification-count">3</span>
         </div>
         <div id="header-user-notification-menu">
            <h3>Notifications</h3>
            <div id="header-notification-menu-padding">
              <ul id="header-user-notification-list">
              								<li><a href="#!"><img src="images/demo/user-profile-2.jpg" alt="Profile">Lorem ipsum dolor sit amet, consec tetur adipiscing elit. <div class="header-user-notify-time">21 hours ago</div></a></li>
              								<li><a href="#!"><img src="images/demo/user-profile-3.jpg" alt="Profile">Donec vitae lacus id arcu molestie mollis. <div class="header-user-notify-time">3 days ago</div></a></li>
              								<li><a href="#!"><img src="images/demo/user-profile-4.jpg" alt="Profile">Aenean vitae lectus non purus facilisis imperdiet. <div class="header-user-notify-time">5 days ago</div></a></li>
              							</ul>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <nav id="mobile-navigation-pro">
         <ul id="mobile-menu-pro">
            <li class="current-menu-item">
               <a href="dashboard-home.html">
               <span class="icon-Old-TV"></span>
               TV Series
               </a>
            <li>
            <li>
               <a href="dashboard-movies.html">
               <span class="icon-Reel"></span>
               Movies
               </a>
            </li>
            <li>
               <a href="dashboard-playlists.html">
               <span class="icon-Movie"></span>
               Playlists
               </a>
            </li>
            <li>
               <a href="dashboard-new-arrivals.html">
               <span class="icon-Movie-Ticket"></span>
               New Arrivals
               </a>
            </li>
            <li>
               <a href="dashboard-coming-soon.html">
               <span class="icon-Clock"></span>
               Coming Soon
               </a>
            </li>
            <li>
               <a href="#!">
               <i class="far fa-bell"></i>
               <span class="user-notification-count">3</span>
               Notifications
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

export default {
  name: 'Header',
  computed: mapGetters({
    user: 'auth/user',
    check: 'auth/check'
  }),
  data() {
    return {
      menu: false,
      notification: false
    };
  },
  methods: {
    toggleMenu() {
      this.menu = !this.menu
    },
    toggleNotification() {
      this.notification = !this.notification
    },
    closeMenu() {
      this.menu = false
    },
    closeNotification() {
      this.menu = false
    },
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/logowanie')
    }
  },
  mounted() {
    this.popupItem = this.$el.querySelector('#header-user-profile')

  },
  directives: {
    ClickOutside
  }
}

</script>
