<template>
  <!-- Side Menu（固定） -->
  <v-list dense width="50" class="fill-height">
    <v-list-item-group>
      <v-list-item
        v-for="(menu, index) in menusTogglable"
        :key="index"
        @click="toggleMenu(menu)"
      >
        <v-list-item-icon class="">
          <v-icon class="" v-text="menu.icon"></v-icon>
        </v-list-item-icon>
      </v-list-item>
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  name: 'LeftMenu',
  props: {
    currentMenu: Object,
    menusTogglable: Array,
    toggleMenu: Function
  },
  data() {
    return {}
  },
  mounted() {
    console.log(this.menusTogglable)
  },
  methods: {}
}
</script>

<style scoped></style>
