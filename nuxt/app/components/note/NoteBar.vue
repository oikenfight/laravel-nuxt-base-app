<template>
  <v-row class="d-flex justify-space-between">
    <!--  left content  -->
    <div class=""></div>

    <!-- center content -->
    <div class="display-1">note</div>

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
          <v-list-item @click="logout">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
          <v-list-item disabled>
            <v-list-item-title>Setting</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </div>
  </v-row>
</template>

<script>
export default {
  name: 'NoteBar',
  methods: {
    async logout() {
      try {
        await this.$store.dispatch('logout')
      } catch {
        console.log('logout error !!')
      }
      window.location.href = '/login'
    }
  }
}
</script>

<style scoped></style>
