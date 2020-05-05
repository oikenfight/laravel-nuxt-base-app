<template>
  <!-- note name -->
  <v-row align="center" justify="center">
    <!-- タイトル表示 -->
    <v-col v-if="!isEditing" cols="11" @click="toggleEdit">
      <div class="display-2">
        {{ note.name }}
      </div>
    </v-col>
    <!-- タイトル編集中 -->
    <v-col
      v-else
      cols="11"
      @keydown.enter.exact.prevent
      @keyup.enter.exact="update"
    >
      <v-text-field
        v-model="note.name"
        label="Title"
        single-line
        hide-details
        height="60px"
        class="display-2 textfield-title"
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
      isEditing: false
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
    update() {
      this.$store.dispatch('note/update', { note: this.note })
      this.toggleEdit()
    }
  }
}
</script>

<style scoped>
.textfield-title {
  margin: 0;
  padding: 0;
}
.v-input input {
  max-height: 60px;
}
</style>
