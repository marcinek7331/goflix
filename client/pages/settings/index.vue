<template>
   <div class="dashboard-container">
      <ul class="dashboard-sub-menu">
         <li class="current"><a href="">Ustawienia konta</a></li>
      </ul>
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-lg-3">
               <div id="account-edit-photo">
                  <div>

                    <img v-lazy="avatar" :alt="user.name">

                  </div>
                  <p><input type="file" ref="file" v-on:change="onImageChange" class="btn btn-green-pro" accept="image/*" /></p>
                  <p><button @click="deleteImage()"class="btn">Usuń zdjęcie</button></p>
               </div>
            </div>
            <div class="col">
               <div class="account-settings-form">
                  <alert-success :form="personal" :message="'Twoje dane personalne zostały pomyślnie zaktualizowane.'" />
                  <h5>Informacje ogólne</h5>
                  <p class="small-paragraph-spacing">Podając nam swoje imię i nazwisko, możemy uczynić nasze wsparcie bardziej osobistym.</p>
                  <form @submit.prevent="updatePersonal" @keydown="personal.onKeydown($event)">
                     <div class="row">
                        <div class="col-sm">
                           <div class="form-group">
                              <label for="first-name" class="col-form-label">Nazwa użytkownika:</label>
                              <input v-model="personal.name" :class="{ 'is-invalid': personal.errors.has('name') }" class="form-control" type="text" name="name">
                              <has-error :form="personal" field="name" />
                           </div>
                        </div>
                        <div class="col-sm">
                           <div class="form-group">
                              <label for="e-mail" class="col-form-label">Adres e-mail</label>
                              <input v-model="personal.email" :class="{ 'is-invalid': personal.errors.has('email') }" class="form-control" type="email" name="email">
                              <has-error :form="personal" field="email" />
                           </div>
                        </div>
                     </div>
                     <v-button :loading="personal.busy" type="success" class="btn btn-green-pro">
                        Zapisz zmiany
                     </v-button>
                  </form>
                  <hr>
                  <alert-success :form="password" :message="'Twoje hasło zostało pomyślnie zmienione.'" />
                  <h5>Zmień hasło</h5>
                  <p class="small-paragraph-spacing">Tutaj możesz zmienić hasło.</p>
                  <form @submit.prevent="updatePassword" @keydown="password.onKeydown($event)">
                     <div class="row">
                        <div class="col-sm">
                           <div class="form-group">
                              <label for="password" class="col-form-label">Aktualane hasło:</label>
                              <input v-model="password.old_password" :class="{ 'is-invalid': password.errors.has('old_password') }" class="form-control" type="password" name="old_password" >
                              <has-error :form="password" field="old_password" />
                           </div>
                        </div>
                        <div class="col-sm">
                           <div class="form-group">
                              <label for="new-password" class="col-form-label">Nowe hasło:</label>
                              <input v-model="password.password" :class="{ 'is-invalid': password.errors.has('password') }" class="form-control" type="password" name="password">
                              <has-error :form="password" field="password" />
                           </div>
                        </div>
                        <div class="col-sm">
                           <div class="form-group">
                              <div><label for="confirm-password" class="col-form-label">&nbsp; &nbsp;</label></div>
                              <input v-model="password.password_confirmation" :class="{ 'is-invalid': password.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation">
                              <has-error :form="password" field="password_confirmation" />
                           </div>
                        </div>
                     </div>
                     <v-button :loading="password.busy" type="success" class="btn btn-green-pro">
                        Zmień hasło
                     </v-button>
                  </form>
                  <hr>
                  <h5>Ulubione gatunki</h5>
                  <p class="small-paragraph-spacing">Wybierz swoje ulubione gatunki.</p>
                  <div class="registration-genres-step">
                    <ul class="registration-genres-choice" >
                      <li @click="selectGenre(index), updateGenres()" v-for="(genre, index) in genres" :class="genre.active ? 'active':''">
                        <img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.id">
                        <h6>{{genre.name}}</h6>
                      </li>
                    </ul>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <hr>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import {
  mapGetters
} from 'vuex'
import axios from 'axios'
import Form from 'vform'
export default {
  middleware: ['auth', 'verify'],
  computed: {
    ...mapGetters({
      user: 'auth/user',
      genres: 'genres/genres',
    }),
    avatar() {
      return this.user.photo == null ? 'https://eu.ui-avatars.com/api/?format=svg&size=512&length=1&name='+this.user.name : this.user.photo
    }
  },
  data: () => ({
    image: '',
    personal: new Form({
      name: '',
      email: ''
    }),
    password: new Form({
      old_password: '',
      password: '',
      password_confirmation: ''
    }),
  }),
  methods: {
    onImageChange(e) {
      this.image = e.target.files[0]
      this.formSubmit()
    },
    async formSubmit() {
      const config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      }
      let formData = new FormData();
      formData.append('image', this.image)
      axios.post('/settings/image', formData, config)
        .then(({
          data: user
        }) => {
          this.$store.dispatch('auth/updateUser', {
            user
          })
          this.$refs.file.value = ''
        })
    },
    async deleteImage() {
      axios.delete('/settings/image')
        .then(({
          data: user
        }) => {
          this.$store.dispatch('auth/updateUser', {
            user
          })
        })
    },
    async updatePersonal() {
      this.personal.patch('/settings/profile').then(({
        data: user
      }) => {
        this.$store.dispatch('auth/updateUser', {
          user
        })
      })
    },
    async updatePassword() {
      this.password.patch('/settings/password').then(() => {
        this.password.reset()
      })
    },
    async updateGenres() {
      let data = []
      this.genres.forEach((genre) => {
        if (genre.active) {
          data.push(genre.id)
        }
      });
      axios.patch('/settings/genres', {id: data})
        .then(({
          data: user
        }) => {
          this.$store.dispatch('auth/updateUser', {
            user
          })
      })
      // axios.patch('/settings/genres', {
      //   id: data
      // }).then(() => {
      //   this.$store.dispatch('auth/updateUser', {
      //     user
      //   })
      // })
    },
    selectGenre(id) {
      this.$store.dispatch('genres/updateGenres', id)
    }
  },
  created() {
    this.personal.keys().forEach((key) => {
        this.personal[key] = this.user[key]
      }),
      this.genres.forEach((genre, index) => {
        if (this.user.genres != null && this.user.genres.includes(genre.id)) {
          this.genres[index].active = true
        }
      })

  },
}
</script>
