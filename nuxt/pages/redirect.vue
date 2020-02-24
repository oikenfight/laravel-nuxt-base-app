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
    // TODO なんでこれで動くん？？（ページ遷移では動作するけど、URL アクセスでは動かない）
    // SSR だとすると、localhost ではなく、nginx_api が正しいのでは。
    // ちなみに、nginx_api にすると、URL アクセスでは動作するが、ページ遷移ではネットワークエラーとなる
    return app.$axios
      .get('http://localhost:8080/api/auth/google')
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
