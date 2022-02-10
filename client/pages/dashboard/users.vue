<template>
   <main class="main">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="main__title">
                  <h2>Użytkownicy</h2>
                  <span class="main__title-stat">3 702 wszystkich</span>
                  <div class="main__title-wrap">
                     <div class="filter" id="filter__sort">
                        <span class="filter__item-label">Posortuj po:</span>
                        <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <input type="button" value="Data założenia">
                           <span></span>
                        </div>
                        <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                           <li data-value="date created">Daty założenia</li>
                           <li data-value="pricing plan">Pricing plan</li>
                           <li data-value="status">Status</li>
                        </ul>
                     </div>
                     <form action="#" class="main__title-form">
                        <input type="text" placeholder="Znajdź użytkownika...">
                        <button type="button">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <circle cx="8.25998" cy="8.25995" r="7.48191" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                              <path d="M13.4637 13.8523L16.3971 16.778" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-12">
               <div class="main__table-wrap" data-scrollbar="true" tabindex="-1" style="overflow: hidden; outline: none;">
                  <div class="scroll-content" style="transform: translate3d(0px, 0px, 0px);">
                     <table class="main__table">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>PODSTAWOWE INFORMACJE</th>
                              <th>NAZWA UŻYTKOWNIKA</th>
                              <th>STATUS</th>
                              <th>DATA ZAŁOŻENIA</th>
                              <th>AKCJE</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(user,index) in users.data" :key="user.id">
                              <td>
                                 <div class="main__table-text">{{user.id}}</div>
                              </td>
                              <td>
                                 <div class="main__user">
                                    <div class="main__avatar">
                                       <img v-lazy="user.photo == null ? 'https://eu.ui-avatars.com/api/?size=512&length=1&name='+`${user.name}` : user.photo" :alt="user.name">
                                    </div>
                                    <div class="main__meta">
                                       <h3>{{user.name}}</h3>
                                       <span>{{user.email}}</span>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <div class="main__table-text">{{user.name}}</div>
                              </td>
                              <td>
                                 <div class="main__table-text" :class="user.step=='verified' || user.step=='configuration' ? 'main__table-text--green' : 'main__table-text--red'">{{user.step}}</div>
                              </td>
                              <td>
                                 <div class="main__table-text">{{user.created_at}}</div>
                              </td>
                              <td>
                                 <div class="main__table-btns">
                                    <button @click="openStatusModal(index)" class="main__table-btn main__table-btn--banned open-modal">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                          <path d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"></path>
                                       </svg>
                                    </button>
                                    <router-link  class="main__table-btn main__table-btn--edit" :to="{ name: 'dashboard.edit.user', params: { id: user.id }}">   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                          <path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"></path>
                                       </svg></router-link>
                                    <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                          <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"></path>
                                       </svg>
                                    </a>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="scrollbar-track scrollbar-track-x show" style="display: none;">
                     <div class="scrollbar-thumb scrollbar-thumb-x" style="width: 1323px; transform: translate3d(0px, 0px, 0px);"></div>
                  </div>
                  <div class="scrollbar-track scrollbar-track-y show" style="display: none;">
                     <div class="scrollbar-thumb scrollbar-thumb-y" style="height: 832px; transform: translate3d(0px, 0px, 0px);"></div>
                  </div>
               </div>
            </div>
            <div class="col-12">

               <div class="paginator">
                  <span class="paginator__pages">10 z 3 702</span>
                  <pagination :data="users" :onEachSide="3" @paginateTo="fetchUsers"/>


                  <!-- <ul class="paginator__paginator">
                     <li>
                        <a href="#">
                           <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.75 5.36475L13.1992 5.36475" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M5.771 10.1271L0.749878 5.36496L5.771 0.602051" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </a>
                     </li>
                     <li class="active"><a href="#">1</a></li>
                     <li><a href="#">2</a></li>
                     <li><a href="#">3</a></li>
                     <li><a href="#">4</a></li>
                     <li>
                        <a href="#">
                           <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13.1992 5.3645L0.75 5.3645" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M8.17822 0.602051L13.1993 5.36417L8.17822 10.1271" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </a>
                     </li>
                  </ul> -->
               </div>
            </div>
         </div>
      </div>
      <Modal @acceptStatus='updateStatus' :activated.sync="modal.status">
        <template v-slot:title>
          Weryfikacja użytkownika
        </template>
        <template v-slot:description>
          Jesteś pewny, że chcesz zaakceptować użytkownika?
        </template>
      </Modal>
   </main>
</template>

<script>
import axios from 'axios'
import pagination from "~/components/dashboard/Pagination";
import Modal from "~/components/dashboard/Modal";

export default {
    middleware: ['auth','verify','admin'],
    layout: 'dashboard',
    data: () => ({
      users: {},
      user: null,
      modal: {
        status: false,
        delete: false,
      }
    }),
  components: {
      pagination,
      Modal
  },
  methods: {
    fetchUsers(page = this.$route.query.page || 1) {
      axios
      .get('/verify?page=' + page)
      .then(response => (this.users = response.data))
    },
    update(id, status) {
      axios.patch('/verify', {
        id: id,
        status: status
      })
      .then(res => {
        this.fetchUsers()
      })
    },
    openStatusModal(index){
      this.modal.status = !this.modal.status
      this.user = index
    },
    async updateStatus() {
      const { data } = await axios.patch('/verify', {id:this.users.data[this.user].id, status: 'configuration'})
      this.users.data[this.user].step = 'configuration'
    }
  },
  mounted() {
    this.fetchUsers()
  },
  beforeDestroy() {
    clearInterval(this.intervalId)
  },
  watch: {
    users: function (val) {
      this.$router.replace({ name: "dashboard.users", query: {page: val.current_page} })

    },
  }
}

</script>
