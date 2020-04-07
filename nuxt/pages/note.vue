<template>
  <v-layout>
    <div v-if="folder" style="width: 140px">
      <!-- Notes -->
      <NotesSelectable :folder="folder"></NotesSelectable>
    </div>

    <div style="width: 100%">
      <nuxt-child></nuxt-child>
    </div>
  </v-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NotesSelectable from '@/components/navigation/NotesSelectable.vue'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    NotesSelectable
  },
  data() {
    return {
      note: {}
    }
  },
  computed: {
    ...mapGetters({
      folderId: 'folderIdSelected',
      rackId: 'rackIdSelected',
      noteVuex: 'note/note',
      folderVuex: 'folder/folder'
    }),
    folder() {
      return this.folderId ? this.folderVuex(this.folderId) : null
    }
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
