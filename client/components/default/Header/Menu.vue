<template>
      <div id="header-user-profile" v-click-outside="close" @click="toggle" :class="active ? 'active' : 'hide'">
         <div id="header-user-profile-click" class="noselect">
            <img v-if="user.photo == null" :src="'https://eu.ui-avatars.com/api/?size=512&length=1&name='+`${user.name}`"  :alt="user.name">
            <img v-else :src="`${user.photo}`" :alt="user.name">

            <div id="header-username">{{user.name}}</div>
            <i class="fas fa-angle-down"></i>
         </div>
         <div id="header-user-profile-menu">
            <ul>
               <li><router-link :to="{ name: 'profile' }"><span class="icon-User"></span>Mój profil</router-link></li>
               <li><a href="dashboard-favorites.html"><span class="icon-Favorite-Window"></span>Moje ulubione</a></li>
               <li><router-link :to="{ name: 'settings.profile' }"><span class="icon-Gears"></span>Szczegóły Konta</router-link></li>
               <li><a href="#!"><span class="icon-Life-Safer"></span>Pomoc</a></li>
               <li v-if="user.role == 2"><a href="/dashboard"><span class="icon-Gears"></span>Admin panel</a></li>
               <li><a @click="logout"><span class="icon-Power-3"></span>Wyloguj się</a></li>
            </ul>
         </div>
      </div>
</template>
<script>
import { mapGetters } from 'vuex'
import ClickOutside from 'vue-click-outside'

export default {
  name: 'Menu',
  computed: mapGetters({
    user: 'auth/user',
    check: 'auth/check'
  }),
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
