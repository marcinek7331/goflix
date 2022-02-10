<template>
  <div v-if="!loading" class="sidebar-bg">
    <Header />
    <Navbar />
    <main id="col-main">
      <transition name="page1">
          <nuxt />

        </transition>
    </main>
  </div>
</template>

<script>
import Navbar from '~/components/default/Navbar'
import Header from '~/components/default/Header/index'

export default {
  components: {
    Navbar,
    Header
  },
  data: () => ({
    loading: true,
  }),
  head:{
    link: [{ rel: 'stylesheet', href: require('~/assets/css/main.css') }]
  },
  mounted() {
    this.$nextTick(() => {
      if(this.$nuxt.$loading.canSucceed) {
        this.loading = false
      }
    })
  }
}
</script>
