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
          <v-col cols="12">
            <v-img
              :src="require('@/assets/img/noimage.png')"
              class="white--text align-end"
              max-height="300px"
            ></v-img>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="display-1">
            {{ note.name }}
          </v-col>
        </v-row>

        <!-- divider -->
        <v-col cols="12" class="pb-5">
          <v-divider></v-divider>
        </v-col>

        <v-row justify="center">
          <v-col
            v-for="(item, index) in items"
            :key="index"
            cols="12"
            class="py-0"
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
  layout: 'guest',
  components: { BreadCrumbs, Header },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      noteGetter: 'view/note/note',
      categoryGetter: 'view/category/category',
      items: 'view/item/items'
    }),
    note() {
      return this.noteGetter(this.$route.params.article)
    },
    category() {
      return this.note ? this.categoryGetter(this.note.category_id) : null
    },
    breadcrumbsItems() {
      return [
        {
          text: 'TOP',
          disabled: false,
          href: '/'
        },
        {
          text:
            this.category && this.category.name
              ? this.category.name
              : 'no category',
          disabled: !(this.category && this.category.name),
          href:
            '/category/' +
            (this.category && this.category.name ? this.category.id : '')
        },
        {
          text: this.note ? this.note.name : '',
          disabled: true,
          href: '/' + (this.note ? this.note.id : '')
        }
      ]
    }
  },
  mounted() {
    this.$store.dispatch('view/item/fetch', {
      noteId: this.$route.params.article
    })
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped></style>
