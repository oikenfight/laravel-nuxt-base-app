<template>
  <v-menu open-on-hover bottom>
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
        { title: 'Add Folder', action: 'addFolder' },
        { title: 'Rename Folder', action: 'editFolder' },
        { title: 'Delete Folder', action: 'deleteFolder' }
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
        case 'addFolder':
          this.addFolder()
          break
        case 'editFolder':
          this.editFolder()
          break
        case 'deleteFolder':
          this.deleteFolder()
          break
      }
    },
    async addFolder() {
      const folder = await this.$store.dispatch('folder/create', {
        rack: this.rack
      })
      this.$store.dispatch('rack/addFolder', {
        rack: this.rack,
        folder
      })
    },
    editFolder() {
      this.$emit('editFolder', { folder: this.folder })
    },
    async deleteFolder() {
      await this.$store.dispatch('folder/delete', { folder: this.folder })
    }
  }
}
</script>

<style scoped></style>
