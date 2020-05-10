<template>
  <v-row>
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
      <span> （{{ countNoteReleasedInCategory }}） </span>
      <span style="float: right;">
        <!-- Rack アクションメニュー -->
        <CategoryActionMenu
          :category="category"
          @edit="edit"
        ></CategoryActionMenu>
      </span>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import CategoryActionMenu from '@/components/MyPage/NavigationDrawer/ListPublic/CategoryActionMenu.vue'

export default {
  name: 'ListItem',
  components: { CategoryActionMenu },
  props: {
    category: Object
  },
  data() {
    return {
      categoryEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      notesReleasedOfCategory: 'note/notesReleasedOfCategory'
    }),
    countNoteReleasedInCategory() {
      return this.notesReleasedOfCategory(this.category.id).length
    }
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
