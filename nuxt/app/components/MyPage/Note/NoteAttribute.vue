<template>
  <v-row>
    <!-- Category -->
    <v-col cols="5">
      <v-select
        v-model="input.category"
        :items="categoriesSelectable"
        item-text="name"
        label="Category"
        return-object
        height="36"
        @change="updateCategory"
      ></v-select>
    </v-col>

    <!-- Tag -->
    <v-col cols="7">
      <v-select
        :items="tagsAll"
        label="Tags (not working)"
        multiple
        chips
        dense
      ></v-select>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ButtonsNoteAction',
  props: {
    noteEdited: Object
  },
  data() {
    return {
      note: {},
      input: {
        status: null
      },
      categoriesSelectable: [{ id: null, name: '' }],
      tagsAll: ['tag1', 'tag2', 'tag3', 'tag4']
    }
  },
  computed: {
    ...mapGetters({
      categoriesAll: 'category/categoriesAll',
      category: 'category/category'
    })
  },
  watch: {
    noteEdited(val, oldVal) {
      this.note = Object.assign({}, this.noteEdited)
      this.input.category = this.note.category_id
        ? this.category(this.note.category_id)
        : null
    },
    categoriesAll(val, old) {
      this.categoriesSelectable = this.categoriesSelectable.concat(
        this.categoriesAll
      )
    }
  },
  mounted() {
    this.note = Object.assign({}, this.noteEdited)
    // 選択可能なカテゴリをセット
    this.categoriesSelectable = this.categoriesSelectable.concat(
      this.categoriesAll
    )
    // カテゴリの初期値をセット
    this.input.category = this.note.category_id
      ? this.category(this.note.category_id)
      : null
  },
  methods: {
    ...mapActions({}),
    updateCategory() {
      console.log('updateNoteCategory method')
      this.note.category_id = this.input.category.id
      this.$store.dispatch('note/update', { note: this.note })
    }
  }
}
</script>

<style>
.v-text-field {
  padding-top: 4px;
  margin-top: 4px;
}
</style>
