<template>
  <v-app id="">
    <!--    <v-app-bar app>-->
    <!--      <v-row>-->
    <!--        <v-col cols class="col-9">-->
    <!--          <v-toolbar-title>Web Markdown Editor</v-toolbar-title>-->
    <!--        </v-col>-->
    <!--        <v-col cols class="col-3">-->
    <!--          <AppBarMenu></AppBarMenu>-->
    <!--        </v-col>-->
    <!--      </v-row>-->

    <!--      &lt;!&ndash; タブ機能はそのうち付けたい &ndash;&gt;-->
    <!--      &lt;!&ndash;      <template v-slot:extension>&ndash;&gt;-->
    <!--      &lt;!&ndash;        <v-tabs align-with-title>&ndash;&gt;-->
    <!--      &lt;!&ndash;          <v-tab>Tab 1</v-tab>&ndash;&gt;-->
    <!--      &lt;!&ndash;          <v-tab>Tab 2</v-tab>&ndash;&gt;-->
    <!--      &lt;!&ndash;          <v-tab>Tab 3</v-tab>&ndash;&gt;-->
    <!--      &lt;!&ndash;        </v-tabs>&ndash;&gt;-->
    <!--      &lt;!&ndash;      </template>&ndash;&gt;-->
    <!--    </v-app-bar>-->

    <!-- Navigation -->
    <v-navigation-drawer
      app
      dark
      mini-variant-width="50"
      :mini-variant.sync="mini"
      permanent
    >
      <!-- Profile -->
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>
        <v-list-item-title>Yuta Oikawa</v-list-item-title>

        <!-- ナビゲーションバー閉じるボタン -->
        <v-btn icon @click.stop="mini = !mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>

      <v-divider></v-divider>

      <!-- 一番左のサイドメニュー -->
      <SideMenu @toggleMenu="toggleMenu"></SideMenu>

      <v-divider vertical inset class="float-left"></v-divider>

      <ListSearch v-if="shouldShow('ListSearch')"></ListSearch>
      <ListWork v-else-if="shouldShow('ListWork')"></ListWork>
      <ListHome v-else-if="shouldShow('ListHome')"></ListHome>
    </v-navigation-drawer>

    <!-- Application Bar -->
    <!-- <v-app-bar class="grey lighten-5" app>
      <v-toolbar-title>Vuetify</v-toolbar-title>
    </v-app-bar> -->

    <!-- Content -->
    <v-content class="" app>
      <nuxt />
    </v-content>

    <!-- Footer -->
    <v-footer class="" app inset>
      <span class="">md-editor @oikawa</span>
    </v-footer>

    <!-- Content -->
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
// import AppBarMenu from '@/components/appbar/Menu.vue'
// import AppBarTabs from '@/components/appbar/Tabs.vue'
import SideMenu from '@/components/navigation/SideMenu.vue'
import ListSearch from '@/components/navigation/ListSearch.vue'
import ListWork from '@/components/navigation/ListWork.vue'
import ListHome from '@/components/navigation/ListHome.vue'

export default {
  middleware: 'auth',
  components: { SideMenu, ListSearch, ListWork, ListHome },
  data: () => ({
    mini: true,
    menuTogglable: {
      ListSearch: false,
      ListWork: true,
      ListHome: false
    }
  }),
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    toggleMenu({ menuName }) {
      Object.keys(this.menuTogglable).forEach((key) => {
        this.menuTogglable[key] = key === menuName
      })
    },
    shouldShow(menuName) {
      return this.menuTogglable[menuName]
    }
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
/* コンポーネントに記載したスタイルが、リロードしたときに反映されないことがある。 */
/* layout に記述したものは必ず反映されるっぽいので、こっちに記述しとく（詳細わかってない） */
.v-md-auto-resize .CodeMirror-scroll {
  overflow: auto;
  height: auto;
  overflow: visible;
  position: relative;
  outline: none;
  min-height: 30px !important;
}
</style>
