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
        { title: 'Add Folder', action: 'add' },
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
        case 'add':
          this.add()
          break
        case 'edit':
          this.edit()
          break
        case 'delete':
          this.delete()
          break
      }
    },
    async add() {
      const folder = await this.$store.dispatch('folder/create', {
        rack: this.rack
      })
      this.$store.dispatch('rack/addFolder', {
        rack: this.rack,
        folder
      })
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
