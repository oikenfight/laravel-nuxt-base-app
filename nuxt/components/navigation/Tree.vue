<template>
  <!-- TODO: そのうちやる。選択中の rack or folder をハイライトする -->
  <!-- ツリーを描画するコンポーネント -->
  <v-list class="">
    <v-row v-for="rack in racksAll" :key="rack.id">
      <v-col cols="12 text-truncate" style="padding: 0 15px; margin-top: 15px;">
        {{ rack.name }}
        <span style="float: right">
          <!-- Rack アクションメニュー -->
          <RackActionMenu @rename="editRack(rack)"></RackActionMenu>
        </span>
      </v-col>

      <v-col cols="12" style="margin: 0 20px; padding: 0">
        <v-divider></v-divider>
      </v-col>

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
          <!-- Folder アクションメニュー -->
          <FolderActionMenu :folder="folder"></FolderActionMenu>
        </v-list-item-action>
      </v-list-item>
    </v-row>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import RackActionMenu from '@/components/navigation/RackActionMenu.vue'
import FolderActionMenu from '@/components/navigation/FolderActionMenu.vue'

export default {
  name: 'Tree',
  components: { FolderActionMenu, RackActionMenu },
  data() {
    return {
      rackEdited: {}
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
    isEditing(rack) {
      return this.rackEdited && this.rackEdited.id === rack.id
    },
    editRack(rack) {
      this.rackEdited = Object.assign({}, rack)
    },
    renameRack() {
      this.$store.dispatch('rack/update', { rack: this.rackEdited })
    }
  }
}
</script>

<style scoped></style>
