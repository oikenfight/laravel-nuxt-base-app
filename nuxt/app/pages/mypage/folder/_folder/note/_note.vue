<template>
  <div style="height: 100%;">
    <!-- ButtonNoteAction -->
    <v-row ref="fixedHeight">
      <v-col cols="6" class="py-0">
        <BreadCrumbs :breadcrumbs-items="breadcrumbsItems"></BreadCrumbs>
      </v-col>

      <v-col cols="6" class="pa-0">
        <ButtonsNoteAction :note-edited="note"></ButtonsNoteAction>
      </v-col>
    </v-row>

    <!-- Note Body -->
    <v-row id="scroll-note" class="overflow-y-auto" :style="scrollWindowStyle">
      <v-col cols="12">
        <v-row
          v-scroll:#scroll-note=""
          align="center"
          justify="center"
          style="width: 100%"
        >
          <!-- Attribute -->
          <v-col cols="11" offset="1" class="pb-0">
            <v-row justify="start">
              <v-col cols="7" class="pa-0">
                <NoteAttribute :note-edited="note"></NoteAttribute>
              </v-col>
            </v-row>
          </v-col>

          <!-- Title -->
          <v-col cols="11" offset="1" class="pb-2">
            <NoteTitle :note-edited="note"></NoteTitle>
          </v-col>

          <!-- divider -->
          <v-col cols="11" offset="1" class="pb-5 px-0">
            <v-divider></v-divider>
          </v-col>

          <v-col cols="12">
            <ItemList :note="note"></ItemList>
          </v-col>

          <!-- divider -->
          <v-col cols="11" offset="1">
            <v-divider></v-divider>
          </v-col>

          <!-- ButtonNewItem -->
          <v-col cols="11" offset="1" class="pa-0">
            <ButtonNewItem
              :note="note"
              style="height: 60px;"
              @addItem="addedItem"
            ></ButtonNewItem>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'
import ButtonsNoteAction from '@/components/MyPage/Note/ButtonsNoteAction'
import NoteAttribute from '@/components/MyPage/Note/NoteAttribute'
import NoteTitle from '@/components/MyPage/Note/NoteTitle.vue'
import ItemList from '@/components/MyPage/Note/ItemList'
import ButtonNewItem from '@/components/MyPage/Note/ButtonNewItem'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    BreadCrumbs,
    ButtonsNoteAction,
    NoteAttribute,
    NoteTitle,
    ItemList,
    ButtonNewItem
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
    breadcrumbsItems() {
      return [
        {
          text: 'Top',
          disabled: false,
          href: '/'
        },
        {
          text: 'My Page',
          disabled: false,
          href: '/mypage'
        },
        {
          text: this.folder && this.folder.name ? this.folder.name : 'no name',
          disabled: false,
          href: '/mypage/folder/' + this.$route.params.folder
        },
        {
          text: this.note && this.note.name ? this.note.name : 'no title',
          disabled: true,
          href:
            '/mypage/folder/' +
            this.$route.params.folder +
            '/note/' +
            this.$route.params.note
        }
      ]
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
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
