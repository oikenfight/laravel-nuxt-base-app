<template>
  <!-- display -->
  <div>
    <!-- action buttons -->
    <v-btn-toggle v-if="isActive" class="float-right">
      <v-btn small @click="edit(item)">
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn small @click="remove(item)">
        <v-icon>mdi-delete</v-icon>
      </v-btn>
      <v-btn small>
        <v-icon>mdi-dots-horizontal</v-icon>
      </v-btn>
    </v-btn-toggle>

    <!--  markdown show  -->
    <div class="ma-1" v-html="$md.render(item.body)"></div>
  </div>
</template>

<script>
export default {
  name: 'ItemShow',
  props: ['item', 'isActive'],
  data() {
    return {}
  },
  methods: {
    edit(item) {
      this.$emit('edit', { item })
    },
    remove(item) {
      this.$store.dispatch('item/delete', { item })
      this.$store.dispatch('note/deleteItem', { item })
    }
  }
}
</script>

<style scoped></style>
