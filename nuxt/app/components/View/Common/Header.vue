<template>
  <v-row class="d-flex justify-space-between">
    <!--  left content  -->
    <div class=""></div>

    <!-- center content -->
    <div class="display-1" @click="top()">{{ title }}</div>

    <!-- right content -->
    <div class="space-between" style="margin-right: 10px">
      <!-- 検索ボタン -->
      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <!-- 設定メニューボタン -->
      <v-menu bottom left>
        <template v-slot:activator="{ on }">
          <v-btn icon color="" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item v-if="user" @click="logout">
            <v-list-item-title>ログアウト</v-list-item-title>
          </v-list-item>
          <v-list-item v-else @click="login">
            <v-list-item-title>ログイン</v-list-item-title>
          </v-list-item>
          <v-list-item @click="mypage">
            <v-list-item-title>マイページ</v-list-item-title>
          </v-list-item>
          <v-list-item disabled>
            <v-list-item-title>設定</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Header',
  data() {
    return {
      title: 'Logagin'
    }
  },
  computed: {
    ...mapGetters({
      user: 'user'
    })
  },
  methods: {
    ...mapActions({}),
    async logout() {
      try {
        await this.$store.dispatch('logout')
      } catch {
        console.log('logout error !!')
      }
    },
    login() {
      this.$router.push('/auth/login')
    },
    top() {
      this.$router.push('/')
    },
    mypage() {
      this.$router.push('/mypage')
    }
  }
}
</script>

<style scoped></style>
