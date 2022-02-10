<template>
     <div class="dashboard-container">
        <div class="container-fluid">
           <div class="row" >
              <div class="col-12 col-lg-7" >
                  <h5>Czekający na weryfikacje</h5>
                  <p class="small-paragraph-spacing">Tutaj znajdziesz wszystkich użytkowników.</p>
                 <table class="table text-white mt-4">
                    <thead>
                       <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nazwa uzytkownika</th>
                          <th scope="col">Adres e-mail</th>
                          <th scope="col">Aktywowany</th>
                          <th scope="col">Zarządzaj</th>
                       </tr>
                    </thead>
                    <tbody>
                      <tr v-for="user in users.data" :key="user.id">
                         <th scope="row">#{{user.id}}</th>
                         <td>{{user.name}}</td>
                         <td>{{user.email}}</td>
                         <td v-text="user.step == 'verified' ? 'TAK' : 'NIE'"></td>
                         <td class="d-flex justify-content-between align-items-center"><i @click="update(user.id, 'configuration')" class="icon-Yes text-success"></i><i @click="update(user.id, 'banned')" class="icon-Close text-danger"></i></td>
                      </tr>
                    </tbody>
                 </table>
                 <pagination :data="users" @paginateTo="fetchUser"></pagination>
              </div>
              <!-- <div class="col-12 col-lg-5">
               <h5>Akcpetacja użytkowników</h5>
               <p class="small-paragraph-spacing">Tutaj znajdziesz wszystkich którzy czekaja na weryfikację.</p>
                 <div v-if="!waitings.data>0" class="alert alert-danger" role="alert">
                   Brak uzytkowników do weryfikacji konta...
                 </div>
               <table v-else class="table text-white mt-4">
                    <thead>
                       <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nazwa uzytkownika</th>
                          <th scope="col">Adres e-mail</th>
                          <th scope="col">Zarządzaj</th>
                       </tr>
                    </thead>
                    <tbody>
                      <tr v-for="waiting in waitings.data">
                         <th scope="row">{{waiting.id}}</th>
                         <td>{{waiting.name}}</td>
                         <td>{{waiting.email}}</td>
                         <td><span @click="AcceptOrCancelUser(waiting.id, true)" class="icon-Yes text-success"></span><span @click="AcceptOrCancelUser(waiting.id, false)" class="icon-Close text-danger"></span></td>
                      </tr>
                    </tbody>
                 </table>
                 <pagination :data="waitings" @paginateTo="waitingsList"></pagination>

              </div> -->
           </div>
        </div>
     </div>
</template>

<script>
import axios from 'axios'
import pagination from "~/components/global/Pagination";

export default {
    middleware: ['auth','verify','admin'],
    data: () => ({
      users: {},
      type: []
    }),
  components: {
      pagination
  },
  methods: {
    fetchUser(page = 1) {
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
        this.fetchUser()
      })
    },
    // waitingsList(page = 1) {
    //   this.pages.waitings = page
    //   axios
    //   .get('/api/verify/waiting?page=' + page)
    //   .then(response => (this.waitings = response.data))
    // },
    // AcceptOrCancelUser(id, status) {
    //   axios.post(`/api/verify/users`, {
    //     id: id,
    //     status: status
    //   })
    //   .then(response => {
    //     this.usersList(this.pages.users)
    //     this.waitingsList(this.pages.waitings)
    //   })
    // }
  },
  mounted() {
    this.fetchUser()
  },
  beforeDestroy() {
    clearInterval(this.intervalId)
  }
}

</script>
