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
  async mounted() {
    try {
      const callbackData = await this.$axios.$get('/api/auth/google/callback', {
        params: this.$route.query
      })
      console.log(callbackData)
      this.setToken({ token: callbackData.token })
      this.setUser({ user: callbackData.user })

      this.$router.push('/')
    } catch (error) {
      this.failedMessage = error.message
    }
  },
  methods: mapMutations(['setToken', 'setUser'])
}
</script>
