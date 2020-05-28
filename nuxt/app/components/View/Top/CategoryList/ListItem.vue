<template>
  <v-row>
    <v-col cols="12" class="pa-0 ma-0">
      <span class="subtitle2">
        {{ category.name }}
      </span>
      <span> （{{ countNoteReleasedInCategory }}）</span>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ListItem',
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
    ...mapActions({})
  }
}
</script>

<style scoped></style>
