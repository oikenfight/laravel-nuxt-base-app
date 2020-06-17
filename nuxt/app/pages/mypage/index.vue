<template>
  <v-container>
    <v-row justify="center">
      <v-col ref="titleHeader" cols="10" class="pb-0">
        <Header></Header>
      </v-col>

      <v-col cols="12">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="11" class="pa-0">
        <BreadCrumbs :breadcrumbs-items="breadcrumbsItems"></BreadCrumbs>
      </v-col>
    </v-row>

    <v-row justify="center">
      <v-col cols="3">
        <v-avatar width="150" height="150">
          <v-img :src="require('@/assets/img/noimage.png')"></v-img>
        </v-avatar>
      </v-col>
      <v-col cols="8">
        <v-row>
          <v-col cols="12">
            <div class="title">{{ user.name }}</div>
          </v-col>
          <v-col cols="12">
            TODO: ここにプロフィールとか。
          </v-col>
          <v-col cols="12">
            <div class="body-1">
              <a class="">
                <span>0</span>
                <span>フォロー </span>
              </a>

              <a class="pl-4">
                <span>0</span>
                <span>フォロワー</span>
              </a>
            </div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>

    <v-row justify="center">
      <v-col cols="11">
        <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
          <v-tab v-for="item in tabItems" :key="item">
            {{ item }}
          </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
          <v-tab-item v-for="item in tabItems" :key="item">
            <v-card color="basil" flat>
              <v-card-text>
                <NoteList :notes="notes" :select="select"></NoteList>
              </v-card-text>
            </v-card>
          </v-tab-item>
        </v-tabs-items>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/MyPage/Common/Header'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'
import NoteList from '@/components/MyPage/Common/NoteList.vue'

export default {
  name: 'Index',
  components: { Header, BreadCrumbs, NoteList },
  data() {
    return {
      tab: null,
      tabItems: ['公開中', 'ログ', '保存済み']
    }
  },
  computed: {
    ...mapGetters({
      user: 'user',
      notesAll: 'note/notesAll',
      notesReleased: 'note/notesReleased'
    }),
    notes() {
      let notes = []
      switch (this.tab) {
        case 0:
          notes = this.notesReleased
          break
        case 1:
          notes = this.notesAll
          break
        case 2:
          break
      }
      return notes
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
          disabled: true,
          href: '/mypage'
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
