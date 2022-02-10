<template>
   <div id="content-pro">
      <div class="container">
         <div class="centered-headings-pro pricing-plans-headings">
            <h1>Rejestracja</h1>
            <h6>Aby rozpocząc swoją przygodę z GOFlixem proszę się zarejestrować.</h6>
         </div>
      </div>
      <div class="container">
         <ul id="registration-steps-pro">
            <li class="current-menu-item">
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
            <li>
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

               <form class="registration-steps-form" @submit.prevent="register" @keydown="form.onKeydown($event)">
                  <div class="registration-social-login-container">
                    <alert-success class="form-group" :form="form" :message="status" />

                     <div class="form-group">
                        <label for="name" class="col-form-label">Nazwa użytkowania</label>
                        <input v-model="form.name" placeholder="Nazwa użytkownika" :class="{ 'is-invalid': form.errors.has('name') }" type="text" name="name" class="form-control">
                        <has-error :form="form" field="name" />
                     </div>
                     <div class="form-group">
                        <label for="email" class="col-form-label">Adres e-mail</label>
                        <input v-model="form.email" placeholder="Adres e-mail" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="form-control">
                        <has-error :form="form" field="email" />
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col">
                              <label for="password" class="col-form-label">Hasło</label>
                              <input v-model="form.password"  placeholder="······" :class="{ 'is-invalid': form.errors.has('password') }" type="password" name="password" class="form-control">
                              <has-error :form="form" field="password" />
                           </div>
                           <div class="col">
                              <label for="confirm-password" class="col-form-label">&nbsp;</label>
                              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" type="password" name="password_confirmation"
                                 class="form-control"
                                 >
                              <has-error :form="form" field="password_confirmation" />
                           </div>
                        </div>
                     </div>
                     <div class="registration-social-login-or">lub</div>
                  </div>
                  <div class="registration-social-login-options">
                     <h6>Zaloguj się za pomocą swojego konta społecznościowego.</h6>
                     <login-with-facebook />
                     <login-with-google />
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group last-form-group-continue">
                     <v-button class="btn btn-green-pro btn-primary" :loading="form.busy">
                        Zarejestruj się
                     </v-button>
                     <span class="checkbox-remember-pro">
                        <input :class="{ 'is-invalid': form.errors.has('checkbox') }" v-model="form.checkbox" type="checkbox" id="checkbox-terms">
                        <label for="checkbox-terms" class="col-form-label">
                           Klikając „Zarejestruj się”, akceptujesz nasze <a href="#!">Warunki użytkowania</a> i
                           <a href="#!">Politykę prywatności</a> w tym stosowanie plików cookie.
                           <div v-if="form.errors.has('checkbox')" class="help-block d-block invalid-feedback">Musisz zatwierdzić nasz regulamin.</div>
                        </label>
                     </span>
                     <div class="clearfix"></div>
                  </div>
               </form>
               <router-link class="not-a-member-pro" :to="{ name: 'login'}">Masz już konto? <span>Zaloguj się tutaj!</span></router-link>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',
  layout: 'auth',
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      checkbox: false
    }),
    mustVerifyEmail: false,
    status: null,
  }),

  head () {
    return { title: 'Rejestracja' }
  },
  methods: {
    async register () {
      let data
      try {
        const response = await this.form.post('/register')
        data = response.data
      } catch (e) {
        return
      }
      if (data.status) {
        this.mustVerifyEmail = true
        this.status = data.status
        this.form.reset()
      }
      else {
        const { data: { token } } = await this.form.post('/login')
        this.$store.dispatch('auth/saveToken', { token })
        await this.$store.dispatch('auth/updateUser', { user: data })
        this.$router.push({name: 'register-2'}).catch(() => {});
      }
    }
  }
}
</script>
