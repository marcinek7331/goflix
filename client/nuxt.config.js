require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')

module.exports = {
  ssr: true,
  server: {
    host: '0.0.0.0',
    port: 1337
  },
  srcDir: __dirname,

  env: {
    apiUrl: process.env.API_URL || process.env.APP_URL,
    appName: process.env.APP_NAME || 'Laravel Nuxt',
    appLocale: process.env.APP_LOCALE || 'pl',
    githubAuth: !!process.env.GITHUB_CLIENT_ID,
    facebookAuth: !!process.env.FACEBOOK_CLIENT_ID,
    googleAuth: !!process.env.GOOGLE_CLIENT_ID

  },

  head: {
    title: process.env.APP_NAME,
    titleTemplate: '%s | ' + process.env.APP_NAME,
    meta: [
      { charset: 'utf-8' },
      {'http-equiv':'Content-Security-Policy', content:'upgrade-insecure-requests'},
     { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Nuxt.js project' }
    ],
    link: [
      {rel: 'stylesheet', href: '//fonts.googleapis.com/css?family=Lato:400,700%7CMontserrat:400,600'},
      {rel: 'stylesheet', href: '/icons/iconsmind/styles.min.css'},
      { rel: 'icon', type: 'image/x-icon', href: '/favicon2.ico' }

    ],
    script: [
    { hid: 'stripe', src: 'https://content.jwplatform.com/libraries/KB5zFt7A.js', defer: true }
  ]
  },

  loading: {color: '#77B6FF',throttle: 0 },

  router: {
    middleware: ['locale', 'check-auth']
  },

  css: [
    { src: '~assets/css/bootstrap.min.css', lang: 'css' },
  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/nuxt-client-init',
    '~plugins/screen',
    '~plugins/youtube',
    '~plugins/range',
    '~plugins/lazyload',
    { src: '~/plugins/plyr', mode: 'client' },
    { src: '~/plugins/echo', ssr: false },
  ],

  modules: [
    '@nuxtjs/router',
    '@nuxtjs/moment'

  ],
  moment: {
    defaultLocale: 'pl',
    locales: ['pl']
  },
  build: {
    extractCSS: true,
    splitChunks: {
      layouts: true
    }
  },

  hooks: {
    generate: {
      done (generator) {
        // Copy dist files to public/_nuxt
        if (generator.nuxt.options.dev === false && generator.nuxt.options.mode === 'spa') {
          const publicDir = join(generator.nuxt.options.rootDir, 'public', '_nuxt')
          removeSync(publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '_nuxt'), publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '200.html'), join(publicDir, 'index.html'))
          removeSync(generator.nuxt.options.generate.dir)
        }
      }
    }
  }
}
