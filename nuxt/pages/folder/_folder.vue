<template>
  <v-layout fill-height>
    <!-- scrollable height: ウィンドウの高さ - フッターの高さ -->
    <v-flex style="width: 140px; height: calc(100vh - 36px);">
      <NotesSelectable :folder="folder"></NotesSelectable>
    </v-flex>

    <!-- scrollable height: ウィンドウの高さ - フッターの高さ -->
    <v-flex style="width: 100%; height: calc(100vh - 36px);">
      <nuxt-child></nuxt-child>
    </v-flex>
  </v-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import NotesSelectable from '@/components/note/NotesSelectable.vue'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    NotesSelectable
  },
  data() {
    return {
      folder: {}
    }
  },
  computed: {
    ...mapGetters({
      folderVuex: 'folder/folder'
    })
  },
  mounted() {
    this.folder = this.folderVuex(this.$route.params.folder)
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
