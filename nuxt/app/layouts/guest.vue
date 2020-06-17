<template>
  <v-app id="">
    <!-- Content -->
    <v-content class="" app>
      <nuxt />
    </v-content>

    <!-- Footer -->
    <v-footer class="" app inset>
      <span class="">md-editor @oikawa</span>
    </v-footer>
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
