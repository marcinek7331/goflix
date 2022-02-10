export default ({ store, redirect }) => {
  if (store.getters['auth/user'].role != 2) {
    return redirect('/')
  }
}
