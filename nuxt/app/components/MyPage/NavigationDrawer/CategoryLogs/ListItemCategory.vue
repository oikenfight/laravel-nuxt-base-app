<template>
  <v-row>
    <!-- if:Edit Text-Field -->
    <v-col
      v-if="isEditing(category)"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent
      @keydown.enter.exact="update"
    >
      <v-text-field
        v-model="categoryEdited.name"
        outlined
        dense
        hide-details
      ></v-text-field>
    </v-col>
    <v-col v-else cols="12" class="text-truncate pa-0 ma-0">
      <span class="subtitle-2">{{ category.name }}</span>
      <span> （{{ noteCount }}） </span>
      <span style="float: right;">
        <!-- Rack アクションメニュー -->
        <ActionMenuCategory
          :category="category"
          @edit="edit"
        ></ActionMenuCategory>
      </span>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ActionMenuCategory from '@/components/MyPage/NavigationDrawer/CategoryLogs/ActionMenuCategory.vue'

export default {
  name: 'ListItemCategory',
  components: { ActionMenuCategory },
  props: {
    category: Object
  },
  data() {
    return {
      categoryEdited: {},
      composing: false // 変換中true
    }
  },
  computed: {
    ...mapGetters({
      categoryNotesByStatus: 'note/categoryNotesByStatus',
      currentNoteStatus: 'currentNoteStatus'
    }),
    noteCount() {
      return this.categoryNotesByStatus({
        categoryId: this.category.id,
        noteStatus: this.currentNoteStatus
      }).length
    }
  },
  methods: {
    ...mapActions({}),
    isEditing(category) {
      return this.categoryEdited && this.categoryEdited.id === category.id
    },
    edit({ category }) {
      this.categoryEdited = Object.assign({}, category)
    },
    update() {
      if (!this.composing) {
        this.$store.dispatch('category/update', {
          category: this.categoryEdited
        })
        this.categoryEdited = {}
      }
    }
  }
}
</script>

<style scoped></style>
