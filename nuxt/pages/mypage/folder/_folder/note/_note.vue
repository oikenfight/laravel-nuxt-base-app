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
        <ItemList :note="note"></ItemList>

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
import ButtonNewItem from '@/components/MyPage/Note/ButtonNewItem'
import ButtonsNoteAction from '@/components/MyPage/Note/ButtonsNoteAction'
import ItemList from '@/components/MyPage/Note/ItemList'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    NoteTitle,
    ButtonNewItem,
    ButtonsNoteAction,
    ItemList
  },
  data() {
    return {
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
      folderGetter: 'folder/folder',
      noteGetter: 'note/note',
      items: 'item/items'
    }),
    folder() {
      return this.folderGetter(this.$route.params.folder)
    },
    note() {
      return this.noteGetter(this.$route.params.note)
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
    select(item) {
      this.itemEdited = item
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
