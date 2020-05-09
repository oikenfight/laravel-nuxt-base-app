<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="10">
        <v-row justify="center">
          <v-col cols="auto" class="display-2 pa-0">
            note
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="10">
        <v-divider></v-divider>
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
        <v-row>
          <v-col
            v-for="item in items"
            :key="item.id"
            cols="12"
            class="pa-0"
            @click="select(item)"
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

export default {
  name: 'Article',
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
          text: this.note ? this.note.name : '',
          disabled: true,
          href: '/category'
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
