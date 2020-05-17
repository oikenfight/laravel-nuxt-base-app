<template>
  <v-row class="ma-0">
    <v-col cols="12" class="py-0">
      <v-row>
        <v-col cols="9" class="pr-0">
          <div>
            <span class="title white--text">
              Category
            </span>
          </div>
        </v-col>
        <v-col cols="3" class="pl-0 pt-4">
          <v-btn color="white" text dark small @click="add">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </v-col>

    <v-col cols="12" class="pt-0">
      <v-divider></v-divider>
    </v-col>

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
import { mapGetters, mapActions } from 'vuex'
import ListItemCategory from '@/components/MyPage/NavigationDrawer/ListPublic/ListItemCategory.vue'

export default {
  name: 'ListPublic',
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
