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
        { title: 'Add Rack', action: 'add' },
        { title: 'Rename Rack', action: 'edit' },
        { title: 'Delete Rack', action: 'delete' }
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
        case 'addFolder':
          this.addFolder()
          break
      }
    },
    async add() {
      const newRack = await this.$store.dispatch('rack/create')
      this.$emit('edit', { rack: newRack })
    },
    edit() {
      this.$emit('edit', { rack: this.rack })
    },
    async delete() {
      await this.$store.dispatch('rack/delete', { rack: this.rack })
    },
    async addFolder() {
      const folder = await this.$store.dispatch('folder/create', {
        rack: this.rack
      })
      this.$store.dispatch('rack/addFolder', {
        rack: this.rack,
        folder
      })
    }
  }
}
</script>

<style scoped></style>
