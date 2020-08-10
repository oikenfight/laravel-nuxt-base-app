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
          <v-list-item-title v-text="menu.title"></v-list-item-title>
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
        { title: '新規フォルダ', action: 'addFolder' },
        { title: '新規グループ', action: 'add' },
        { title: 'グループ名変更', action: 'edit' },
        { title: 'グループ削除', action: 'delete' }
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
