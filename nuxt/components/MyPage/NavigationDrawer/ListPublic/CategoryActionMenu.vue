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
  name: 'CategoryActionMenu',
  props: {
    category: Object
  },
  data() {
    return {
      menus: [
        { title: 'Add', action: 'add' },
        { title: 'Rename', action: 'edit' },
        { title: 'Delete', action: 'delete' }
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
    add() {
      this.$store.dispatch('category/create')
    },
    edit() {
      this.$emit('edit', { category: this.category })
    },
    delete() {
      this.$store.dispatch('category/delete', { category: this.category })
    }
  }
}
</script>

<style scoped></style>
