<template>
  <v-app id="">
    <v-row class="fill-height" no-gutters>
      <v-navigation-drawer
        dark
        mini-variant-width="50"
        :mini-variant.sync="mini"
        permanent
      >
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

        <v-list dense width="50" class="fill-height float-left">
          <v-list-item-group>
            <v-list-item v-for="menu in menues" :key="menu.title">
              <v-list-item-icon>
                <v-icon v-text="menu.icon"></v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <v-divider vertical class="float-left"></v-divider>

        <v-list class="grow">
          <v-list-item v-for="link in links" :key="link" link>
            <v-list-item-title v-text="link"></v-list-item-title>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
    </v-row>

    <!-- <v-navigation-drawer
      v-model="drawer"
      app
      mini-variant
      dark
      color="teal"
      :permanent="permanent"
      :width="325"
    >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            Navigation lists
            <v-btn
              class="mx-2 float-right"
              fab
              small
              outlined
              color="grey lighten-2"
            >
              <v-icon dark>mdi-pencil</v-icon>
            </v-btn>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider />

      <v-row dense>
        <v-col cols="6">
          <v-list dense>
            <v-list-item-group v-model="tree">
              <v-row v-for="rack in racksAll" :key="rack.id">
                <v-list-item @click="selectRack(rack)">
                  <v-subheader>
                    {{ rack.name }}
                  </v-subheader>
                  <v-btn
                    class="float-right"
                    fab
                    text
                    x-small
                    color="grey lighten-2"
                  >
                    <v-icon class="float-right">mdi-dots-horizontal</v-icon>
                  </v-btn>
                </v-list-item>
                <v-list-item
                  v-for="folder in folders(rack.id)"
                  :key="folder.id"
                  @click="selectFolder(rack, folder)"
                >
                  <v-list-item-icon style="margin-right: 5px">
                    <v-icon small v-text="folder.icon" />
                  </v-list-item-icon>
                  <v-list-item-title v-text="folder.name" />
                </v-list-item>
              </v-row>
            </v-list-item-group>
          </v-list>
        </v-col>
        <v-col cols="6">
          <v-list dense>
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
        </v-col>
      </v-row>
    </v-navigation-drawer> -->

    <v-content>
      <nuxt />
    </v-content>
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
