<template>
  <v-row>
    <p>Googleへリダイレクトしています</p>
  </v-row>
</template>

<script>
// import axios from 'axios'

export default {
  layout: 'guest',
  name: 'Redirect',
  asyncData({ app, error }) {
    return app.$axios
      .get('/api/auth/google')
      .then((response) => {
        return { authUrl: response.data.redirect_url }
      })
      .catch((e) => {
        error({ message: e.message, statusCode: e.statusCode })
      })
  },
  mounted() {
    window.location.href = this.authUrl
  }
}
</script>

<style scoped></style>
