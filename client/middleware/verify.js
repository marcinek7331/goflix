export default function ({ redirect, store, route}) {
  if((route.path === '/rejestracja/krok-2' || route.path === '/rejestracja/krok-3') && store.getters['auth/user'].step == 'verified') {
    return redirect('/')
  }

  if(store.getters['auth/user'].step === 'verification') {
    if (route.path !== '/rejestracja/krok-2') {
      return redirect('/rejestracja/krok-2')
    }
  }
  if(store.getters['auth/user'].step === 'configuration') {
    if (route.path !== '/rejestracja/krok-3') {
      return redirect('/rejestracja/krok-3')
    }
  }
}
