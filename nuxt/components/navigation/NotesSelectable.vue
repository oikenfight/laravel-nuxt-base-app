<template>
  <v-list dense>
    <!-- New Note -->
    <v-row justify="center">
      <v-fab-transition v-if="notes(folder.noteIds)">
        <v-btn
          color="grey lighten-1"
          dark
          small
          right
          absolute
          fab
          @click="create"
        >
          <v-icon>mdi-note-plus</v-icon>
        </v-btn>
      </v-fab-transition>
    </v-row>

    <!-- Note List -->
    <v-col v-for="note in notes(folder.noteIds)" :key="note.id" class="">
      <v-card class="ma-2" outlined light @click="selectNote(note.id)">
        <v-card-subtitle class="py-0 my-0 mr-0 pr-0">
          {{ note.name }}
        </v-card-subtitle>
        <v-card-text class="text--primary">
          {{ note.name }}
        </v-card-text>
      </v-card>
    </v-col>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'NotesSelectable',
  props: ['folder'],
  computed: {
    ...mapGetters({
      notes: 'note/notes'
    })
  },
  mounted() {
    console.log(this.folder)
  },
  methods: {
    ...mapActions({}),
    selectNote(noteId) {
      this.$router.push('/note/' + noteId)
    },
    create() {
      this.$store.dispatch('note/create', { folder: this.folder }) // ノートを作成
    }
  }
}
</script>

<style scoped></style>
