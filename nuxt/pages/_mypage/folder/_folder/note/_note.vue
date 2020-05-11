<template>
  <v-card height="100%">
    <!-- ButtonNoteAction -->
    <v-row ref="fixedHeight">
      <v-col cols="12" class="pa-0">
        <ButtonsNoteAction :note-edited="note"></ButtonsNoteAction>
      </v-col>

      <!-- NoteTitle -->
      <v-col cols="12" class="pa-0">
        <v-row justify="center">
          <v-col cols="10" class="pa-0">
            <NoteTitle :note-edited="note"></NoteTitle>
          </v-col>
        </v-row>
      </v-col>

      <!-- divider -->
      <v-col cols="11" class="px-5">
        <v-divider></v-divider>
      </v-col>
    </v-row>

    <!-- Note Body -->
    <v-layout
      id="scroll-note"
      class="overflow-y-auto"
      :style="scrollWindowStyle"
    >
      <v-row
        v-scroll:#scroll-note=""
        align="center"
        justify="center"
        style="width: 100%"
        class="ma-4"
      >
        <!-- Display Note Contents -->
        <v-col
          v-for="(item, index) in items(note.item_ids)"
          :key="item.id"
          cols="12"
          class="pa-0"
          @click="select(item)"
        >
          <v-row>
            <!-- ButtonItemMenu -->
            <v-col cols="1" class="pa-0">
              <ButtonItemMenu
                :item="item"
                :should-show-item-menu="shouldShowItemMenu"
              ></ButtonItemMenu>
            </v-col>
            <!-- ItemEdit if this is selected -->
            <v-col v-if="isEditing(item)" cols="10" class="pa-0">
              <ItemEdit
                :item-edited="itemEdited"
                @updatedItem="updatedItem"
                @moveNextItem="moveNextItem(index)"
              ></ItemEdit>
            </v-col>
            <!-- ItemShow if this is not selected-->
            <v-col v-else cols="10" class="pa-0">
              <ItemShow :item="item" style="min-height: 48px"></ItemShow>
            </v-col>
          </v-row>
        </v-col>

        <!-- divider -->
        <v-col cols="12">
          <v-divider></v-divider>
        </v-col>

        <!-- ButtonNewItem -->
        <v-col cols="12" class="pa-0">
          <ButtonNewItem
            :note="note"
            style="height: 60px;"
            @addItem="addedItem"
          ></ButtonNewItem>
        </v-col>
      </v-row>
    </v-layout>
  </v-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NoteTitle from '@/components/MyPage/Note/NoteTitle.vue'
import ItemEdit from '@/components/MyPage/Note/ItemEdit.vue'
import ItemShow from '@/components/MyPage/Note/ItemShow.vue'
import ButtonItemMenu from '@/components/MyPage/Note/ButtonItemMenu'
import ButtonNewItem from '@/components/MyPage/Note/ButtonNewItem'
import ButtonsNoteAction from '@/components/MyPage/Note/ButtonsNoteAction'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    ItemEdit,
    ItemShow,
    NoteTitle,
    ButtonItemMenu,
    ButtonNewItem,
    ButtonsNoteAction
  },
  data() {
    return {
      itemIdActive: null, // item の mouseover/mouseout でセット
      itemEdited: null, // 編集中 Item
      refs: {
        componentHeight: 0,
        fixedHeight: 0
      }
    }
  },
  computed: {
    ...mapGetters({
      user: 'user', // ログインユーザ
      folderVuex: 'folder/folder',
      noteVuex: 'note/note',
      itemVuex: 'item/item',
      items: 'item/items'
    }),
    folder() {
      return this.folderVuex(this.$route.params.folder)
    },
    note() {
      return this.noteVuex(this.$route.params.note)
    },
    scrollWindowStyle() {
      return {
        width: '100%',
        'max-height': 'calc(100% - ' + this.refs.fixedHeight + 'px)'
      }
    }
  },
  mounted() {
    this.refs.fixedHeight = this.$refs.fixedHeight.clientHeight
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.note })
    },
    async addedItem() {
      const item = await this.$store.dispatch('item/create', {
        note: this.note
      })
      this.$store.dispatch('note/addItem', {
        note: this.note,
        item
      })
      this.itemEdited = item
    },
    editingItem({ item }) {
      this.itemIdEdited = item.id
    },
    updatedItem() {
      this.itemEdited = null
    },
    moveNextItem(index) {
      if (index < this.note.item_ids.length - 1) {
        // 次の item がある場合、その item の編集に移行
        const nextItemId = this.note.item_ids[index + 1]
        this.itemEdited = this.itemVuex(nextItemId)
      } else {
        // 一番最後の item の場合、次の item を作成する
        this.addedItem()
      }
    },
    select(item) {
      this.itemEdited = item
    },
    isEditing(item) {
      return (
        this.itemEdited &&
        Object.prototype.hasOwnProperty.call(this.itemEdited, 'id') &&
        this.itemEdited.id === item.id
      )
    },
    shouldShowItemMenu(item) {
      return this.isEditing(item) && item.body === ''
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
