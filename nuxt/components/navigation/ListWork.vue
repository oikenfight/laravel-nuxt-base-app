<template>
  <!-- TODO: そのうちやる。選択中の rack or folder をハイライトする -->
  <!-- ツリーを描画するコンポーネント -->
  <v-row>
    <v-list class="" width="100%">
      <v-row v-for="rack in racksAll" :key="rack.id" style="margin: 0">
        <v-col v-if="isEditingTheRack(rack)">
          <v-text-field v-model="rackEdited.name" outlined dense hide-details>
            <template v-slot:append>
              <v-btn class="ma-1" x-small color="" icon @click="renameRack">
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
            </template>
          </v-text-field>
        </v-col>
        <v-col
          v-else
          cols="12"
          class="text-truncate"
          style="padding: 0; margin-top: 15px;"
        >
          <span style="padding: 0 10px;"></span>
          {{ rack.name }}
          <span style="float: right;">
            <!-- Rack アクションメニュー -->
            <RackActionMenu :rack="rack" @editRack="editRack"></RackActionMenu>
          </span>
        </v-col>

        <v-col cols="12" style="margin: 0 15px; padding: 0">
          <v-divider></v-divider>
        </v-col>

        <!-- Folders（Rackの中身） -->
        <v-list-item
          v-for="folder in folders(rack.folder_ids)"
          :key="folder.id"
          dense
          style="padding: 0"
          @click="select(rack, folder)"
        >
          <!-- if:Edit Text-Field -->
          <v-col v-if="isEditingTheFolder(folder)">
            <v-text-field
              v-model="folderEdited.name"
              outlined
              dense
              hide-details
            >
              <template v-slot:append>
                <v-btn class="ma-1" x-small color="" icon @click="renameFolder">
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>
            </v-text-field>
          </v-col>
          <!-- else:Show Title -->
          <v-col
            v-else
            cols="12"
            class="text-truncate"
            style="padding: 0; margin: 0;"
          >
            <span style="padding: 0 15px">
              <v-icon small>folder_open</v-icon>
            </span>
            {{ folder.name }}
            <span style="float: right;">
              <!-- Rack アクションメニュー -->
              <FolderActionMenu
                :rack="rack"
                :folder="folder"
                @editFolder="editFolder"
              ></FolderActionMenu>
            </span>
          </v-col>
        </v-list-item>
      </v-row>
    </v-list>
  </v-row>
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
      rackEdited: {},
      folderEdited: {}
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
    isEditingTheRack(rack) {
      return this.rackEdited && this.rackEdited.id === rack.id
    },
    isEditingTheFolder(folder) {
      return this.folderEdited && this.folderEdited.id === folder.id
    },
    editRack({ rack }) {
      this.rackEdited = Object.assign({}, rack)
    },
    editFolder({ folder }) {
      this.folderEdited = Object.assign({}, folder)
    },
    async renameRack() {
      await this.$store.dispatch('rack/update', { rack: this.rackEdited })
      this.rackEdited = {}
    },
    async renameFolder() {
      await this.$store.dispatch('folder/update', { folder: this.folderEdited })
      this.folderEdited = {}
    }
  }
}
</script>

<style scoped></style>
