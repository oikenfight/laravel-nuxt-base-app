<template>
  <!-- edit -->
  <div>
    <v-textarea
      v-model="itemEdited.body"
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
  props: ['itemId'],
  data() {
    return {
      itemEdited: {}
    }
  },
  computed: {
    ...mapGetters({
      item: 'item/item' // itemId を引数に、Item オブジェクトを取得
    })
  },
  mounted() {
    this.itemEdited = Object.assign({}, this.item(this.itemId))
  },
  methods: {
    update() {
      this.$store.dispatch('item/update', this.itemEdited)
      this.$emit('update')
      this.itemEdited = {}
    }
  }
}
</script>

<style scoped></style>
