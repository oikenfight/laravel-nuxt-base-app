<template>
  <v-row justify="start">
    <v-card v-if="folder" class="ma-5" height="300" width="200" @click="create">
      <v-row justify="center" align-content="center" style="height: 100%;">
        <v-icon size="80" color="grey lighten-2">
          mdi-plus-circle-outline
        </v-icon>
      </v-row>
    </v-card>

    <v-card
      v-for="note in notes"
      :key="note.id"
      class="ma-5"
      height="300"
      width="200"
      @click="select(note)"
    >
      <v-img
        :src="require('@/assets/img/noimage.png')"
        class="white--text align-end"
        height="125px"
      ></v-img>
      <v-card-title
        class="pa-2 card-text-truncate"
        style="max-height: 90px; text-align: left;"
      >
        <span v-if="note.name">{{ note.name }}</span>
        <span v-else class="text--disabled">タイトル</span>
      </v-card-title>
      <v-card-text
        class="pa-2 text--primary card-text-truncate"
        style="max-height: 83px;"
      >
        {{ note.head_body }}
      </v-card-text>
      <v-card-actions
        class="pa-1 card-action-bottom"
        style="height: 40px; width: 100%"
      >
        <v-row justify="end" class="mr-2">
          <v-btn icon color="grey" disabled>
            <v-icon v-if="note.status === statusValues.true">
              mdi-lock-open-outline
            </v-icon>
            <v-icon v-else>mdi-lock-outline</v-icon>
          </v-btn>
          <v-btn icon color="grey" text disabled>
            <v-icon>mdi-share-variant</v-icon>
          </v-btn>
          <v-btn v-if="folder" icon color="red" @click.stop="remove(note)">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-row>
      </v-card-actions>
    </v-card>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'NoteList',
  props: {
    notes: Array,
    folder: Object,
    select: Function
  },
  data() {
    return {
      statusValues: {
        true: 1,
        false: 0
      }
    }
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    noteBody(note) {
      console.log(note.item_ids)
      return 'sample'
    },
    async create() {
      const note = await this.$store.dispatch('note/create', {
        folder: this.folder
      })
      this.$store.dispatch('folder/addNote', {
        folder: this.folder,
        note
      })
    },
    remove(note) {
      this.$store.dispatch('note/delete', { note })
    }
  }
}
</script>

<style scoped>
.card-text-truncate {
  overflow: hidden;
  width: 100%;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-height: 1.3;
}

.card-action-bottom {
  position: absolute;
  bottom: 0;
}
</style>
