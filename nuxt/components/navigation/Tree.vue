<template>
  <!-- TODO: そのうちやる。選択中の rack or folder をハイライトする -->
  <!-- ツリーを描画するコンポーネント -->
  <v-list class="">
    <!-- Tree -->
    <v-list-group v-for="rack in racksAll" :key="rack.id" sub-group multiple>
      <!-- Rack -->
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="rack.name"></v-list-item-title>
        </v-list-item-content>
        <v-list-item-action>
          <v-menu open-on-hover bottom offset-x right>
            <template v-slot:activator="{ on }">
              <v-btn icon v-on="on">
                <v-icon small>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>

            <v-list>
              <v-list-item
                v-for="(menu, index) in menusRack"
                :key="index"
                dense
                @click="triggerClick(menu.action)"
              >
                <v-list-item-content>
                  <v-list-item-title
                    v-if="menu.title"
                    v-text="menu.title"
                  ></v-list-item-title>
                  <v-subheader v-else pl-0 ml-0>{{ menu.target }}</v-subheader>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-list-item-action>
      </template>

      <!-- Folders（Rackの中身） -->
      <v-list-item
        v-for="folder in folders(rack.folderIds)"
        :key="folder.id"
        dense
        @click="select(rack, folder)"
      >
        <v-list-item-icon style="">
          <v-icon small>folder_open</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title v-text="folder.name"></v-list-item-title>
        </v-list-item-content>
        <v-list-item-action style="margin: 0">
          <v-menu open-on-hover bottom>
            <template v-slot:activator="{ on }">
              <v-btn icon v-on="on">
                <v-icon x-small>mdi-dots-vertical</v-icon>
              </v-btn>
            </template>

            <v-list>
              <v-list-item
                v-for="(menu, index) in menusFolder"
                :key="index"
                dense
                @click="menu.action"
              >
                <v-list-item-title>{{ menu.title }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-list-item-action>
      </v-list-item>
    </v-list-group>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Tree',
  data() {
    return {
      menusRack: [
        { target: 'Folder' },
        { title: 'Add Folder', action: 'addFolder' },
        { target: 'Rack' },
        { title: 'Add Rack', action: 'addRack' },
        { title: 'Rename Rack', action: 'renameRack' },
        { title: 'Delete Rack', action: 'deleteRack' }
      ],
      menusFolder: [
        { title: 'Add Folder', action: 'addFolder' },
        { title: 'Rename Folder', action: 'renameFolder' },
        { title: 'Delete Folder', action: 'deleteFolder' }
      ]
    }
  },
  computed: {
    ...mapGetters({
      racksAll: 'rack/racksAll', // 全 Racks
      folders: 'folder/folders' // rackId を引数に取得
    })
  },
  methods: {
    ...mapActions({}),
    select(rack, folder) {
      this.$router.push('/folder/' + folder.id)
    },
    triggerClick(action) {
      switch (action) {
        case 'addRack':
          this.addRack()
          break
        case 'renameRack':
          this.renameRack()
          break
        case 'deleteRack':
          this.deleteRack()
          break
        case 'addFolder':
          this.addFolder()
          break
        case 'renameFolder':
          this.renameFolder()
          break
        case 'deleteFolder':
          this.deleteFolder()
          break
      }
    },
    addRack() {
      this.$store.dispatch('rack/create')
      console.log('addRack')
    },
    renameRack() {
      console.log('renameRack')
    },
    deleteRack() {
      console.log('deleteRack')
    },
    addFolder() {
      console.log('addFolder')
    },
    renameFolder() {
      console.log('renameFolder')
    },
    deleteFolder() {
      console.log('deleteFolder')
    }
  }
}
</script>

<style scoped></style>
