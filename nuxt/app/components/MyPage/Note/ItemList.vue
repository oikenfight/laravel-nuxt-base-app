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
      timer: null
    }
  },
  computed: {
    ...mapGetters({
      itemsNote: 'item/itemsNote',
      saveStatusIsUnsaved: 'item/saveStatusIsUnsaved',
      timeEditingStop: 'item/timeEditingStop'
    })
  },
  mounted() {
    this.$store.dispatch('item/fetchNoteItems', { note: this.note })
    this.startTimer()
    console.log('mounted')
  },
  destroyed() {
    clearInterval(this.timer)
  },
  methods: {
    ...mapActions({}),
    select(index) {
      // this.$store.commit('item/SET_ITEM_EDITED', { item })
      this.$store.commit('item/SET_ACTIVE_INDEX', { index })
    },
    startTimer() {
      // noteの変更を監視して、更新かつ一定時間変更なしのとき、ノートを更新する
      // TODO: 別ページに飛んだときに消さないとずっと回り続けるから止める！
      this.timer = setInterval(() => {
        console.log('interval')
        // 変更があるか、編集停止時間が5秒を超えたかどうか
        if (this.saveStatusIsUnsaved && this.timeEditingStop > 5) {
          this.updateNoteItems()
        } else if (this.saveStatusIsUnsaved) {
          this.$store.commit('item/SET_TIME_EDITING_STOP', {
            time: this.timeEditingStop + 1 // 1秒更新
          })
          console.log(this.timeEditingStop)
        }
      }, 1000)
    },
    updateNoteItems() {
      console.log('execute update')
      // 更新中statusをsavingにする
      this.$store.commit('item/TOGGLE_SAVE_STATUS', { status: 'saving' })
      this.$store.commit('item/SET_TIME_EDITING_STOP', { time: 0 })
      // 対象itemsを更新する
      this.$store
        .dispatch('item/updateNoteItems', { items: this.itemsNote })
        .then(() => {
          this.$store.commit('item/TOGGLE_SAVE_STATUS', { status: 'saved' })
          console.log('updated !!!!')
        })
        .catch((error) => {
          console.log(error)
          console.log('here is error')
        })
    }
  }
}
</script>

<style scoped></style>
