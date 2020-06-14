<template>
  <v-row style="margin-right: 30px;">
    <!--  left content  -->
    <v-col cols="12">
      <v-row justify="end">
        <v-switch
          v-model="input.status"
          :true-value="statusValues.true"
          :false-value="statusValues.false"
          :label="statusMessage"
          style="margin: 0 20px 0 0"
          @change="updateNoteStatus"
        >
        </v-switch>

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
    </v-col>
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
      input: {
        category: {},
        status: null
      },
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
      this.input.status = this.note.status
    }
  },
  mounted() {
    this.note = Object.assign({}, this.noteEdited)
    // ステータスの初期値をセット
    this.input.status = this.note.status
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.noteEdited })
      this.$router.push('/folder/' + this.$route.params.folder)
    },
    updateNoteStatus() {
      console.log('updateNoteStatus method')
      this.note.status = this.input.status
      this.$store.dispatch('note/update', { note: this.note })
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

<style>
.v-text-field {
  padding-top: 4px;
  margin-top: 4px;
}
</style>
