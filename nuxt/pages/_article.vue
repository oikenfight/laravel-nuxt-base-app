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

      <v-col cols="9">
        <v-row>
          <v-col
            v-for="(item, index) in items"
            :key="index"
            cols="12"
            class="pa-0"
          >
            <v-row align="center">
              <v-col cols="12" class="pa-3">
                <!--  markdown show  -->
                <div style="margin: 0" v-html="$md.render(item.body)"></div>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/MyPage/Common/Header'
import BreadCrumbs from '@/components/MyPage/Common/BreadCrumbs'

export default {
  name: 'Article',
  components: { BreadCrumbs, Header },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      noteGetter: 'note/note',
      categoryGetter: 'category/category',
      itemsGetter: 'item/items'
    }),
    note() {
      return this.noteGetter(this.$route.params.article)
    },
    category() {
      return this.note ? this.categoryGetter(this.note.category_id) : null
    },
    items() {
      return this.note ? this.itemsGetter(this.note.item_ids) : []
    },
    breadcrumbsItems() {
      return [
        {
          text: 'home',
          disabled: false,
          href: '/'
        },
        {
          text: this.category ? this.category.name : '',
          disabled: false,
          href: '/category/' + (this.category ? this.category.id : '')
        },
        {
          text: this.note ? this.note.name : '',
          disabled: true,
          href: '/' + (this.note ? this.note.id : '')
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
