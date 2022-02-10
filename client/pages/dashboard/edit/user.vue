<template >
   <main class="main">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="main__title">
                  <h2>Edycja użytkownika</h2>
               </div>
            </div>
            <div class="col-12">
               <div class="profile__content">
                  <div class="profile__user">
                     <div class="profile__avatar">
                        <img :src="user.photo == null ? 'https://eu.ui-avatars.com/api/?size=512&length=1&name='+`${user.name}` : user.photo" :alt="user.name">
                     </div>
                     <div class="profile__meta profile__meta--green">
                        <h3>{{user.name}} <span>(Approved)</span></h3>
                        <span>GOFlix ID: {{user.id}}</span>
                     </div>
                  </div>
                  <div class="profile__actions">
                     <a href="#modal-status3" class="profile__action profile__action--banned open-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                           <path d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"></path>
                        </svg>
                     </a>
                     <a href="#modal-delete3" class="profile__action profile__action--delete open-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                           <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"></path>
                        </svg>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-12">
               <div class="sign__wrap">
                  <div class="row">
                     <div class="col-12 col-lg-6">
                        <form action="#" class="sign__form sign__form--profile sign__form--first">
                           <div class="row">
                              <div class="col-12">
                                 <h4 class="sign__title">Szczegóły użytkownika</h4>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="username">Nazwa użytkownika</label>
                                    <input id="username" type="text" name="username" class="sign__input" :placeholder="user.name">
                                 </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="email">Adres e-mail</label>
                                    <input id="email" type="text" name="email" class="sign__input" :placeholder="user.email">
                                 </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="subscription">Subscription</label>
                                    <select class="js-example-basic-single select2-hidden-accessible" id="subscription" data-select2-id="subscription" tabindex="-1" aria-hidden="true">
                                       <option value="Basic" data-select2-id="2">Basic</option>
                                       <option value="Premium">Premium</option>
                                       <option value="Cinematic">Cinematic</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 78px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-subscription-container"><span class="select2-selection__rendered" id="select2-subscription-container" role="textbox" aria-readonly="true" title="Basic">Basic</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                 </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="rights">Ranga</label>
                                    <select class="js-example-basic-single select2-hidden-accessible">
                                       <option value="User" data-select2-id="4">Użytkownik</option>
                                       <option value="Moderator">Moderator</option>
                                       <option value="Admin">Admin</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default select2-container--open" dir="ltr" data-select2-id="3" style="width: 82px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-rights-container"><span class="select2-selection__rendered" id="select2-rights-container" role="textbox" aria-readonly="true" title="User">User</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

                                 </div>
                              </div>
                              <div class="col-12">
                                 <button class="sign__btn" type="button">Zapisz</button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <div class="col-12 col-lg-6">
                        <form action="#" class="sign__form sign__form--profile">
                           <div class="row">
                              <div class="col-12">
                                 <h4 class="sign__title">Zmiana hasła</h4>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="newpass">Nowe hasło</label>
                                    <input id="newpass" type="password" name="newpass" class="sign__input">
                                 </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                 <div class="sign__group">
                                    <label class="sign__label" for="confirmpass">Powtórz nowe hasło</label>
                                    <input id="confirmpass" type="password" name="confirmpass" class="sign__input">
                                 </div>
                              </div>
                              <div class="col-12">
                                 <button class="sign__btn" type="button">Zmień hasło</button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <!-- end password form -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {
  middleware: ['auth', 'verify', 'admin'],
  layout: 'dashboard',
  head () {
    return { title: 'dashboard' }
  },
  mounted () {
    this.fetchUser()
  },
  data: () => ({
    user: [],
  }),
  methods: {
    async fetchUser() {
      const { data } = await axios.get('/user/'+this.$route.params.id+'/profile')
      this.user = data
    },
  }
}
</script>
