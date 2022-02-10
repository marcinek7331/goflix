<template>
  <div class="layout">
    <Header />

    <transition name="page1">
        <nuxt/>

      </transition>

  </div>

</template>

<script>
import Header from '~/components/guest/Header'
import Footer from '~/components/guest/Footer'

export default {
  components: {
    Header, Footer
  },
  head:{
    link: [{ rel: 'stylesheet', href: require('~/assets/css/main.css') }]
  },
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start()
      setTimeout(() => this.$nuxt.$loading.finish(), 500)
    })
  }
}
</script>
