<template>
  <!-- Side Menu（固定） -->
  <v-list dense width="50" class="fill-height float-left">
    <v-list-item-group>
      <v-list-item
        v-for="(menu, index) in menusSide"
        :key="index"
        @click="toggleMenu(menu.name)"
      >
        <v-list-item-icon>
          <v-icon v-text="menu.icon"></v-icon>
        </v-list-item-icon>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  name: 'SideMenu',
  props: {},
  data: () => ({
    menusSide: [
      { name: 'ListSearch', icon: 'search' },
      { name: 'ListWork', icon: 'mdi-note-multiple' },
      { name: 'ListRelease', icon: 'mdi-folder-lock-open' }
    ]
  }),
  methods: {
    toggleMenu(menuName) {
      this.$emit('toggleMenu', { menuName })
    }
  }
}
</script>

<style scoped></style>
