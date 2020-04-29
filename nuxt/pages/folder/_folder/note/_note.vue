<template>
  <v-card height="100%">
    <!-- note action buttons -->
    <v-col cols="12">
      <ButtonsNoteAction :note="note"></ButtonsNoteAction>
    </v-col>

    <!-- note title-->
    <NoteTitle :note="note" style="height: 90px"></NoteTitle>

    <v-divider></v-divider>

    <v-layout
      id="scroll-note"
      class="overflow-y-auto"
      style="max-height: calc(100% - 150px);"
    >
      <v-row
        v-scroll:#scroll-note=""
        align="center"
        justify="center"
        style="width: 100%"
      >
        <v-col
          v-for="itemId in note.item_ids"
          :key="itemId"
          cols="12"
          :class="{ itemSelected: itemIdActive === itemId }"
          @mouseenter="itemIdActive = itemId"
          @mouseleave="itemIdActive = null"
        >
          <!-- アイテム編集コンポーネント -->
          <ItemEdit
            v-if="itemIdEdited === itemId"
            :item-id="itemIdEdited"
            @updatedItem="updatedItem"
          ></ItemEdit>

          <!-- アイテム表示コンポーネント -->
          <ItemShow
            v-else
            :note="note"
            :item-id="itemId"
            :is-active="itemIdActive === itemId"
            @edit="editingItem"
          ></ItemShow>
        </v-col>
      </v-row>
    </v-layout>

    <v-divider></v-divider>

    <!-- new item -->
    <ButtonNewItem :note="note" style="height: 60px;"></ButtonNewItem>
  </v-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NoteTitle from '@/components/note/Title.vue'
import ItemEdit from '@/components/note/ItemEdit.vue'
import ItemShow from '@/components/note/ItemShow.vue'
import ButtonNewItem from '@/components/note/ButtonNewItem'
import ButtonsNoteAction from '@/components/note/ButtonsNoteAction'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    NoteTitle,
    ItemEdit,
    ItemShow,
    ButtonNewItem,
    ButtonsNoteAction
  },
  data() {
    return {
      itemIdActive: null, // item の mouseover/mouseout でセット
      itemIdEdited: null // 編集中 Item
    }
  },
  computed: {
    ...mapGetters({
      user: 'user', // ログインユーザ
      folderVuex: 'folder/folder',
      noteVuex: 'note/note'
    }),
    folder() {
      return this.folderVuex(this.$route.params.folder)
    },
    note() {
      return this.noteVuex(this.$route.params.note)
    },
    item(itemId) {
      return this.itemVuex(itemId)
    }
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.note })
    },
    addedItem({ item }) {
      this.itemIdEdited = item.id
    },
    editingItem({ item }) {
      this.itemIdEdited = item.id
    },
    updatedItem() {
      this.itemIdEdited = null
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
