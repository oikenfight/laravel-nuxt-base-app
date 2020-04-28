<template>
  <!-- note name -->
  <div>
    <v-text-field v-model="noteLocal.name" outlined label="Title" type="text">
      <template v-slot:append>
        <v-btn class="ma-1" large color="" icon @click="clearTitle">
          <v-icon>mdi-close</v-icon>
        </v-btn>
        <v-btn class="ma-1" large color="" icon @click="update">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
      </template>
    </v-text-field>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Title',
  props: ['note'],
  data() {
    return {
      noteLocal: {}
    }
  },
  computed: {
    ...mapGetters({})
  },
  watch: {
    note(val, oldVal) {
      this.noteLocal = Object.assign({}, this.note)
    }
  },
  methods: {
    ...mapActions({}),
    clearTitle() {
      this.note.name = ''
    },
    update() {
      this.$store.dispatch('note/update', { note: this.noteLocal })
    }
  }
}
</script>

<style scoped></style>
