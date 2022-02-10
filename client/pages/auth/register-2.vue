<template>
   <div id="content-pro">
      <div class="container">
         <div class="centered-headings-pro pricing-plans-headings">
            <h1>Rejestracja zakończona.</h1>
            <h6>Gratulacje jesteś oficjalnym członkiem GOFlixa!</h6>
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
           <li class="current-menu-item">
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
               <div class="registration-step-final-padding welcome-page-styles">
                  <div class="centered-headings-pro pricing-plans-headings">
                     <h1>Trwa weryfikacja konta (#{{user.id}})...</h1>
                  </div>
                  <h6 class="welcome-style-summary">Łookej.. Teraz musisz cierpliwię poczekać na weryfikację i akceptację swojego konta.</h6>
                  <h6 class="welcome-style-summary"> Aby dokonać szybko weryfikacji możesz się do mnie zgłosić z prośbą w wiadomości prywatnej, u samej góry widnieje twój identyfikator. Podaj mi go ^^.</h6>
                  <h6 class="welcome-style-summary"> Po udanej weryfikacji dostajesz peły dostęp do serwisu.  ~ Marcin</h6>
                  <div class="container">
                     <div class="loader">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="registration-step-final-footer pt-5">
                     <button @click="logout" class="btn">Wyloguj się</button>

                     <button @click="checkVerify" class="btn btn-green-pro">
                        Sprawdź
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   import axios from 'axios'
   import { mapGetters } from 'vuex'

   export default {
     data: () => ({
       interval: null,
     }),
     middleware: ['auth', 'verify'],
     layout: 'auth',
     metaInfo () {
       return { title: this.$t('register') }
     },
     computed: mapGetters({
       user: 'auth/user',
     }),
     methods: {
       async logout () {
         await this.$store.dispatch('auth/logout')
          this.$router.push('/logowanie')
       },
       async checkVerify() {
          this.interval = setInterval(async () => {
            await this.$store.dispatch('auth/fetchUser')
            if(this.user.step === 'configuration') {
              this.$router.push({name: 'register-3'}).catch(() => {});
            }
         }, 4000);
       }
     },
     created() {
       this.checkVerify()
     },
     beforeDestroy() {
       clearInterval(this.interval)
     }
   }
</script>
