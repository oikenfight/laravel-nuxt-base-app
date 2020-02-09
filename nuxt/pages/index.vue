<template>
  <v-container>
    <!-- noteId がセットされている（selectNote されている）場合 -->
    <v-row v-if="noteId" align="start" justify="center">
      <v-col cols="11">
        <!-- note name -->
        <v-row>
          <v-text-field
            v-model="noteEdited.name"
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
        <v-divider />
        <!-- note body -->
        <v-row v-for="itemId in note(noteId).itemIds" :key="itemId">
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
                <v-btn small @click="deleteItem(itemId)">
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
        <v-divider />
        <!-- new item -->
        <v-row justify="center" style="height: 20px; position: relative">
          <v-fab-transition>
            <v-btn
              color="grey lighten-1"
              dark
              right
              absolute
              bottom
              fab
              @click="addItem"
            >
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </v-fab-transition>
        </v-row>
      </v-col>
    </v-row>
    <!-- noteId がセットされていない（ selectNoteされていない）場合 -->
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
      activeItemId: null, // item の mouseover/mouseout でセット
      noteEdited: {}, // 編集中 Note
      itemEdited: {} // 編集中 Item
    }
  },
  computed: {
    ...mapGetters({
      noteId: 'notes/noteId', // selectNote メソッドでセットされる
      note: 'notes/note', // noteId を引数にして、Note オブジェクトを取得
      item: 'notes/item' // itemId を引数に、Item オブジェクトを取得
    })
  },
  watch: {
    noteId() {
      this.noteEdited = this.noteId
        ? Object.assign({}, this.note(this.noteId))
        : ''
    }
  },
  mounted() {
    this.initItemEdited()
  },
  methods: {
    ...mapActions({}),
    clearTitle() {
      this.noteEdited.name = ''
    },
    updateTitle() {
      const newNoteTitle = this.noteEdited.name
      this.$store.dispatch('notes/updateTitle', newNoteTitle)
    },
    addItem() {
      this.$store.dispatch('notes/addItem')
      // 新規追加された item の ID を取得
      const newItemId = this.noteEdited.itemIds.slice(-1)[0]
      this.initItemEdited(newItemId)
    },
    editItem(itemId) {
      this.itemEdited.id = itemId
      this.itemEdited.body = this.item(itemId)
    },
    updateItem() {
      this.$store.dispatch('notes/updateItem', this.itemEdited)
      this.initItemEdited()
    },
    deleteItem(itemId) {
      const deleteItemId = itemId
      this.$store.dispatch('notes/deleteItem', deleteItemId)
      this.initItemEdited()
    },
    initNoteEdited(id = null, name = null, itemId = []) {
      this.noteEdited = { id, name, itemId }
    },
    initItemEdited(id = null, body = null) {
      this.itemEdited = { id, body }
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #eeeeee;
}
</style>
