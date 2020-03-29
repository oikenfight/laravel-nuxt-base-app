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
    <div v-if="item" class="ma-1" v-html="$md.render(item.body)"></div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ItemShow',
  props: ['itemId', 'isActive'],
  data() {
    return {
      item: null
    }
  },
  computed: {
    ...mapGetters({
      itemVuex: 'item/item'
    })
  },
  mounted() {
    this.item = this.itemVuex(this.itemId)
    console.log(this.item.body)
  },
  methods: {
    ...mapActions({}),
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
