<template>
  <v-menu open-on-hover bottom offset-x right>
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon x-small>mdi-dots-vertical</v-icon>
      </v-btn>
    </template>

    <v-list>
      <v-list-item
        v-for="(menu, index) in menus"
        :key="index"
        dense
        @click="triggerClick(menu.action)"
      >
        <v-list-item-title>{{ menu.title }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'FolderActionMenu',
  props: ['rack', 'folder'],
  data() {
    return {
      menus: [
        { title: 'New Note', action: 'newNote' },
        { title: 'New Folder', action: 'new' },
        { title: 'Rename Folder', action: 'edit' },
        { title: 'Delete Folder', action: 'delete' }
      ]
    }
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    triggerClick(action) {
      switch (action) {
        case 'newNote':
          this.newNote()
          break
        case 'new':
          this.new()
          break
        case 'edit':
          this.edit()
          break
        case 'delete':
          this.delete()
          break
      }
    },
    async newNote() {
      const note = await this.$store.dispatch('note/create', {
        folder: this.folder
      })
      this.$store.dispatch('folder/addNote', {
        folder: this.folder,
        note
      })
    },
    async new() {
      const newFolder = await this.$store.dispatch('folder/create', {
        rack: this.rack
      })
      this.$store.dispatch('rack/addFolder', {
        rack: this.rack,
        folder: newFolder
      })
      this.$emit('edit', { folder: newFolder })
    },
    edit() {
      this.$emit('edit', { folder: this.folder })
    },
    async delete() {
      await this.$store.dispatch('folder/delete', { folder: this.folder })
    }
  }
}
</script>

<style scoped></style>
