<template>
  <v-container>
    <!-- noteId がセットされている（selectNote されている）場合 -->
    <v-row v-if="noteId" align="start" justify="center">
      <v-col cols="11"></v-col>
    </v-row>
    <!-- noteId がセットされていない（ selectNoteされていない）場合 -->
    <v-row v-else>
      open note !!
    </v-row>
  </v-container>
</template>

<script>
export default {
  layout: 'default',
  middleware: 'auth',
  components: {},
  data() {
    return {}
  },
  mounted() {
    this.initItemEdited()
  },
  methods: {}
}
</script>

<style scoped></style>
