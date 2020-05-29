<template>
  <!-- note name -->
  <v-row align="center" justify="center">
    <!-- タイトル表示 -->
    <v-col v-if="!isEditing" cols="12" class="pa-0" @click="toggleEdit">
      <div v-if="note.name" class="display-1">
        {{ note.name }}
      </div>
      <div v-else class="display-1 grey--text">
        Title
      </div>
    </v-col>
    <!-- タイトル編集中 -->
    <v-col v-else cols="12" class="pa-0">
      <v-text-field
        v-model="note.name"
        label="Title"
        single-line
        hide-details
        height="60px"
        class="display-1 textfield-title pa-0"
        style="margin-top: -20px"
        @compositionstart="composing = true"
        @compositionend="composing = false"
        @keydown.enter.exact.prevent
        @keydown.enter.exact="update"
      >
        <template v-slot:append>
          <v-btn class="ma-1" large color="" icon @click="clearTitle">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </template>
      </v-text-field>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Title',
  props: {
    noteEdited: Object
  },
  data() {
    return {
      note: {},
      isEditing: false,
      composing: false // 変換中true
    }
  },
  computed: {
    ...mapGetters({})
  },
  watch: {
    noteEdited(val, oldVal) {
      this.note = Object.assign({}, this.noteEdited)
      this.isEditing = false
    }
  },
  mounted() {
    this.note = Object.assign({}, this.noteEdited)
  },
  methods: {
    ...mapActions({}),
    toggleEdit() {
      this.isEditing = !this.isEditing
    },
    clearTitle() {
      this.note.name = ''
    },
    update(event) {
      // keyupイベントだと変換中かどうか判定できないので、keydownイベントで実行してる
      // composing フラグで変換中か確認してから update する
      if (!this.composing) {
        this.$store.dispatch('note/update', { note: this.note })
        this.toggleEdit()
      }
    }
  }
}
</script>

<style>
.textfield-title {
  margin: -5px 0 0 0;
  padding: 0;
}
.v-input input {
  max-height: 60px !important;
  padding: 0;
}
</style>
