<template>
  <!-- edit -->
  <div>
    <v-textarea
      v-model="item.body"
      label="item body"
      auto-grow
      outlined
      rows="3"
      row-height="15"
    >
      <template v-slot:append-outer>
        <v-btn class="ma-1" color="" icon @click="update">
          <v-icon>mdi-send</v-icon>
        </v-btn>
      </template>
    </v-textarea>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ItemEdit',
  props: ['note', 'itemId'],
  data() {
    return {
      item: {}
    }
  },
  computed: {
    ...mapGetters({
      itemGetter: 'item/item' // itemId を引数に、Item オブジェクトを取得
    })
  },
  mounted() {
    this.item = Object.assign({}, this.itemGetter(this.itemId))
  },
  methods: {
    update() {
      this.$store.dispatch('item/update', { item: this.item })
      this.$emit('updatedItem')
      this.item = {}
    }
  }
}
</script>

<style scoped></style>
