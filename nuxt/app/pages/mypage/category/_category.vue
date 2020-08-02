<template>
  <v-container>
    <v-row justify="center">
      <v-col ref="titleHeader" cols="10" class="pb-0">
        <Header></Header>
      </v-col>

      <v-col cols="10">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="10">
        <div class="display-1">{{ category.name }}</div>
        <div>
          <v-chip x-small class="ma-2">
            {{ currentNoteStatusText }}
          </v-chip>
          <span class="subtitle-2">
            <v-icon>mdi-book-open</v-icon>
            {{ notes.length }}本
          </span>
        </div>
      </v-col>

      <v-col cols="10">
        <v-row>
          <v-breadcrumbs :items="breadcrumbsItems">
            <template v-slot:divider>
              <v-icon>mdi-chevron-right</v-icon>
            </template>
          </v-breadcrumbs>
        </v-row>
      </v-col>

      <v-col cols="10">
        <NoteList :notes="notes" :select="select"></NoteList>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/MyPage/Common/Header'
import NoteList from '@/components/MyPage/Common/NoteList.vue'

export default {
  name: 'Index',
  components: { Header, NoteList },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      categoryNotesByStatus: 'note/categoryNotesByStatus',
      currentNoteStatus: 'currentNoteStatus',
      categoryGetter: 'view/category/category'
    }),
    notes() {
      return this.categoryNotesByStatus({
        categoryId: this.$route.params.category,
        noteStatus: this.currentNoteStatus
      })
    },
    category() {
      return this.categoryGetter(this.$route.params.category)
    },
    currentNoteStatusText() {
      return this.$constants.noteStatusesText[this.currentNoteStatus]
    },
    breadcrumbsItems() {
      return [
        {
          text: 'TOP',
          disabled: false,
          href: '/'
        },
        {
          text: 'マイページ',
          disabled: false,
          href: '/mypage'
        },
        {
          text: this.category ? this.category.name : 'no category',
          disabled: true,
          href: '/mypage/category/' + this.$route.params.category
        }
      ]
    }
  },
  methods: {
    ...mapActions({}),
    select(note) {
      this.$router.push('/mypage/folder/' + note.folder_id + '/note/' + note.id)
    }
  }
}
</script>

<style scoped></style>
