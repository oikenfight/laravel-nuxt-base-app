<template>
  <v-layout>
    <div style="width: 140px">
      <!-- Notes -->
      <NotesSelectable :folder="folder"></NotesSelectable>
    </div>
    <div style="width: 100%">
      <v-container>
        <!-- note title-->
        <NoteTitle></NoteTitle>

        <v-divider></v-divider>

        <!-- note body -->
        <v-row v-for="itemId in note.itemIds" :key="itemId">
          <v-col
            cols="12"
            :class="{ itemSelected: itemIdActive === itemId }"
            @mouseenter="itemIdActive = itemId"
            @mouseleave="itemIdActive = null"
          >
            <!-- アイテム編集コンポーネント -->
            <ItemEdit
              v-if="itemIdEdited === itemId"
              :itemId="itemIdEdited"
              @update="updatedItem"
            ></ItemEdit>

            <!-- アイテム表示コンポーネント -->
            <ItemShow
              v-else
              :itemId="itemId"
              :isActive="itemIdActive === itemId"
              @edit="editingItem"
            ></ItemShow>
          </v-col>
        </v-row>
      </v-container>

      <v-divider></v-divider>

      <!-- new item -->
      <ButtonNewItem @add="addedItem"></ButtonNewItem>
    </div>
  </v-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NotesSelectable from '@/components/navigation/NotesSelectable.vue'
import NoteTitle from '@/components/note/Title.vue'
import ItemEdit from '@/components/note/ItemEdit.vue'
import ItemShow from '@/components/note/ItemShow.vue'
import ButtonNewItem from '@/components/note/ButtonNewItem'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    NotesSelectable,
    NoteTitle,
    ItemEdit,
    ItemShow,
    ButtonNewItem
  },
  data() {
    return {
      note: {},
      folder: {},
      itemIdActive: null, // item の mouseover/mouseout でセット
      itemIdEdited: null // 編集中 Item
    }
  },
  computed: {
    ...mapGetters({
      user: 'user', // ログインユーザ
      noteVuex: 'note/note',
      folderVuex: 'folder/folder'
    })
  },
  mounted() {
    this.note = this.noteVuex(this.$route.params.note)
    this.folder = this.folderVuex(this.note.folder_id)
  },
  methods: {
    ...mapActions({}),
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
