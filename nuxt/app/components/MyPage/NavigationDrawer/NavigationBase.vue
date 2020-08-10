<template>
  <v-row class="ma-0" style="height: 100%; width: 100%">
    <!-- 一番左のサイドメニュー -->
    <LeftMenu
      :current-menu="currentMenu"
      :menus-togglable="menusTogglable"
      :toggle-menu="toggleMenu"
      width="50"
      class="float-left"
    ></LeftMenu>

    <v-divider vertical inset class="float-left"></v-divider>

    <div class="float-left" style="width: calc(100% - 51px)">
      <!-- status フィルターボタン -->
      <v-col cols="12">
        <StatusFilterButtons></StatusFilterButtons>
      </v-col>

      <!-- 検索フォーム -->
      <v-col cols="12" class="py-0">
        <SearchForm></SearchForm>
      </v-col>

      <!-- Header of ナビゲーションコンテンツ -->
      <v-col v-if="shouldShow('CategoryLogs')" cols="12" class="py-0">
        <ContentHeader
          :current-menu="currentMenu"
          :header-action="addCategory"
        ></ContentHeader>
      </v-col>
      <v-col v-if="shouldShow('MyLogs')" cols="12" class="py-0">
        <ContentHeader
          :current-menu="currentMenu"
          :header-action="addRack"
        ></ContentHeader>
      </v-col>

      <!-- divider -->
      <v-col cols="12" class="py-0">
        <v-divider></v-divider>
      </v-col>

      <!-- Main of ナビゲーションコンテンツ -->
      <v-col v-if="shouldShow('CategoryLogs')" cols="12">
        <CategoryLogs></CategoryLogs>
      </v-col>
      <v-col v-else-if="shouldShow('MyLogs')" cols="12">
        <MyLogs></MyLogs>
      </v-col>
    </div>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import LeftMenu from '@/components/MyPage/NavigationDrawer/Common/LeftMenu.vue'
import StatusFilterButtons from '@/components/MyPage/NavigationDrawer/Common/StatusFilterButtons.vue'
import SearchForm from '@/components/MyPage/NavigationDrawer/Common/SearchForm.vue'
import ContentHeader from '@/components/MyPage/NavigationDrawer/Common/ContentHeader.vue'
import CategoryLogs from '@/components/MyPage/NavigationDrawer/CategoryLogs/CategoryLogs.vue'
import MyLogs from '@/components/MyPage/NavigationDrawer/MyLogs/MyLogs.vue'

export default {
  name: 'NavigationBase',
  components: {
    LeftMenu,
    StatusFilterButtons,
    SearchForm,
    ContentHeader,
    CategoryLogs,
    MyLogs
  },
  data() {
    return {
      currentMenu: {},
      menusTogglable: [
        { name: 'CategoryLogs', headerText: 'カテゴリ', icon: 'mdi-book' },
        {
          name: 'MyLogs',
          headerText: 'グループ/フォルダ',
          icon: 'mdi-note-multiple'
        }
      ],
      displayedNoteStatus: 1
    }
  },
  computed: {
    ...mapGetters({})
  },
  mounted() {
    console.log(this.$constants.noteStatus)
  },
  methods: {
    ...mapActions({}),
    shouldShow(menuName) {
      if (!this.currentMenu) {
        return false
      }
      return this.currentMenu.name === menuName
    },
    toggleMenu(menu) {
      this.currentMenu = menu
    },
    addCategory() {
      this.$store.dispatch('category/create')
    },
    addRack() {
      this.$store.dispatch('rack/create')
    }
  }
}
</script>

<style scoped></style>
