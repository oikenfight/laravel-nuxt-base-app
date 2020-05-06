<template>
  <v-row justify="end" style="margin-right: 30px;">
    <div>
      <v-switch
        v-model="status"
        :true-value="statusValues.true"
        :false-value="statusValues.false"
        :label="statusMessage"
        style="margin: 0 20px 0 0"
      >
      </v-switch>
    </div>

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
  props: {
    noteEdited: Object
  },
  data() {
    return {
      note: {},
      status: null,
      statusValues: {
        true: 1,
        false: 0
      },
      statusMessages: {
        true: '公開中',
        false: '下書き'
      }
    }
  },
  computed: {
    ...mapGetters({}),
    statusMessage() {
      return this.note.status === 1
        ? this.statusMessages.true
        : this.statusMessages.false
    }
  },
  watch: {
    noteEdited(val, oldVal) {
      this.note = Object.assign({}, this.noteEdited)
      this.status = this.note.status
    },
    status(val, old) {
      this.note.status = this.status
      this.$store.dispatch('note/update', { note: this.note })
    }
  },
  mounted() {
    this.note = Object.assign({}, this.noteEdited)
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.noteEdited })
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
