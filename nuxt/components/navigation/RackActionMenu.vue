<template>
  <v-menu open-on-hover bottom offset-x right>
    <template v-slot:activator="{ on }">
      <v-btn icon v-on="on">
        <v-icon small>mdi-dots-vertical</v-icon>
      </v-btn>
    </template>

    <v-list>
      <v-list-item
        v-for="(menu, index) in menus"
        :key="index"
        dense
        @click="triggerClick(menu.action)"
      >
        <v-list-item-content>
          <v-list-item-title
            v-if="menu.title"
            v-text="menu.title"
          ></v-list-item-title>
          <v-subheader v-else pl-0 ml-0>{{ menu.target }}</v-subheader>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'RackActionMenu',
  props: ['rack'],
  data() {
    return {
      menus: [
        { target: 'Folder' },
        { title: 'Add Folder', action: 'addFolder' },
        { target: 'Rack' },
        { title: 'Add Rack', action: 'addRack' },
        { title: 'Rename Rack', action: 'renameRack' },
        { title: 'Delete Rack', action: 'deleteRack' }
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
        case 'addRack':
          this.addRack()
          break
        case 'renameRack':
          this.renameRack()
          break
        case 'deleteRack':
          this.deleteRack()
          break
        case 'addFolder':
          this.addFolder()
          break
      }
    },
    addRack() {
      this.$store.dispatch('rack/create')
      console.log('addRack')
    },
    renameRack() {
      this.$store.dispatch('rack/rename')
      console.log('renameRack')
    },
    deleteRack() {
      this.$store.dispatch('rack/delete')
      console.log('deleteRack')
    },
    addFolder() {
      console.log('addFolder')
    }
  }
}
</script>

<style scoped></style>
