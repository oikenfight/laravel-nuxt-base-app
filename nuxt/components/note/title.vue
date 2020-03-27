<template>
  <!-- note name -->
  <v-row>
    <v-text-field v-model="note.name" outlined label="Note Title" type="text">
      <template v-slot:append>
        <v-btn class="ma-1" large color="" icon @click="clearTitle">
          <v-icon>mdi-close</v-icon>
        </v-btn>
        <v-btn class="ma-1" large color="" icon @click="updateTitle">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
      </template>
    </v-text-field>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Title',
  data() {
    return {
      note: {}
    }
  },
  computed: {
    ...mapGetters({
      noteVuex: 'note/note'
    })
  },
  mounted() {
    this.note = Object.assign({}, this.noteVuex(this.$route.params.note))
  },
  methods: {
    ...mapActions({}),
    clearTitle() {
      this.note.name = ''
    },
    updateTitle() {
      this.$store.dispatch('note/updateTitle', { note: this.note })
    }
  }
}
</script>

<style scoped></style>
