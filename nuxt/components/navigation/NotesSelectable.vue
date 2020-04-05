<template>
  <v-list dense class="float-left" width="125">
    <!-- New Note -->
    <v-row justify="center" style="height: 45px;">
      <v-fab-transition v-if="notes">
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
    <v-col v-for="note in notes" :key="note.id" class="ma-0 pa-0">
      <v-card class="ma-2" outlined light @click="selectNote(note.id)">
        <v-card-subtitle class="py-0 my-0 mr-0 pr-0">
          2019/12/31
        </v-card-subtitle>
        <v-card-text class="text--primary">
          <div>{{ note.name }}</div>
        </v-card-text>
      </v-card>
    </v-col>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'NotesSelectable',
  props: ['notes', 'folder'],
  computed: {
    ...mapGetters({}),
    notesSelectable() {
      return this.notes(this.folderSelected.noteIds)
    }
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
