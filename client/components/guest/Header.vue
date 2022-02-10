<template>
  <header id="masthead-pro">
     <div class="container">
        <h1><router-link :to="{ name: 'home'}"><img src="~assets/images/logo.png" alt="Logo"></router-link></h1>
        <nav id="site-navigation-pro">
           <ul class="sf-menu">
              <li class="normal-item-pro">
                <router-link :to="{ name: 'home'}">Strona główna</router-link>
              </li>
              <li class="normal-item-pro">
                <router-link :to="{ name: 'faq'}">FAQs</router-link>
              </li>
           </ul>
        </nav>
        <div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>
        <div class="clearfix"></div>
     </div>
     <nav id="mobile-navigation-pro">
        <ul id="mobile-menu-pro">
           <li>
              <a href="#!">Strona główna</a>
           </li>
           <li>
              <a href="#!">FAQs</a>
           </li>
        </ul>
        <div class="clearfix"></div>
        <button class="btn btn-mobile-pro btn-green-pro noselect" data-toggle="modal" data-target="#LoginModal" role="button">Sign In</button>
     </nav>
  </header>
</template>
<script>

export default {
  name: 'Header',
}

</script>
