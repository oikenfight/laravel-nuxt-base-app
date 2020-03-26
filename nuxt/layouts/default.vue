<template>
  <v-app id="">
    <v-app-bar color="" dark app>
      <v-toolbar-title>Web Markdown Editor</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-menu bottom left>
        <template v-slot:activator="{ on }">
          <v-btn icon color="" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item @click="logout">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
          <v-list-item disabled>
            <v-list-item-title>Setting</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>

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
      width="302"
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

      <v-divider vertical inset class="float-left"></v-divider>

      <!-- Racks/Folders -->
      <v-flex width="125">
        <tree @select="selectFolder"></tree>
      </v-flex>

      <v-divider vertical inset class="float-left"></v-divider>

      <!-- Notes -->
      <v-list dense class="float-left" width="125">
        <!-- New Note -->
        <v-row justify="center" style="height: 45px;">
          <v-fab-transition v-if="notesSelectable">
            <v-btn
              color="grey lighten-1"
              dark
              small
              right
              absolute
              fab
              @click="addNote"
            >
              <v-icon>mdi-note-plus</v-icon>
            </v-btn>
          </v-fab-transition>
        </v-row>

        <!-- Note List -->
        <v-col v-for="note in notesSelectable" :key="note.id" class="ma-0 pa-0">
          <v-card class="ma-2" outlined light @click="selectNote(note.id)">
            <v-card-subtitle class="py-0 my-0 mr-0 pr-0">
              2019/12/31
            </v-card-subtitle>
            <v-card-text class="text--primary">
              <div>{{ note.name }}</div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-list>
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
    <!-- <v-footer class="grey lighten-5" app>
      Vuetify
    </v-footer> -->

    <!-- Content -->
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import tree from '@/components/tree/default.vue'

export default {
  middleware: 'auth',
  components: { tree },
  data: () => ({
    drawer: null,
    permanent: true,
    open: ['public'],
    tree: [],
    menusSide: [
      { name: 'Search', icon: 'search' },
      { name: 'Notes', icon: 'mdi-note-multiple' },
      { name: 'Releases', icon: 'mdi-folder-lock-open' }
    ],
    links: ['Home', 'Contacts', 'Settings'],
    mini: true,
    rackSelected: {},
    folderSelected: {},
    noteSelected: {},
    itemSelected: {}
  }),
  computed: {
    ...mapGetters({
      racksAll: 'rack/racksAll', // 全 Racks
      folders: 'folder/folders', // フォルダIDを配列で渡し、フォルダを取得
      notes: 'note/notes', // ノートIDを配列で渡し、ノートを取得
      noteIds: 'tree/noteIds', // selectRack or selectFolder でセットされる
      noteId: 'notes/noteId' // 選択中の NoteId
    }),
    notesSelectable() {
      return this.notes(this.folderSelected.noteIds)
    }
  },
  methods: {
    ...mapActions({}),
    selectFolder(rack, folder) {
      // Folder をセット（同時に NoteIds もセットされる）
      this.rackSelected = rack
      this.folderSelected = folder
    },
    selectNote(noteId) {
      this.$router.push('/note/' + noteId)
    },
    addNote() {
      this.$store.dispatch('notes/createNote') // ノートを作成し、notes/NoteId をセットする
      this.$store.dispatch('tree/addNoteId', this.noteId)
    },
    logout() {
      this.$store.dispatch('logout')
      window.location.href = '/login'
    }
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
</style>
