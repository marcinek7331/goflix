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
                  <div class="registration-social-login-container h-100 d-flex align-items-center">
                    <div v-if="success" class="alert alert-success" role="alert">
                      {{ status }}
                    </div>
                    <div v-else class="alert alert-danger" role="alert">
                      Nie poprawny link aktywacyjny lub email został juz potwierdzony!
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
  <!-- <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('verify_email')">
        <template v-if="success">
          <div class="alert alert-success" role="alert">
            {{ status }}
          </div>

          <router-link :to="{ name: 'login' }" class="btn btn-primary">
            {{ $t('login') }}
          </router-link>
        </template>
        <template v-else>
          <div class="alert alert-danger" role="alert">
            {{ status || $t('failed_to_verify_email') }}
          </div>

          <router-link :to="{ name: 'verification.resend' }" class="small float-right">
            {{ $t('resend_verification_link') }}
          </router-link>
        </template>
      </card>
    </div>
  </div> -->
</template>

<script>
import axios from 'axios'

const qs = params => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  middleware: 'guest',
  layout: 'auth',

  metaInfo () {
    return { title: "Weryfikacja adres e-mail" }
  },

  async asyncData ({ params, query }) {
    try {
      const { data } = await axios.post(`/email/verify/${params.id}?${qs(query)}`)

      return { success: true, status: data.status }
    } catch (e) {
      return { success: false, status: e.response.data.status }
    }
  }
}
</script>
