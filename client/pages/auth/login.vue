<template>
  <div id="content-pro">
      <div class="container">
         <div class="centered-headings-pro pricing-plans-headings">
            <h1>Logowanie</h1>
            <h6>Aby móc korzystać z serwisu proszę się zalogować.</h6>
         </div>
      </div>
      <div id="pricing-plans-background-image">
         <div class="container">
            <div class="registration-steps-page-container">
               <form class="registration-steps-form" @submit.prevent="login" @keydown="form.onKeydown($event)">
                  <div class="registration-social-login-container">
                     <div class="form-group">
                       <label for="email" class="col-form-label">Adres e-mail</label>
                       <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" placeholder="Adres e-mail">
                       <has-error :form="form" field="email" />
                     </div>
                     <div class="form-group">

                       <label for="password" class="col-form-label">Hasło</label>
                       <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" placeholder="······">
                       <has-error :form="form" field="password" />
                     </div>
                     <div class="form-group">
                       <v-button :loading="form.busy" class="btn btn-green-pro btn-display-block">
                         Zaloguj się
                       </v-button>
                        <!--<button  :loading="form.busy" type="submit" class="btn btn-green-pro btn-display-block">Zaloguj się</button>-->
                     </div>
                     <div class="container-fluid">
                        <div class="row no-gutters">
                           <div class="col checkbox-remember-pro">
                             <checkbox checked v-model="remember" name="remember">
                               Zapamiętaj mnie.
                             </checkbox>
                           </div>
                           <div class="col forgot-your-password"><router-link :to="{ name: 'password.request'}">Zapomniałeś swojego hasla?</router-link></div>
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

               </form>
               <router-link :to="{ name: 'register' }" class="not-a-member-pro">
                 Nie masz konta? <span>Dołącz dzisiaj!</span>
               </router-link>


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
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  head () {
    return { title: 'Logowanie' }
  },

  methods: {
    async login () {
      let data

      // Submit the form.
      try {
        const response = await this.form.post('/login')
        data = response.data
      } catch (e) {
        return
      }

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      this.$router.push({name: 'home'}).catch(() => {});

    }
  }
}
</script>
