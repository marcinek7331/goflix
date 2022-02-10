import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [

  { path: '/logowanie', name: 'login', component: page('auth/login.vue') },
  { path: '/rejestracja/krok-1', name: 'register', component: page('auth/register.vue') },
  { path: '/rejestracja/krok-2', name: 'register-2', component: page('auth/register-2.vue') },
  { path: '/rejestracja/krok-3', name: 'register-3', component: page('auth/register-3.vue') },
  { path: '/faq', name: 'faq', component: page('faq.vue') },

  { path: '/admin/weryfikacja', name: 'admin-verify', component: page('admin/verify.vue') },

  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/wyszukiwarka/', name: 'search', component: page('search.vue') },
  { path: '/odtwarzacz', name: 'player', component: page('player.vue') },

  { path: '/dashboard', name: 'dashboard', component: page('dashboard/index.vue') },
  { path: '/dashboard/movies', name: 'dashboard.movies', component: page('dashboard/movies.vue') },
  { path: '/dashboard/users', name: 'dashboard.users', component: page('dashboard/users.vue') },
  { path: '/dashboard/edit/user/:id', name: 'dashboard.edit.user', component: page('dashboard/edit/user.vue') },

  {
    path: '/znajomi',
    name: 'friends',
    component: page('friends.vue'),
    // children: [
    //   { path: '', redirect: { name: 'settings.profile' } },
    //   { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
    //   { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    // ]
  },

  { path: '/', alias: '/filmy', name: 'home', component: page('movies.vue') },
  { path: '/seriale' , name: 'tvshows', component: page('tvshows.vue') },

  { path: '/moj-profil', name: 'profile', component: page('profile/index.vue') },
  { path: '/profil/:id', name: 'profile.show', component: page('profile/show.vue') },



  { path: "*", redirect: '/' },
  {
    path: '/ustawienia',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  }
]

export function createRouter () {
  return new Router({
    routes,
    linkExactActiveClass: 'current-menu-item',
    linkActiveClass: 'sidebar__nav-link--active',
    scrollBehavior,
    mode: 'history'
  })
}
