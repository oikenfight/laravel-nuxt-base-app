<template>
  <v-layout fill-height>
    <v-flex style="width: 140px; height: 75vh;">
      <NotesSelectable :folder="folder"></NotesSelectable>
    </v-flex>

    <v-flex style="width: 100%; height: 80vh;">
      <nuxt-child></nuxt-child>
    </v-flex>
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
