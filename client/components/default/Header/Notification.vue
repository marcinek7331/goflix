<template>
  <div v-click-outside="close" id="header-user-notification" :class="active ? 'active' : 'hide'" >
     <div  @click="toggle" id="header-user-notification-click" class="noselect">
        <i :class="total>0 ? 'active' : ''" class="far fa-bell"></i>
        <span class="user-notification-count">{{total}}</span>
     </div>
     <div   id="header-user-notification-menu">
       <div class="d-flex justifity-between align-items-center">
         <h3>Powiadomienia</h3>
         <p @click="markAllRead()">Oznacz wszystkie jako przeczytane</p>
       </div>
        <div id="header-notification-menu-padding">
          <ul id="header-user-notification-list">
            <li v-for="notification in notifications">
              <div class="body">
                <img v-if="notification.avatar == null" src="~/assets/images/mini_logo.png">
                <img v-else :src="`${notification.avatar}`">
                {{notification.body}}
                <div v-if="notification.from=='frirendships'" class="header-user-notify-request">
                  <span @click="acceptFriendRequest(notification,notification.sender)" class="icon-Yes"></span><span @click="denyFriendRequest(notification,notification.sender)" class="icon-Close"></span>
                </div>
                  <div class="header-user-notify-time">
                    {{ $moment(notification.created).fromNow() }}
                  </div>
              </div>
              <i @click.prevent="markAsRead(notification)" class="fa fa-times"></i>
            </li>
          </ul>
           <div class="clearfix"></div>
        </div>
     </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import ClickOutside from 'vue-click-outside'
import axios from 'axios'

export default {
  name: 'Notifications',
  computed: {
    ...mapGetters({
      user: 'auth/user',
      check: 'auth/check'
    }),
    hasUnread () {
      return this.total > 0
    }
  },
  data() {
    return {
      active: false,
      total: 0,
      notifications: []
    };
  },
  methods: {
    acceptFriendRequest(notification, sender) {
      axios.post('settings/frirends/accept', {
        sender: sender
      })
      this.markAsRead(notification)
    },
    denyFriendRequest(notification, sender) {
      axios.post('settings/frirends/deny', {
        sender: sender
      })
      this.markAsRead(notification)
    },
    markAsRead ({ id }) {
      const index = this.notifications.findIndex(n => n.id === id)
      if (index > -1) {
        this.total--
        this.notifications.splice(index, 1)
        axios.patch(`/notifications/${id}/read`)
      }
    },
    markAllRead () {
      this.active = false
      this.total = 0
      this.notifications = []
      axios.post('/notifications/mark-all-read')
    },
    fetch (limit = 5) {
  axios.get('/notifications', { params: { limit } })
    .then(({ data: { total, notifications } }) => {
      this.total = total
      this.notifications = notifications.map(({ id, data, created,avatar,from }) => {
        return {
          id: id,
          title: data.title,
          avatar: data.avatar,
          from: data.from,

          body: data.body,
          created: created,
          action_url: data.action_url
        }
      })
    })
    },
    listen () {
      window.Echo.private(`App.Models.User.${this.user.id}`)
        .notification(notification => {
          this.total++
          this.notifications.unshift(notification)
        })
        .listen('NotificationRead', ({ notificationId }) => {
          this.total--
          const index = this.notifications.findIndex(n => n.id === notificationId)
          if (index > -1) {
            this.notifications.splice(index, 1)
          }
        })
        .listen('NotificationReadAll', () => {
          this.total = 0
          this.notifications = []
        })
    },
    toggle() {
      if(this.total > 0) {
        this.active = !this.active
      }
    },
    close() {
      this.active = false
    },
  },
  mounted() {
    this.fetch()
    if (window.Echo) {
      this.listen()
    }
    this.popupItem = this.$el.querySelector('#header-user-notification')
  },
  directives: {
    ClickOutside
  }
}

</script>
