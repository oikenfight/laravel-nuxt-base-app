<template>
  <v-card height="100%" width="100%">
    <!-- New Note -->
    <v-card-title>
      <v-fab-transition v-if="notes(folder.note_ids)">
        <v-btn color="grey lighten-1" small right absolute fab @click="add">
          <v-icon>mdi-note-plus</v-icon>
        </v-btn>
      </v-fab-transition>
    </v-card-title>

    <v-divider></v-divider>

    <!-- Note List -->
    <v-layout
      id="scroll-noteSelectable"
      class="overflow-y-auto"
      style="max-height: 100%;"
    >
      <v-row
        v-scroll:#scroll-noteSelectable=""
        align="center"
        justify="center"
        style="margin: 0"
      >
        <v-list>
          <v-list-item
            v-for="note in notes(folder.note_ids)"
            :key="note.id"
            style="padding: 0"
          >
            <v-card
              class="mx-auto ma-2"
              light
              height="90px"
              width="95px"
              @click="selectNote(note.id)"
            >
              <div class="overline text-truncate" style="width: 100%">
                {{ note.updated_at }}
              </div>
              <v-card-title class="pa-1 subtitle-2">
                {{ note.name }}
              </v-card-title>
            </v-card>
          </v-list-item>
        </v-list>
      </v-row>
    </v-layout>
  </v-card>
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
  methods: {
    ...mapActions({}),
    selectNote(noteId) {
      this.$router.push('/folder/' + this.folder.id + '/note/' + noteId)
    },
    async add() {
      const note = await this.$store.dispatch('note/create', {
        folder: this.folder
      })
      this.$store.dispatch('folder/addNote', {
        folder: this.folder,
        note
      })
    }
  }
}
</script>

<style scoped></style>
