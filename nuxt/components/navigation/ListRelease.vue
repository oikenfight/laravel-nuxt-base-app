<template>
  <v-row>
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
      <v-list-item v-for="category in categoriesAll" :key="category.id" dense>
        <!-- if:Edit Text-Field -->
        <v-col
          v-if="isEditing(category)"
          @keydown.enter.exact.prevent
          @keyup.enter.exact="update"
        >
          <v-text-field
            v-model="categoryEdited.name"
            outlined
            dense
            hide-details
          ></v-text-field>
        </v-col>
        <v-col v-else cols="12" class="text-truncate pa-0 ma-0">
          <span class="subtitle2">
            {{ category.name }}
          </span>
          <span style="float: right;">
            <!-- Rack アクションメニュー -->
            <CategoryActionMenu
              :category="category"
              @edit="edit"
            ></CategoryActionMenu>
          </span>
        </v-col>
      </v-list-item>
    </v-list>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import CategoryActionMenu from '@/components/navigation/CategoryActionMenu.vue'

export default {
  name: 'ListRelease',
  components: { CategoryActionMenu },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      categoriesAll: 'category/categoriesAll'
    })
  },
  methods: {
    ...mapActions({}),
    isEditing(category) {
      return this.categoryEdited && this.categoryEdited.id === category.id
    },
    add() {
      this.$store.dispatch('category/create')
    },
    edit({ category }) {
      this.categoryEdited = Object.assign({}, category)
    },
    update() {
      this.$store.dispatch('category/update', {
        category: this.categoryEdited
      })
      this.categoryEdited = {}
    }
  }
}
</script>

<style scoped></style>
