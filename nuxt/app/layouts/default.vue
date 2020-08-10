<template>
  <v-app id="">
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
          <v-icon>mdi-account</v-icon>
          <!--
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
          -->
        </v-list-item-avatar>
        <v-list-item-title>{{ user.name }}</v-list-item-title>

        <!-- ナビゲーションバー閉じるボタン -->
        <v-btn icon @click.stop="mini = !mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>

      <v-divider></v-divider>

      <!-- Navigation のメインコンテンツ -->
      <NavigationBase></NavigationBase>
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
import NavigationBase from '@/components/MyPage/NavigationDrawer/NavigationBase'

export default {
  middleware: 'auth',
  components: { NavigationBase },
  data: () => ({
    mini: true
  }),
  computed: {
    ...mapGetters({
      user: 'user'
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
