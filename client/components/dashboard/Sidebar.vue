<template>
  <div class="sidebar">
		<a href="index.html" class="sidebar__logo">
			<img src="~assets/images/logo.png" alt="Logo">
		</a>
		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img :src="avatar" :alt="user.photos">
			</div>
			<div class="sidebar__user-title">
				<span>Admin</span>
				<p>{{user.name}}</p>
			</div>
			<button @click="logout" class="sidebar__user-btn" type="button">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z"></path></svg>
			</button>
		</div>
		<ul class="sidebar__nav" data-scrollbar="true" tabindex="-1" style="overflow: hidden; outline: none;"><div class="scroll-content">
			<li class="sidebar__nav-item">
        <router-link class="sidebar__nav-link" :to="{ name: 'dashboard' }">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z"></path></svg> <span>Dashboard</span>
    </router-link>
			</li>
			<li class="sidebar__nav-item">
        <router-link class="sidebar__nav-link" :to="{ name: 'dashboard.users' }">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"></path></svg> <span>Użytkownicy</span>
        </router-link>
			</li>
      <li class="sidebar__nav-item">
        <router-link class="sidebar__nav-link" :to="{ name: 'dashboard.movies' }">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M 12.757812 3 L 2.242188 3 C 1.003906 3 0 4.003906 0 5.242188 L 0 18.757812 C 0 19.996094 1.003906 21 2.242188 21 L 15.757812 21 C 16.996094 21 18 19.996094 18 18.757812 L 18 5.242188 C 18 4.003906 16.996094 3 15.757812 3 Z M 24.636719 4.765625 L 19.5 8.3125 L 19.5 15.6875 L 24.636719 19.226562 C 25.632812 19.914062 27 19.214844 27 18.019531 L 27 5.976562 C 27 4.785156 25.636719 4.082031 24.636719 4.765625 Z M 24.636719 4.765625 "></path></svg> <span>Filmy</span>
        </router-link>
			</li>
			<li class="sidebar__nav-item">
        <a href="/" class="sidebar__nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z"></path></svg> <span>Wróć do GOFlix'a</span>        </a>
			</li>
		</div><div class="scrollbar-track scrollbar-track-x show" style="display: none;"><div class="scrollbar-thumb scrollbar-thumb-x" style="width: 279px; transform: translate3d(0px, 0px, 0px);"></div></div><div class="scrollbar-track scrollbar-track-y show" style="display: none;"><div class="scrollbar-thumb scrollbar-thumb-y" style="height: 362px; transform: translate3d(0px, 0px, 0px);"></div></div></ul>
	</div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: "Sidebar",
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
    avatar() {
      return this.user.photo == null ? 'https://eu.ui-avatars.com/api/?size=512&length=1&name='+`${this.user.name}` : this.user.photo
    }
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/logowanie').catch(() => {});
    }
  }

}
</script>
