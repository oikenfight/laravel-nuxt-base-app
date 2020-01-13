<template>
  <v-container fluid class="grey lighten-5" style="height: 100%;">
    <v-row v-if="note" align="start" justify="center">
      <v-col cols="11">
        <!-- note title -->
        <v-row>
          <v-text-field
            v-model="noteTitle"
            outlined
            label="Note Title"
            type="text"
          >
            <template v-slot:append>
              <v-btn class="ma-1" large color="grey" icon @click="clearTitle">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-btn class="ma-1" large color="grey" icon @click="updateTitle">
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
            </template>
          </v-text-field>
        </v-row>
        <!-- note body -->
        <v-row v-for="itemId in note.itemIds" :key="itemId">
          <v-col
            cols="12"
            :class="{ itemSelected: activeItemId === itemId }"
            @mouseenter="activeItemId = itemId"
            @mouseleave="activeItemId = null"
          >
            <!-- item body -->
            <!-- edit -->
            <div v-if="itemEdited.id === itemId">
              <v-textarea
                v-model="itemEdited.body"
                label="item body"
                auto-grow
                outlined
                rows="3"
                row-height="15"
              >
                <template v-slot:append-outer>
                  <v-btn class="ma-1" color="grey" icon @click="updateItem">
                    <v-icon>mdi-send</v-icon>
                  </v-btn>
                </template>
              </v-textarea>
            </div>
            <!-- display -->
            <div v-else>
              <!-- action buttons -->
              <v-btn-toggle v-if="activeItemId === itemId" class="float-right">
                <v-btn small @click="editItem(itemId)">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
                <v-btn small>
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
                <v-btn small>
                  <v-icon>mdi-dots-horizontal</v-icon>
                </v-btn>
              </v-btn-toggle>
              <div class="ma-1" v-html="$md.render(item(itemId))"></div>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>

    <v-row v-else>
      open note !!
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  layout: 'defualt',
  components: {},
  data() {
    return {
      noteTitle: '', // タイトルフォームと bind
      activeItemId: null, // item の mouseover/mouseout でセット
      itemEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      note: 'notes/note',
      item: 'notes/item'
    })
  },
  watch: {
    note() {
      this.noteTitle = this.note.title ? this.note.title : ''
    }
  },
  mounted() {
    this.initItemEdited()
  },
  methods: {
    ...mapActions({}),
    clearTitle() {
      this.noteTitle = ''
    },
    updateTitle() {
      const newNoteTitle = this.noteTitle
      this.$store.dispatch('notes/updateTitle', newNoteTitle)
    },
    editItem(itemId) {
      this.itemEdited.id = itemId
      this.itemEdited.body = this.item(itemId)
    },
    updateItem() {
      this.$store.dispatch('notes/updateItem', this.itemEdited)
      this.initItemEdited()
    },
    initItemEdited() {
      this.itemEdited = { id: null, body: null }
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #eeeeee;
}
</style>
