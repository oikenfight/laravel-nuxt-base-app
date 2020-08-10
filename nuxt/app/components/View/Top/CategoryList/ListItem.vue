<template>
  <v-row>
    <v-col cols="12" class="pa-0 ma-0">
      <span class="subtitle2">
        {{ category.name }}
      </span>
      <span> （{{ notesLength }}）</span>
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
      notesCategory: 'view/note/notesCategory'
    }),
    notesLength() {
      return this.notesCategory(this.category.id).length
    }
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped></style>
