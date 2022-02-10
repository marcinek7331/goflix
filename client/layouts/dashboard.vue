<template>
  <div class="layout">
    <Header/>
    <Sidebar/>
    <transition name="page1">
        <nuxt/>
    </transition>
  </div>
</template>
<script>
import Header from '~/components/dashboard/Header'
import Sidebar from '~/components/dashboard/Sidebar'

export default {
  components: {
    Header,
    Sidebar,
  },
  head:{
    link: [{ rel: 'stylesheet', href: require('~/assets/css/admin.css') }]
  },

}
</script>
