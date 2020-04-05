<template>
  <v-row justify="center" style="height: 20px; position: relative">
    <v-fab-transition>
      <v-btn color="" dark right absolute bottom fab @click="add">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-fab-transition>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ButtonNewItem',
  computed: {
    ...mapGetters({
      note: 'note/note'
    })
  },
  methods: {
    ...mapActions({}),
    async add() {
      const noteId = this.$route.params.note
      await this.$store.dispatch('note/addItem', { noteId })
      // 新規追加された item の ID を取得
      const itemId = this.note.itemIds.slice(-1)[0]
      this.$emit('addedItem', { itemId })
    }
  }
}
</script>

<style scoped></style>
