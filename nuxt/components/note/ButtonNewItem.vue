<template>
  <v-row justify="center" style="position: relative">
    <v-fab-transition>
      <v-btn color="" dark right absolute top fab @click="addItem">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-fab-transition>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ButtonNewItem',
  props: ['note'],
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    async addItem() {
      const item = await this.$store.dispatch('item/create', {
        note: this.note
      })
      this.$store.dispatch('note/addItem', {
        note: this.note,
        item
      })
    }
  }
}
</script>

<style scoped></style>
