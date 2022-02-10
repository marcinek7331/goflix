const middleware = {}

middleware['admin'] = require('../client/middleware/admin.js')
middleware['admin'] = middleware['admin'].default || middleware['admin']

middleware['auth'] = require('../client/middleware/auth.js')
middleware['auth'] = middleware['auth'].default || middleware['auth']

middleware['check-auth'] = require('../client/middleware/check-auth.js')
middleware['check-auth'] = middleware['check-auth'].default || middleware['check-auth']

middleware['guest'] = require('../client/middleware/guest.js')
middleware['guest'] = middleware['guest'].default || middleware['guest']

middleware['locale'] = require('../client/middleware/locale.js')
middleware['locale'] = middleware['locale'].default || middleware['locale']

middleware['verify'] = require('../client/middleware/verify.js')
middleware['verify'] = middleware['verify'].default || middleware['verify']

export default middleware
