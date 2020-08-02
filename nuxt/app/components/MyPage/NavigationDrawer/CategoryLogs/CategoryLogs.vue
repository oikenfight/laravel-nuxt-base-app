<template>
  <v-row justify="center">
    <v-list width="100%">
      <v-list-item
        v-for="category in categoriesAll"
        :key="category.id"
        dense
        @click="select(category)"
      >
        <ListItemCategory :category="category" class="pl-2"></ListItemCategory>
      </v-list-item>
    </v-list>
  </v-row>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import ListItemCategory from '@/components/MyPage/NavigationDrawer/CategoryLogs/ListItemCategory.vue'

export default {
  name: 'CategoryLogs',
  components: { ListItemCategory },
  data() {
    return {
      categoryEdited: {}
    }
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
      this.$router.push('/mypage/category/' + category.id)
    },
    add() {
      this.$store.dispatch('category/create')
    }
  }
}
</script>

<style scoped></style>
