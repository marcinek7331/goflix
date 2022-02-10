<template>
  <nav id="sidebar-nav"><!-- Add class="sticky-sidebar-js" for auto-height sidebar -->
          <ul id="vertical-sidebar-nav" class="sf-menu">
            <li class="normal-item-pro">
              <a href="dashboard-movies.html">
          <span class="icon-Reel"></span>
                Filmy
              </a>
            </li>
            <li class="normal-item-pro current-menu-item">
              <a href="dashboard-home.html">
          <span class="icon-Old-TV"></span>
                Seriale
              </a>
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

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
