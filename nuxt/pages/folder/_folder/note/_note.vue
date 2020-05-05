<template>
  <v-card height="100%">
    <!-- note action buttons -->
    <v-col cols="12">
      <ButtonsNoteAction :note="note"></ButtonsNoteAction>
    </v-col>

    <!-- note title-->
    <v-col cols="12">
      <NoteTitle :noteEdited="note"></NoteTitle>
    </v-col>

    <v-divider></v-divider>

    <v-layout
      id="scroll-note"
      class="overflow-y-auto"
      style="max-height: calc(100% - 150px); width: 100%"
    >
      <v-row
        v-scroll:#scroll-note=""
        align="center"
        justify="center"
        style="width: 100%"
        class="ma-0"
      >
        <!--        <v-col-->
        <!--          v-for="item in items(note.item_ids)"-->
        <!--          :key="item.id"-->
        <!--          cols="12"-->
        <!--          @mouseenter="itemIdActive = itemId"-->
        <!--          @mouseleave="itemIdActive = null"-->
        <!--        >-->
        <v-col
          v-for="(item, index) in items(note.item_ids)"
          :key="item.id"
          cols="12"
          @click="select(item)"
        >
          <v-row>
            <!-- item menu -->
            <v-col cols="1" class="pa-0">
              <v-row
                v-if="shouldShowItemMenu(item)"
                justify="center"
                align="end"
              >
                <v-btn color="grey lighten-1" x-small fab>
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </v-row>
            </v-col>
            <!-- item edit if this is selected -->
            <v-col v-if="isEditing(item)" cols="10" class="pa-0">
              <ItemEdit
                :item-edited="itemEdited"
                @updatedItem="updatedItem"
                @moveNextItem="moveNextItem(index)"
              ></ItemEdit>
            </v-col>
            <!-- item show if this is not selected-->
            <v-col v-else cols="10" class="pa-0">
              <ItemShow :item="item"></ItemShow>
            </v-col>
          </v-row>
        </v-col>
        <!--        <v-col-->
        <!--          v-for="itemId in note.item_ids"-->
        <!--          :key="itemId"-->
        <!--          cols="12"-->
        <!--          :class="{ itemSelected: itemIdActive === itemId }"-->
        <!--          @mouseenter="itemIdActive = itemId"-->
        <!--          @mouseleave="itemIdActive = null"-->
        <!--        >-->
        <!--          &lt;!&ndash; アイテム編集コンポーネント &ndash;&gt;-->
        <!--          <ItemEdit-->
        <!--            v-if="itemIdEdited === itemId"-->
        <!--            :item-id="itemIdEdited"-->
        <!--            @updatedItem="updatedItem"-->
        <!--          ></ItemEdit>-->

        <!--          &lt;!&ndash; アイテム表示コンポーネント &ndash;&gt;-->
        <!--          <ItemShow-->
        <!--            v-else-->
        <!--            :note="note"-->
        <!--            :item-id="itemId"-->
        <!--            :is-active="itemIdActive === itemId"-->
        <!--            @edit="editingItem"-->
        <!--          ></ItemShow>-->
        <!--        </v-col>-->
      </v-row>
    </v-layout>

    <v-divider></v-divider>

    <!-- new item -->
    <ButtonNewItem
      :note="note"
      style="height: 60px;"
      @addItem="addedItem"
    ></ButtonNewItem>
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
    ItemEdit,
    ItemShow,
    NoteTitle,
    ButtonNewItem,
    ButtonsNoteAction
  },
  data() {
    return {
      itemIdActive: null, // item の mouseover/mouseout でセット
      itemEdited: null // 編集中 Item
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
    }
  },
  mounted() {
    console.log(this.items(this.note.item_ids))
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
