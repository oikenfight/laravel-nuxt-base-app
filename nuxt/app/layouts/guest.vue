<template>
  <v-app id="" dark>
    <v-content app>
      <v-container fill-height>
        <v-layout wrap align-center>
          <nuxt />
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  middleware: 'guest',
  data() {
    return {
      goDark: true
    }
  },
  computed: {
    setTheme() {
      if (this.goDark === true) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        return (this.$vuetify.theme.dark = true)
      } else {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        return (this.$vuetify.theme.dark = false)
      }
    }
  },
  head() {}
}
</script>

<style scoped>
h1 {
  font-size: 20px;
}
</style>
