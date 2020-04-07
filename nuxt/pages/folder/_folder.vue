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
