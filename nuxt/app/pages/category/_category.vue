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
        <NoteList :notes="notes" :select="select"></NoteList>
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
  name: 'Category',
  layout: 'guest',
  components: { Header, BreadCrumbs, NoteList, CategoryList },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      notesCategory: 'view/note/notesCategory',
      categoriesAll: 'view/category/categoriesAll',
      categoryGetter: 'view/category/category'
    }),
    notes() {
      return this.notesCategory(this.$route.params.category)
    },
    category() {
      return this.categoryGetter(this.$route.params.category)
    },
    breadcrumbsItems() {
      return [
        {
          text: 'Top',
          disabled: false,
          href: '/'
        },
        {
          text:
            this.category && this.category.name
              ? this.category.name
              : 'no name',
          disabled: !(this.category && this.category.name),
          href:
            '/category/' +
            (this.category && this.category.name ? this.category.id : '')
        }
      ]
    }
  },
  methods: {
    ...mapActions({}),
    select(note) {
      console.log('select', '/' + note.id)
      this.$router.push('/' + note.id)
    }
  }
}
</script>

<style scoped></style>
