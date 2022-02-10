<template >
  <div class="dashboard-container">
    <div class="row">
    <div class="col-12 d-flex justify-content-center">
      <nav class="navigation-tab">
        <div v-for="(tab, index) in tabs" @click="selectTab(index)" :class="active == index ? 'active' : ''" class="navigation-tab-item">
          <span class="navigation-tab__icon">
            <img src="~assets/images/add-user.png" :alt="tab.name">
            <!-- <i class="fas fa-3x" :class="tab.icon"></i> -->
          </span>
          <span class="navigation-tab__txt">{{tab.name}}</span>
        </div>

  <div class="navigation-tab-overlay"></div>
</nav>
      <!-- <nav class="navigation-tab">
        <div v-for="(tab, index) in tabs" @click="selectTab(index)" class="navigation-tab-item" :class="active == index ? 'active' : ''">
          <span class="navigation-tab__icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
            <line x1="7" y1="7" x2="7" y2="7"></line>
          </svg>
        </span>
          <span class="navigation-tab__txt">{{tab.name}}</span>
        </div>
        <div class="navigation-tab-overlay"></div>
      </nav> -->
    </div>
      <div class="col-12 d-flex justify-content-center">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>

      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import profile from '~/pages/profile/index'
export default {
  name: 'Friends',
  components: {
    profile
  },
  computed: {
    tabs () {
      return [
        {
          name: 'Wszyscy znajomi',
          icon: 'fa-users',
          route: 'settings.profile'
        },
        {
          name: 'Oczekujący znajomi',
          icon: 'fa-users',
          route: 'settings.password'
        },
        {
          name: 'Zaakceptowani znajomi',
          icon: 'fa-users',
          route: 'settings.password'
        },
        {
          name: 'Odrzuconi znajomi',
          icon: 'fa-users',
          route: 'settings.password'
        },
        {
          name: 'Zablokowani znajomi',
          icon: 'fa-users',
          route: 'settings.password'
        },
      ]
    }
  },
  data: () => ({
    active: 0,
  }),
  methods: {
    selectTab(i) {
      this.active = i
      this.$el.querySelector('.navigation-tab-overlay').style.left = (this.active)*130+"px"
    }
  },
  mounted() {
    // $(".navigation-tab-item").click(function() {
    //   $(".navigation-tab-item").removeClass("active");
    //   $(this).addClass("active");
    //   $(".navigation-tab-overlay").css({
    //     left: $(this).prevAll().length * 130 + "px"
    //   });
    // });
  }

}
</script>
