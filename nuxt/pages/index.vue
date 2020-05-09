<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="10">
        <v-row justify="center">
          <v-col cols="auto" class="display-2 pa-0">
            note
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="10">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="10">
        <NoteList :notes="notesReleased"></NoteList>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NoteList from '@/components/home/NoteList.vue'

export default {
  name: 'Index',
  components: { NoteList },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      notesReleased: 'note/notesReleased'
    })
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped></style>
