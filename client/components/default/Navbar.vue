<template>
  <nav id="sidebar-nav">
          <ul id="vertical-sidebar-nav" class="sf-menu">
            <li class="normal-item-pro">
              <router-link :to="{ name: 'home'}">
                <span class="icon-Reel"></span>
                      Filmy
              </router-link>
            </li>
            <li class="normal-item-pro">
              <router-link :to="{ name: 'tvshows'}">
          <span class="icon-Old-TV"></span>
                Seriale
              </router-link>
            </li>
            <li class="normal-item-pro">
              <router-link :to="{ name: 'friends'}">
          <span class="icon-Business-ManWoman"></span>
                Znajomi
              </router-link>
            </li>
            <li class="normal-item-pro">
              <a href="dashboard-new-arrivals.html">
          <span class="icon-Movie-Ticket"></span>
                Nowości
              </a>
            </li>
            <li class="normal-item-pro">
              <a href="dashboard-coming-soon.html">
          <span class="icon-Clock"></span>
                Moja lista
              </a>
            </li>

          </ul>
      <div class="clearfix"></div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    appName: process.env.appName
  }),
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
