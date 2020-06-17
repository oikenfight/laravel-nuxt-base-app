<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="10">
        <Header></Header>
      </v-col>

      <v-col cols="10">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="10" class="pa-0">
        <BreadCrumbs :breadcrumbs-items="breadcrumbsItems"></BreadCrumbs>
      </v-col>

      <v-col cols="8" class="offset-1">
        <NoteList :notes="notesReleased"></NoteList>
      </v-col>

      <v-col cols="2" class="">
        <CategoryList :categories="categoriesAll"></CategoryList>
      </v-col>

      <v-spacer></v-spacer>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/View/Common/Header'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'
import NoteList from '@/components/View/Common/NoteList'
import CategoryList from '@/components/View/Top/CategoryList/CategoryList'

export default {
  name: 'Index',
  layout: 'guest',
  components: { Header, BreadCrumbs, NoteList, CategoryList },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      notesReleased: 'note/notesReleased',
      categoriesAll: 'category/categoriesAll'
    }),
    breadcrumbsItems() {
      return [
        {
          text: 'TOP',
          disabled: false,
          href: '/'
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
