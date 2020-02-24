<template>
  <div class="column is-6 is-offset-3 is-centered" style="margin-top: 5em;">
    <div class="card">
      <div class="card-content has-text-centered">
        <p class="title is-6">
          ソーシャルアカウントでログインする
        </p>
        <p v-if="attempting">Googleでログインを行っています。。。</p>
        <p v-else>Googleでのログインに失敗しました！</p>
        <p>{{ failedMessage }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
  layout: 'guest',
  data() {
    return {
      failedMessage: null
    }
  },

  computed: {
    attempting() {
      return !this.failedMessage
    }
  },

  mounted() {
    this.$axios
      .get('http://localhost:8080/api/auth/google/callback', {
        params: this.$route.query
      })
      .then((response) => {
        this.setUser(response.data.user)
        this.setToken(response.data.token)
        this.setLoggedIn(true)
        console.log('here is callback.vue then')
        console.log(this.$store.getters.user)
        console.log(this.$store.getters.isAuthenticated)

        this.$router.push('/')
      })
      .catch((error) => {
        this.failedMessage = error.message
      })
  },

  methods: mapMutations({
    setUser: 'setUser',
    setToken: 'setToken',
    setLoggedIn: 'setLoggedIn'
  })
}
</script>
