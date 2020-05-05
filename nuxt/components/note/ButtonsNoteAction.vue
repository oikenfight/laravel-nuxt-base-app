<template>
  <v-row justify="end" style="margin-right: 30px;">
    <!-- action buttons -->
    <v-item-group>
      <v-btn small color="red" dark @click="deleteNote">
        <v-icon>mdi-delete</v-icon>
      </v-btn>
      <!-- TODO: HTML にエクスポートできるようにする -->
      <v-btn disabled small @click="exportHtml">
        <v-icon>mdi-language-html5</v-icon>
      </v-btn>
      <!-- TODO: Markdown にエクスポートできるようにする -->
      <v-btn disabled small @click="exportMarkdown">
        <v-icon>mdi-markdown</v-icon>
      </v-btn>
    </v-item-group>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ButtonsNoteAction',
  props: ['note'],
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.note })
      this.$router.push('/folder/' + this.$route.params.folder)
    },
    exportHtml() {
      console.log('export HTML')
    },
    exportMarkdown() {
      console.log('export Markdown')
    }
  }
}
</script>

<style scoped></style>
