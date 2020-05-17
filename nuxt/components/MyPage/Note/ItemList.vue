<template>
  <v-row>
    <!-- Display Note Contents -->
    <v-col
      v-for="item in items(note.item_ids)"
      :key="item.id"
      cols="12"
      class="pa-0"
      @click="select(item)"
    >
      <Item :item="item" :note="note"></Item>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Item from '@/components/MyPage/Note/ItemList/Item'

export default {
  name: 'ItemList',
  components: { Item },
  props: {
    note: Object
  },
  data() {
    return {
      // itemEdited: null // 編集中 Item
    }
  },
  computed: {
    ...mapGetters({
      itemGetter: 'item/item',
      items: 'item/items'
      // itemEdited: 'item/itemEdited'
    })
  },
  methods: {
    ...mapActions({}),
    select(item) {
      this.$store.dispatch('item/setItemEdited', { item })
    }
  }
}
</script>

<style scoped></style>
