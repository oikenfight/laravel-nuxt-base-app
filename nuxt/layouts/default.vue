<template>
  <v-app id="">
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
        <v-btn icon @click.stop="mini = !mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>

      <v-divider></v-divider>

      <!-- Side Menu（固定） -->
      <v-list dense width="50" class="fill-height float-left">
        <v-list-item-group>
          <v-list-item v-for="menu in menus" :key="menu.name">
            <v-list-item-icon>
              <v-icon v-text="menu.icon"></v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list-item-group>
      </v-list>

      <v-divider vertical inset class="float-left"></v-divider>

      <!-- Racks/Folders -->
      <v-list dense class="float-left pt-2" width="125" no-gutters>
        <v-list-item-group v-model="tree">
          <v-col v-for="rack in racksAll" :key="rack.id" class="ma-0 pa-0">
            <v-list-item class="mt-1 pt-1 mx-0 px-0" @click="selectRack(rack)">
              <v-subheader>
                {{ rack.name }}
              </v-subheader>
              <v-spacer></v-spacer>
              <v-btn text fab x-small>
                <v-icon>mdi-dots-vertical</v-icon>
              </v-btn>
            </v-list-item>
            <v-col class="my-0 py-0">
              <v-divider></v-divider>
            </v-col>
            <v-list-item
              v-for="folder in folders(rack.folderIds)"
              :key="folder.id"
              class="ma-1 pa-1"
              @click="selectFolder(rack, folder)"
            >
              <v-list-item-icon class="ma-1">
                <v-icon small v-text="folder.icon" />
              </v-list-item-icon>
              <v-list-item-title v-text="folder.name" />
            </v-list-item>
          </v-col>
        </v-list-item-group>
      </v-list>

      <v-divider vertical inset class="float-left"></v-divider>

      <!-- Notes -->
      <v-list dense class="float-left" width="125">
        <!-- New Note -->
        <v-row justify="center" style="height: 45px;">
          <v-fab-transition v-if="folderId">
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
        <v-col v-for="note in notes(noteIds)" :key="note.id" class="ma-0 pa-0">
          <v-card class="ma-2" outlined light @click="selectNote(note)">
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

export default {
  middleware: 'auth',
  data: () => ({
    drawer: null,
    permanent: true,
    open: ['public'],
    tree: [],
    menus: [
      { name: 'Search', icon: 'search' },
      { name: 'Notes', icon: 'mdi-note-multiple' },
      { name: 'Releases', icon: 'mdi-folder-lock-open' }
    ],
    links: ['Home', 'Contacts', 'Settings'],
    mini: true
  }),
  computed: {
    ...mapGetters({
      racksAll: 'tree/racksAll', // 全 Racks
      folders: 'tree/folders', // rackId を引数に取得
      rackId: 'tree/rackId', // 選択された rack
      folderId: 'tree/folderId', // 選択された folder
      noteIds: 'tree/noteIds', // selectRack or selectFolder でセットされる
      notes: 'notes/notes', // noteIds を引数に取得
      noteId: 'notes/noteId' // 選択中の NoteId
    })
  },
  mounted() {
    // TODO この辺の初期データは SSR でもってきたいところ。
    this.$store.dispatch('tree/getRacksAll')
    this.$store.dispatch('tree/getFoldersAll')
    this.$store.dispatch('notes/getNotesAll')
    this.$store.dispatch('notes/getItemsAll')
  },
  methods: {
    ...mapActions({}),
    selectRack(rack) {
      // Rack をセット（同時に NoteIds もセットされる）
      this.$store.dispatch('tree/selectRack', rack)
    },
    selectFolder(rack, folder) {
      // Folder をセット（同時に NoteIds もセットされる）
      this.$store.dispatch('tree/selectFolder', { rack, folder })
    },
    selectNote(note) {
      this.$store.dispatch('notes/setNoteId', note.id)
    },
    addNote() {
      this.$store.dispatch('notes/createNote') // ノートを作成し、notes/NoteId をセットする
      this.$store.dispatch('tree/addNoteId', this.noteId)
    }
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
</style>
