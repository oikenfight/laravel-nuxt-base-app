<template>
  <v-row justify="center" style="position: relative">
    <v-fab-transition>
      <v-btn color="grey" dark right absolute top fab @click="newItem">
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
    ...mapGetters({
      itemEmpty: 'item/itemEmpty',
      activeIndex: 'item/activeIndex'
    })
  },
  methods: {
    ...mapActions({}),
    newItem() {
      // 新規itemを作成（後のAPIで作成したものに置き換えられる）
      const itemNew = Object.assign({}, this.itemEmpty)
      const itemIndex = this.note.item_ids.length
      // itemをnoteに追加
      this.$store.commit('item/ADD_NOTE_ITEM', {
        item: itemNew,
        index: itemIndex
      })
      // API でitemを作成し、前で一時的に作成したitem（item.id）を更新する
      this.$store.dispatch('item/create', { note: this.note }).then((item) => {
        this.$store.commit('item/UPDATE_NOTE_ITEM', {
          item,
          index: itemIndex
        })
      })
      // 作成したアイテムを編集中にする
      this.$store.commit('item/SET_ACTIVE_INDEX', { index: itemIndex })
    }
  }
}
</script>

<style scoped></style>
