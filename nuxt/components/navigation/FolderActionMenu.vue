<template>
  <v-menu open-on-hover bottom>
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon x-small>mdi-dots-vertical</v-icon>
      </v-btn>
    </template>

    <v-list>
      <v-list-item
        v-for="(menu, index) in menusFolder"
        :key="index"
        dense
        @click="menu.action"
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
  props: ['folder'],
  data() {
    return {
      menus: [
        { title: 'Add Folder', action: 'addFolder' },
        { title: 'Rename Folder', action: 'renameFolder' },
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
        case 'renameFolder':
          this.renameFolder()
          break
        case 'deleteFolder':
          this.deleteFolder()
          break
      }
    }
  }
}
</script>

<style scoped></style>
