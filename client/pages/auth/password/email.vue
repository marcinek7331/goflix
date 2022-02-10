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
               <form class="registration-steps-form" @submit.prevent="send" @keydown="form.onKeydown($event)">
                  <div class="registration-social-login-container">
                    <alert-success class="form-group" :form="form" :message="status" />

                    <div class="form-group">
                        <label for="password" class="col-form-label">Adres e-mail</label>
                        <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="form-control">
                        <has-error :form="form" field="email" />
                    </div>
                     <div class="form-group">
                       <v-button :loading="form.busy" class="btn btn-green-pro btn-display-block">
                         Wyślij zapytanie
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
    form: new Form({
      email: ''
    })
  }),

  head () {
    return { title: 'Resetowanie hasła' }
  },
  methods: {
    send () {
      this.form.post('/password/email').then(({ data }) => {
        this.status = data.status
        this.form.reset()

      })
    }
  }
}
</script>
