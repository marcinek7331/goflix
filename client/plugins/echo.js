import LaravelEcho from "laravel-echo"
import Cookies from 'js-cookie'

export default ({ app, redirect }) => {

const token = Cookies.get('token')
window.Pusher = require('pusher-js');
window.Echo = new LaravelEcho({
  broadcaster: 'pusher',
      key: 'local',
      wsHost: 'goflix.marcinwas.pl',
      wsPath: '/sockets',
      disableStats: true,
      enabledTransports: ['ws', 'wss'],
      authEndpoint: 'api/broadcasting/auth',

    auth: {
        headers: {
            Authorization: null
        },
    },
})
}
