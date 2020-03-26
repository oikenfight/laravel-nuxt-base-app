<template>
  <!-- TODO: そのうちやる。選択中の rack or folder をハイライトする -->
  <!-- ツリーを描画するコンポーネント -->
  <v-list dense class="float-left pt-2" width="125">
    <!-- Tree -->
    <v-list-group v-for="rack in racksAll" :key="rack.id" sub-group>
      <!-- Rack -->
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="rack.name"></v-list-item-title>
        </v-list-item-content>
      </template>

      <!-- Folders（Rackの中身） -->
      <v-list-item
        v-for="folder in folders(rack.folderIds)"
        :key="folder.id"
        link
        @click="select(rack, folder)"
      >
        <v-list-item-title v-text="folder.name"></v-list-item-title>
        <v-list-item-icon class="ma-1">
          <v-icon small v-text="folder.icon" />
        </v-list-item-icon>
      </v-list-item>
    </v-list-group>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Tree',
  data: () => ({
    selected: {
      rack: null,
      folder: null
    }
  }),
  computed: {
    ...mapGetters({
      racksAll: 'rack/racksAll', // 全 Racks
      folders: 'folder/folders' // rackId を引数に取得
    })
  },
  methods: {
    ...mapActions({}),
    select(rack, folder) {
      this.selected.rack = rack
      this.selected.folder = folder
      this.$emit('select', rack, folder)
    }
  }
}
</script>

<style scoped></style>
