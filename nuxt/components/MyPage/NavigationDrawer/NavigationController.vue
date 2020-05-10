<template>
  <v-row class="ma-0" style="height: 100%; width: 100%">
    <!-- 一番左のサイドメニュー -->
    <ListBaseMenu
      :menu-togglable="menuTogglable"
      :toggle-menu="toggleMenu"
      width="50"
      class="float-left"
    ></ListBaseMenu>

    <v-divider vertical inset class="float-left"></v-divider>

    <div class="float-left" style="width: calc(100% - 51px)">
      <ListSearch v-if="shouldShow('ListSearch')"></ListSearch>
      <ListPublic v-else-if="shouldShow('ListPublic')"></ListPublic>
      <ListPrivate v-else-if="shouldShow('ListPrivate')"></ListPrivate>
    </div>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ListBaseMenu from '@/components/MyPage/NavigationDrawer/ListBaseMenu/ListBaseMenu.vue'
import ListSearch from '@/components/MyPage/NavigationDrawer/ListSearch/ListSearch.vue'
import ListPublic from '@/components/MyPage/NavigationDrawer/ListPublic/ListPublic.vue'
import ListPrivate from '@/components/MyPage/NavigationDrawer/ListPrivate/ListPrivate.vue'

export default {
  name: 'NavigationController',
  components: { ListBaseMenu, ListSearch, ListPublic, ListPrivate },
  data() {
    return {
      menuTogglable: [
        { name: 'ListSearch', icon: 'search', active: false },
        { name: 'ListPublic', icon: 'mdi-home', active: false },
        { name: 'ListPrivate', icon: 'mdi-note-multiple', active: true }
      ]
    }
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    toggleMenu(menuName) {
      this.menuTogglable.forEach((menu) => {
        menu.active = menu.name === menuName
      })
    },
    shouldShow(menuName) {
      return this.menuTogglable.find((menu) => menu.name === menuName).active
    }
  }
}
</script>

<style scoped></style>
