<template>
  <v-row justify="center" align="end">
    <v-col cols="12" class="pa-3 text-center">
      <v-btn color="grey lighten-1" x-small fab>
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'ButtonItemMenu',
  props: {
    item: Object,
    shouldShowItemMenu: Function
  },
  data() {
    return {}
  }
}
</script>

<style scoped></style>
