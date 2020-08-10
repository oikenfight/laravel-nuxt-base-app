<template>
  <v-row class="pa-0">
    <!-- if:Edit Text-Field -->
    <v-col
      v-if="isEditing(folder)"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent
      @keydown.enter.exact="update"
    >
      <v-text-field
        v-model="folderEdited.name"
        outlined
        dense
        hide-details
      ></v-text-field>
    </v-col>
    <!-- if:Show Text-Field -->
    <v-col v-else cols="12" class="text-truncate pa-0 ma-0">
      <span style="display: inline-block; padding: 4px 10px 0 15px">
        <v-icon small>mdi-folder</v-icon>
      </span>
      <span class="body-2" style="display: inline-block; padding-top: 4px">
        {{ folder.name }}
      </span>
      <span> （{{ noteCount }}） </span>
      <span style="float: right;">
        <!-- Folder アクションメニュー -->
        <ActionMenuFolder
          :folder="folder"
          :rack="rack"
          @edit="edit"
        ></ActionMenuFolder>
      </span>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ActionMenuFolder from '@/components/MyPage/NavigationDrawer/MyLogs/ActionMenuFolder.vue'

export default {
  name: 'ListItemFolder',
  components: { ActionMenuFolder },
  props: {
    folder: Object,
    rack: Object
  },
  data() {
    return {
      folderEdited: {},
      composing: false // 変換中true
    }
  },
  computed: {
    ...mapGetters({
      folderNotesByStatus: 'note/folderNotesByStatus',
      currentNoteStatus: 'currentNoteStatus'
    }),
    noteCount() {
      return this.folderNotesByStatus({
        folderId: this.folder.id,
        noteStatus: this.currentNoteStatus
      }).length
    }
  },
  methods: {
    ...mapActions({}),
    isEditing(folder) {
      return this.folderEdited && this.folderEdited.id === folder.id
    },
    edit({ folder }) {
      this.folderEdited = Object.assign({}, folder)
    },
    update() {
      if (!this.composing) {
        this.$store.dispatch('folder/update', {
          folder: this.folderEdited
        })
        this.folderEdited = {}
      }
    }
  }
}
</script>

<style scoped></style>
