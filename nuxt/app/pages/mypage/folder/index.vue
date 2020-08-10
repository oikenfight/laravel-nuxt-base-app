<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="10">
        <Header></Header>
      </v-col>

      <v-col cols="10">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="10">
        <BreadCrumbs :breadcrumbs-items="breadcrumbsItems"></BreadCrumbs>
      </v-col>

      <v-col cols="10">
        <FolderList :folders="foldersAll"></FolderList>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/MyPage/Common/Header'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'
import FolderList from '@/components/MyPage/Folder/FolderList'

export default {
  name: 'Index',
  components: { Header, BreadCrumbs, FolderList },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      foldersAll: 'folder/foldersAll'
    }),
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
          text: 'Folder List',
          disabled: true,
          href: '/mypage/folder'
        }
      ]
    }
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped></style>
