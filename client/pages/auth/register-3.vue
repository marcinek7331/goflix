<template>
   <div id="content-pro">
      <div class="container">
         <div class="centered-headings-pro pricing-plans-headings">
            <h1>Konfiguracja</h1>
            <h6>Juz prawie koniec... Pozwól nam się jeszcze poznać.</h6>
         </div>
      </div>
      <div class="container">
         <ul id="registration-steps-pro">
            <li >
               <a >
                  <div class="registration-step-circle-icon">01</div>
                  <div class="registration-step-number">Krok 1</div>
                  <h5 class="registration-step-title">Utwórz konto.</h5>
               </a>
            </li>
            <li>
               <a>
                  <div class="registration-step-circle-icon">02</div>
                  <div class="registration-step-number">Krok 2</div>
                  <h5 class="registration-step-title">Skonfiguruj konto.</h5>
               </a>
            </li>
            <li class="current-menu-item">
               <a>
                  <div class="registration-step-circle-icon">03</div>
                  <div class="registration-step-number">Krok 3</div>
                  <h5 class="registration-step-title">Witaj w GOFlixie!</h5>
               </a>
            </li>
         </ul>
         <div class="clearfix"></div>
      </div>
      <div id="pricing-plans-background-image">
         <div class="container">
            <div class="registration-steps-page-container">
               <div class="registration-step-final-padding">
                  <h2 class="registration-final-heading">Witaj <span>{{user.name}}</span>. Jeszcze tylko kilka kroków, aby uzupełnić konto</h2>
                  <div class="registration-invite-friends">
                     <form class="registration-invite-friends-form">
                        <div class="form-group">
                           <label for="full-name" class="col-form-label">Zaproś swoich znajomych</label>
                           <input type="text" class="form-control" id="full-name" placeholder="Wprowadź nazwę użytkownika">
                        </div>
                        <div class="form-group-invite-friends">
                           <ul class="registration-invite-friends-list">
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>
                              <li>
                                 <i class="fas fa-check-circle"></i>
                                 <img src="https://eu.ui-avatars.com/api/?&color=fff&name=" alt="Friends">
                                 <div class="friends-social-media"></div>
                              </li>

                           </ul>
                           <div class="clearfix"></div>
                        </div>
                     </form>
                  </div>
                  <div class="registration-genres-step">
                    <h5>Wybierz preferowane gatunki:</h5>
                    <ul class="registration-genres-choice" >
                      <li @click="selectGenre(index)" v-for="(genre, index) in genres" :class="genre.active ? 'active':''">
                        <img :src="require(`~/assets/images/genres/${genre.id}.png`)" :alt="genre.id">
                        <h6>{{genre.name}}</h6>
                      </li>
                    </ul>
                     <div class="clearfix"></div>
                  </div>
                  <div class="registration-step-final-footer">
                     <button @click="finish" type="submit" class="btn btn-green-pro">Zakończ</button>
                     <button @click="skipStep" class="btn">
                        Pomiń
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import LoginWithFacebook from '~/components/global/LoginWithFacebook'
import LoginWithGoogle from '~/components/global/LoginWithGoogle'
import { mapGetters } from 'vuex'

export default {
  layout: 'auth',
  middleware: ['auth', 'verify'],
  components: {
    LoginWithFacebook,
    LoginWithGoogle
  },
  metaInfo () {
    return { title: this.$t('register') }
  },
  computed: mapGetters({
    user: 'auth/user',
    genres: 'genres/genres'

  }),
  created() {
    this.genres.forEach((genre, index) => {
      if(this.user.genres!=null&&this.user.genres.includes(genre.id)) {
        this.genres[index].active = true
      }
    })
  },
  methods: {
    selectGenre(id) {
      this.$store.dispatch('genres/updateGenres', id)
    },
    skipStep() {
      axios.patch('/verify', {
        status: 'verified'
      })
      .then(res => {
        this.$store.dispatch('auth/fetchUser')
        setTimeout(()=>{
          this.$router.push({name: 'home'}).catch(() => {});
        },1000);
      })
    },
    finish() {
      this.updateGenres()
      this.skipStep()
    },
    async updateGenres() {
      let data = []
      this.genres.forEach((genre) => {
        if(genre.active) {
          data.push(genre.id)
        }
      });
      axios.patch('/settings/genres', {id:data}).then(() => {
        this.$store.dispatch('auth/fetchUser')
      })
    },
  }
}
</script>
