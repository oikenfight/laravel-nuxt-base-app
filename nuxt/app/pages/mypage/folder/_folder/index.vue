<template>
  <v-row
    id="scroll-folder-note-list"
    class="overflow-y-auto"
    style="max-height: 100%;"
  >
    <v-row
      v-scroll:#scroll-folder-note-list=""
      align="center"
      justify="center"
      style="margin: 0"
    >
      <v-col cols="12" class="py-0">
        <BreadCrumbs :breadcrumbs-items="breadcrumbsItems"></BreadCrumbs>
      </v-col>

      <v-col cols="12">
        <NoteList :notes="notes" :folder="folder" :select="select"></NoteList>
      </v-col>
    </v-row>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'
import NoteList from '@/components/MyPage/Common/NoteList'

export default {
  name: 'Index',
  components: { BreadCrumbs, NoteList },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      notesGetter: 'note/notes',
      folderGetter: 'folder/folder'
    }),
    notes() {
      return this.folder ? this.notesGetter(this.folder.note_ids) : []
    },
    folder() {
      return this.folderGetter(this.$route.params.folder)
    },
    breadcrumbsItems() {
      return [
        {
          text: 'Top',
          disabled: false,
          href: '/'
        },
        {
          text: 'My Page',
          disabled: false,
          href: '/mypage'
        },
        {
          text: this.folder && this.folder.name ? this.folder.name : 'no name',
          disabled: true,
          href: '/mypage/folder/' + this.$route.params.folder
        }
      ]
    }
  },
  methods: {
    ...mapActions({}),
    select(note) {
      this.$router.push('/mypage/folder/' + this.folder.id + '/note/' + note.id)
    }
  }
}
</script>

<style scoped></style>
