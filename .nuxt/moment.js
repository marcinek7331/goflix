import moment from 'moment'

import 'moment/locale/pl'

moment.locale('pl')

export default (ctx, inject) => {
  ctx.$moment = moment
  inject('moment', moment)
}
