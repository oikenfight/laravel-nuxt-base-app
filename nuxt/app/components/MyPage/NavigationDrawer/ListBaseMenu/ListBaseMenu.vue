<template>
  <!-- Side Menu（固定） -->
  <v-list dense width="50" class="fill-height">
    <v-list-item-group>
      <v-list-item
        v-for="(menu, index) in menuTogglable"
        :key="index"
        @click="toggleMenu(menu.name)"
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
  name: 'ListBaseMenu',
  props: {
    menuTogglable: Array,
    toggleMenu: Function
  },
  data() {
    return {}
  },
  mounted() {
    console.log(this.menuTogglable)
  },
  methods: {}
}
</script>

<style scoped></style>
