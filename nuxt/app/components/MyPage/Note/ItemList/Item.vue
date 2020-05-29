<template>
  <v-row>
    <!-- ButtonItemMenu -->
    <v-col cols="1" class="pa-0">
      <ButtonItemMenu v-if="shouldShowItemMenu" :item="item"></ButtonItemMenu>
    </v-col>
    <!-- ItemEdit if this is selected -->
    <v-col v-if="isEdit(item)" cols="10" class="pa-0">
      <ItemEdit
        :note="note"
        @updated="updated"
        @remove="remove"
        @moveNext="moveNext"
        @movePrevious="movePrevious"
      ></ItemEdit>
    </v-col>
    <!-- ItemShow if this is not selected-->
    <v-col v-else cols="10" class="pa-0">
      <ItemShow :item="item" style="min-height: 48px"></ItemShow>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ButtonItemMenu from '@/components/MyPage/Note/ItemList/ButtonItemMenu'
import ItemEdit from '@/components/MyPage/Note/ItemList/ItemEdit.vue'
import ItemShow from '@/components/MyPage/Note/ItemList/ItemShow.vue'

export default {
  name: 'Item',
  components: { ButtonItemMenu, ItemEdit, ItemShow },
  props: {
    item: Object,
    index: Number,
    note: Object
  },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      // itemEdited: 'item/itemEdited',
      itemEmpty: 'item/itemEmpty',
      activeIndex: 'item/activeIndex'
    }),
    shouldShowItemMenu() {
      return this.isEdit() && this.item.body === ''
    }
  },
  watch: {
    item: {
      handler(val, oldVal) {
        console.log('item is updated', this.item)
        this.$store.commit('item/SET_TIME_EDITING_STOP', { time: 0 })
        this.$store.commit('item/TOGGLE_SAVE_STATUS', { status: 'unsaved' })
      },
      deep: true
    }
  },
  methods: {
    ...mapActions({}),
    isEdit() {
      // return this.itemEdited ? this.itemEdited.id === this.item.id : false
      return this.index === this.activeIndex
    },
    updated({ item }) {
      // 次のitemを作成して、noteItemsに作成したitemを追加する
      this.createNextItem()
      // 追加したitemに移動する
      this.moveNext()
    },
    remove() {
      // 削除
      this.$store
        .dispatch('item/delete', { item: this.item })
        .catch((error) => {
          console.log(error)
        })
      this.$store.commit('item/DELETE_NOTE_ITEM', { index: this.index })
      // 前のitemに移動する
      this.movePrevious()
      // 削除の場合もorder_indexの更新が必要なため、変更ありステータスにする
      this.$store.commit('item/TOGGLE_SAVE_STATUS', { status: 'unsaved' })
      this.$store.commit('item/SET_TIME_EDITING_STOP', { time: 0 })
    },
    moveNext() {
      this.$store.commit('item/SET_ACTIVE_INDEX', { index: this.index + 1 })
    },
    movePrevious() {
      this.$store.commit('item/SET_ACTIVE_INDEX', { index: this.index - 1 })
    },
    createNextItem() {
      // 新規itemを作成（後のAPIで作成したものに置き換えられる）
      const itemNew = Object.assign({}, this.itemEmpty)
      const itemIndex = this.index + 1 // 現在のindexの次に作成したitemを追加する
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
      return itemNew
    }
  }
}
</script>

<style scoped></style>
