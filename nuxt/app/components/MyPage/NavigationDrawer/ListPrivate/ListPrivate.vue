<template>
  <!-- TODO: そのうちやる。選択中の rack or folder をハイライトする -->
  <!-- ツリーを描画するコンポーネント -->
  <v-row class="ma-0">
    <v-col cols="12" class="py-0">
      <v-row>
        <v-col cols="9" class="pr-0">
          <v-text-field
            placeholder="Search"
            filled
            rounded
            dense
            disabled
          ></v-text-field>
        </v-col>
        <v-col cols="3" class="pl-0 pt-4">
          <v-btn color="white" text dark small @click="addRack">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" class="pt-0">
      <v-divider></v-divider>
    </v-col>

    <v-list class="" width="100%">
      <v-row v-for="rack in racksAll" :key="rack.id" class="ma-0">
        <v-col cols="12" class="py-2">
          <ListItemRack :rack="rack"></ListItemRack>
        </v-col>

        <v-col cols="12" style="margin: 0 15px; padding: 0">
          <v-divider></v-divider>
        </v-col>

        <!-- Folders（Rackの中身） -->
        <v-list-item
          v-for="folder in folders(rack.folder_ids)"
          :key="folder.id"
          dense
          class="pa-0"
          @click="select(rack, folder)"
        >
          <v-col cols="12" class="py-0">
            <ListItemFolder :folder="folder" :rack="rack"></ListItemFolder>
          </v-col>
        </v-list-item>
      </v-row>
    </v-list>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
// import RackActionMenu from '@/components/MyPage/NavigationDrawer/ListPrivate/RackActionMenu.vue'
// import FolderActionMenu from '@/components/MyPage/NavigationDrawer/ListPrivate/FolderActionMenu.vue'
import ListItemRack from '@/components/MyPage/NavigationDrawer/ListPrivate/ListItemRack.vue'
import ListItemFolder from '@/components/MyPage/NavigationDrawer/ListPrivate/ListItemFolder.vue'

export default {
  name: 'ListPrivate',
  components: { ListItemRack, ListItemFolder },
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
      this.$router.push('/mypage/folder/' + folder.id)
    },
    isEditingTheRack(rack) {
      return this.rackEdited && this.rackEdited.id === rack.id
    },
    isEditingTheFolder(folder) {
      return this.folderEdited && this.folderEdited.id === folder.id
    },
    addRack() {
      this.$store.dispatch('rack/create')
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
