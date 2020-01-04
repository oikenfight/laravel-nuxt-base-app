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
              <v-row v-for="rack in myRacks" :key="rack.id">
                <v-list-item @click="selectRack(rack)">
                  <v-subheader>
                    {{ rack.name }}
                  </v-subheader>
                </v-list-item>
                <v-list-item
                  v-for="folder in myFolders(rack.id)"
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
            <v-row v-for="file in myFiles" :key="file.id">
              <v-card
                class="mx-auto"
                outlined
                light
                style="margin: 3px;"
                @click="selectFile(file)"
              >
                <v-card-subtitle class="pb-0">2019/12/31</v-card-subtitle>
                <v-card-text class="text--primary">
                  <div>{{ file.title }}</div>
                </v-card-text>
              </v-card>
            </v-row>
          </v-list>
        </v-col>
      </v-row>
    </v-navigation-drawer>

    <v-content>
      <v-container fluid class="grey lighten-4 fill-height">
        <v-row justify="center" align="center">
          <nuxt />
        </v-row>
      </v-container>
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
      myRacks: 'tree/myRacks',
      myFolders: 'tree/myFolders',
      myFiles: 'tree/myFiles',
      rack: 'tree/rack',
      folder: 'tree/folder',
      file: 'tree/file'
    })
  },
  methods: {
    ...mapActions({
      selectRack: 'tree/selectRack',
      selectFolder: 'tree/selectFolder',
      selectFile: 'tree/selectFile'
    })
  }
}
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none;
}
</style>
