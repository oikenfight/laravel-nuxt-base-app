<template>
  <v-app id="">
    <v-app-bar app clipped-left dark color="teal">
      <v-app-bar-nav-icon
        @click="
          drawer = !drawer
          permanent = !permanent
        "
      />
      <span class="title ml-3 mr-5">
        Ore<span class="font-weight-light">Note</span>
      </span>
      <v-text-field
        solo-inverted
        flat
        hide-details
        label="Search"
        prepend-inner-icon="search"
      />
      <v-spacer />
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      dark
      color="teal"
      :permanent="permanent"
      :width="325"
    >
      <!-- tree head -->
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            Navigation lists
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider />

      <!-- content -->
      <v-row dense>
        <!-- left -->
        <v-col cols="6">
          <v-list dense>
            <!-- folders by the rack -->
            <v-list-item-group v-model="tree">
              <v-row v-for="rack in racksAll" :key="rack.id">
                <v-list-item @click="selectRack(rack)">
                  <v-subheader>
                    {{ rack.name }}
                  </v-subheader>
                </v-list-item>
                <v-list-item
                  v-for="folder in folders(rack.id)"
                  :key="folder.id"
                  @click="selectFolder({ rack, folder })"
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
        <!-- right -->
        <v-col cols="6">
          <v-list dense>
            <v-row v-for="note in notes" :key="note.id">
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
    </v-navigation-drawer>

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
    tree: []
  }),
  computed: {
    ...mapGetters({
      racksAll: 'tree/racksAll',
      folders: 'tree/folders',
      rack: 'tree/rack',
      folder: 'tree/folder',
      noteIds: 'tree/noteIds',
      notes: 'notes/notes' // selectRack or selectFolder
    })
  },
  methods: {
    ...mapActions({
      setRack: 'tree/setRack',
      setFolder: 'tree/setFolder',
      setNotes: 'notes/setNotes',
      setNote: 'notes/setNote'
    }),
    selectRack(rack) {
      // Rack をセット（同時に NoteIds もセットされる）
      this.setRack(rack)
      // セット完了後、Rack.Folders の各 NoteIds から Notes をセット
      this.setNotes(this.noteIds)
    },
    selectFolder(rack, folder) {
      // Folder をセット（同時に NoteIds もセットされる）
      this.setFolder(rack, folder)
      // セット完了後、Folder の NoteIds から Notes をセット
      this.setNotes(this.noteIds)
    },
    selectNote(note) {
      this.setNote(note)
    }
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
</style>
