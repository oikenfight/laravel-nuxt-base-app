<template>
  <v-app id="">
    <!-- Navigation -->
    <v-navigation-drawer
      dark
      app
      mini-variant-width="50"
      :mini-variant.sync="mini"
      permanent
      width="305"
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
          <v-list-item v-for="menu in menues" :key="menu.title">
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
              v-for="folder in folders(rack.id)"
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
        <v-row v-for="note in notes(noteIds)" :key="note.id">
          <v-card
            class="mx-auto"
            outlined
            light
            style="margin: 3px;"
            @click="selectNote(note)"
          >
            <v-card-subtitle class="pb-0">2019/12/31</v-card-subtitle>
            <v-card-text class="text--primary">
              <div>{{ note.title }}</div>
            </v-card-text>
          </v-card>
        </v-row>
      </v-list>
    </v-navigation-drawer>

    <!-- Application Bar -->
    <v-app-bar class="grey lighten-5" app>
      <v-toolbar-title>Vuetify</v-toolbar-title>
    </v-app-bar>

    <!-- Content -->
    <v-content class="grey lighten-5" app>
      <nuxt />
    </v-content>

    <!-- Footer -->
    <v-footer class="grey lighten-5" app inset>
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
  data: () => ({
    drawer: null,
    permanent: true,
    open: ['public'],
    selectedFolderId: null,
    tree: [],
    menues: [
      { title: 'Search', icon: 'search' },
      { title: 'Notes', icon: 'mdi-note-multiple' },
      { title: 'Releases', icon: 'mdi-folder-lock-open' }
    ],
    links: ['Home', 'Contacts', 'Settings'],
    mini: true
  }),
  computed: {
    ...mapGetters({
      racksAll: 'tree/racksAll', // 全 Racks
      folders: 'tree/folders', // rackId を引数に取得
      rack: 'tree/rack', // 選択された rack
      folder: 'tree/folder', // 選択された folder
      noteIds: 'tree/noteIds', // selectRack or selectFolder でセットされる
      notes: 'notes/notes' // noteIds を引数に取得
    })
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
    }
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
</style>
