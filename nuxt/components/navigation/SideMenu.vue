<template>
  <!-- Side Menu（固定） -->
  <v-list dense width="50" class="fill-height float-left">
    <v-list-item-group>
      <v-list-item v-for="(menu, index) in menusSide" :key="index">
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
  data: () => ({
    menusSide: [
      { name: 'Search', icon: 'search' },
      { name: 'Notes', icon: 'mdi-note-multiple' },
      { name: 'Releases', icon: 'mdi-folder-lock-open' }
    ]
  })
}
</script>

<style scoped></style>
