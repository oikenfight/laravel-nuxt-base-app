export default function({ store, redirect }) {
  console.log('here is middleware auth.ja')
  console.log(store.getters.user)
  console.log(store.getters.isAuthenticated)
  if (!store.getters.isAuthenticated) {
    redirect('/login')
  }
}
