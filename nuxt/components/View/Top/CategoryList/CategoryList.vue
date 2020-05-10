<template>
  <v-row class="ma-0">
    <v-col cols="12" class="py-0">
      <span class="title">
        Category hoge
      </span>
    </v-col>

    <v-col cols="12" class="pt-0">
      <v-divider></v-divider>
    </v-col>

    <v-list width="100%" style="background: #fafafa">
      <v-list-item
        v-for="category in categoriesAll"
        :key="category.id"
        dense
        @click="select(category)"
      >
        <ListItem :category="category"></ListItem>
      </v-list-item>
    </v-list>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ListItem from '@/components/View/Top/CategoryList/ListItem'

export default {
  name: 'CategoryList',
  components: { ListItem },
  props: {
    categories: Array
  },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      categoriesAll: 'category/categoriesAll',
      notesReleasedOfCategory: 'note/notesReleasedOfCategory'
    })
  },
  methods: {
    ...mapActions({}),
    select(category) {
      this.$router.push('/category/' + category.id)
    }
  }
}
</script>

<style scoped></style>
