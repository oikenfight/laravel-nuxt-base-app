<template>
  <v-card height="100%">
    <!-- New Note -->
    <v-card-title>
      <v-fab-transition v-if="notes(folder.note_ids)">
        <v-btn color="grey lighten-1" small right absolute fab @click="create">
          <v-icon>mdi-note-plus</v-icon>
        </v-btn>
      </v-fab-transition>
    </v-card-title>

    <v-divider></v-divider>

    <!-- Note List -->
    <v-layout
      id="scroll-noteSelectable"
      class="overflow-y-auto"
      style="max-height: 100%"
    >
      <v-row
        v-scroll:#scroll-noteSelectable=""
        align="center"
        justify="center"
        style="width: 100%"
      >
        <v-list>
          <v-list-item v-for="note in notes(folder.note_ids)" :key="note.id">
            <v-card
              class="ma-3"
              light
              height="90px"
              @click="selectNote(note.id)"
            >
              <v-card-text class="text-truncate" style="width: 95px">
                <div class="text-truncate">{{ note.updated_at }}</div>
                <p class="">
                  {{ note.name }}
                </p>
              </v-card-text>
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
    create() {
      this.$store.dispatch('note/create', { folder: this.folder }) // ノートを作成
    }
  }
}
</script>

<style scoped></style>
