<template>
  <div id="content-pro">
      <div class="container">
         <div class="centered-headings-pro pricing-plans-headings">
            <h1>Resetowanie hasła</h1>
            <h6>Jeśli zapomniałeś hasła tutaj je odzyszkasz mistrzu!</h6>
         </div>
      </div>
      <div id="pricing-plans-background-image">
         <div class="container">
            <div class="registration-steps-page-container">
               <form class="registration-steps-form"  @submit.prevent="reset" @keydown="form.onKeydown($event)">
                  <div class="registration-social-login-container">
                    <alert-success :form="form" :message="status+ ' Zaraz nastąpi przekierowanie ('+timer+'s)'" />
                    <div class="form-group">
                      <label for="email" class="col-form-label">Adres e-mail</label>
                      <input readonly v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="form-control" readonly>
                      <has-error :form="form" field="email" />
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-form-label">Nowe hasło</label>
                      <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" type="password" name="password" class="form-control">
                      <has-error :form="form" field="password" />
                    </div>
                    <div class="form-group">
                      <label for="password_confirmation" class="col-form-label">Powtórz nowe hasło</label>
                      <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" type="password" name="password_confirmation" class="form-control">
                      <has-error :form="form" field="password_confirmation" />
                    </div>
                     <div class="form-group">
                       <v-button :loading="form.busy" class="btn btn-green-pro btn-display-block">
                         Zresetuj hasło
                       </v-button>
                     </div>
                     <div class="registration-social-login-or">lub</div>
                  </div>
                  <div class="registration-social-login-options">
                     <h6>Zaloguj się za pomocą swojego konta społecznościowego.</h6>
                     <login-with-facebook />
                     <login-with-google />
                  </div>
                  <div class="clearfix"></div>
               </form>
               <router-link class="not-a-member-pro" :to="{ name: 'login'}">Przypomniałeś sobie hasło? <span>Zaloguj się tutaj!</span></router-link>

            </div>
         </div>
      </div>
   </div>
 </div>
</template>
<script>
import Form from 'vform'

export default {
  layout: 'auth',
  middleware: 'guest',

  data: () => ({
    status: '',
    timer: 5,
    interval: null,
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  head () {
    return { title: this.$t('reset_password') }
  },

  created () {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },

  methods: {
    redirect() {
      this.interval = setInterval(() => {
        this.timer--
        if(this.timer == 0) {
          this.$router.push({name: 'login'}).catch(() => {})
        }
      }, 1000);
    },
    reset () {
      this.form.post('/password/reset').then(({ data }) => {
        this.status = data.status
        this.form.reset()
        this.redirect()
      })
    }
  }
}
</script>
