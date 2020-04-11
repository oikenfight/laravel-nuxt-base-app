<template>
  <v-row justify="end">
    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

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
  </v-row>
</template>

<script>
export default {
  name: 'Menu',
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
