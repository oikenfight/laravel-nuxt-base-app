<template>
  <v-app id="">
    <v-app-bar color="" dark app>
      <v-row>
        <v-col cols class="col-9">
          <v-toolbar-title>Web Markdown Editor</v-toolbar-title>
        </v-col>
        <v-col cols class="col-3">
          <AppBarMenu></AppBarMenu>
        </v-col>
      </v-row>

      <template v-slot:extension>
        <v-tabs align-with-title>
          <v-tab>Tab 1</v-tab>
          <v-tab>Tab 2</v-tab>
          <v-tab>Tab 3</v-tab>
        </v-tabs>
      </template>
    </v-app-bar>

    <!-- Navigation -->
    <v-navigation-drawer
      dark
      app
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
      <SideMenu></SideMenu>

      <v-divider vertical inset class="float-left"></v-divider>

      <!-- Racks/Folders -->
      <v-row>
        <Tree></Tree>
      </v-row>
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
import AppBarMenu from '@/components/appbar/Menu.vue'
// import AppBarTabs from '@/components/appbar/Tabs.vue'
import SideMenu from '@/components/navigation/SideMenu.vue'
import Tree from '@/components/navigation/Tree.vue'

export default {
  middleware: 'auth',
  components: { AppBarMenu, Tree, SideMenu },
  data: () => ({
    drawer: null,
    permanent: true,
    open: ['public'],
    links: ['Home', 'Contacts', 'Settings'],
    mini: true
  }),
  computed: {
    ...mapGetters({
      notes: 'note/notes' // ノートIDを配列で渡し、ノートを取得
    })
  },
  methods: {
    ...mapActions({})
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
