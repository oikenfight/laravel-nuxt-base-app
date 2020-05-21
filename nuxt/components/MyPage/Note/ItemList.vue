<template>
  <v-row>
    <!-- Display Note Contents -->
    <v-col
      v-for="(item, index) in itemsNote"
      :key="item.id"
      cols="12"
      class="pa-0"
      @click="select(index)"
    >
      <Item :item="item" :index="index" :note="note"></Item>
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
      itemsNote: 'item/itemsNote',
      saveStatusIsUnsaved: 'item/saveStatusIsUnsaved',
      editingStopTime: 'item/editingStopTime'
    })
  },
  watch: {
    noteItems: {
      handler(val, oldVal) {
        console.log('noteItems is updated')
      },
      deep: true
    }
  },
  mounted() {
    this.$store.dispatch('item/fetchNoteItems', { note: this.note })
    this.updateItemsNoteIfChanged()
  },
  methods: {
    ...mapActions({}),
    select(index) {
      // this.$store.commit('item/SET_ITEM_EDITED', { item })
      this.$store.commit('item/SET_ACTIVE_INDEX', { index })
    },
    updateItemsNoteIfChanged() {
      setInterval(() => {
        // 変更があるか、編集停止時間が5秒を超えたかどうか
        if (this.saveStatusIsUnsaved && this.editingStopTime > 5) {
          console.log('execute update')
          // TODO: 対象itemsを更新する
          // TODO: 更新中statusをsavingにする
          this.$store.commit('item/TOGGLE_SAVE_STATUS', { status: 'saved' })
          this.$store.commit('item/SET_EDITING_STOP_TIME', { time: 0 })
        } else if (this.saveStatusIsUnsaved) {
          this.$store.commit('item/SET_EDITING_STOP_TIME', {
            time: this.editingStopTime + 1 // 1秒更新
          })
          console.log(this.editingStopTime)
        }
      }, 1000)
    }
  }
}
</script>

<style scoped></style>
