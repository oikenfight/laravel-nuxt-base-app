<template>
  <!-- edit -->
  <v-row>
    <!-- ここにkeyイベントを仕込むのは気持ち悪いけど、v-markdown-editorの仕様上仕方ない -->
    <v-col
      cols="12"
      class="px-3"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent="updateIfNotComposing($event)"
      @keydown.enter.shift.exact="newLine($event)"
      @keydown.delete="deleteIfBodyIsNull"
    >
      <client-only>
        <markdown-editor
          v-model="item"
          height="auto"
          toolbar=""
          theme="primary"
          class="v-md-auto-resize"
        ></markdown-editor>
      </client-only>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'ItemEdit',
  props: {
    note: Object
  },
  data() {
    return {
      oldBody: {}, // イベント時の判定のため、前のitemオブジェクトを保持
      composing: false, // 変換中true
      // default options, see more options at: http://codemirror.net/doc/manual.html#config
      options: {
        // lineNumbers: true,
        // styleActiveLine: true,
        // styleSelectedText: true,
        // lineWrapping: true,
        // indentWithTabs: true,
        // tabSize: 2,
        // indentUnit: 2
      }
    }
  },
  computed: {
    ...mapGetters({
      itemGetter: 'item/item',
      itemEdited: 'item/itemEdited'
    }),
    item: {
      get() {
        return this.itemEdited.body
      },
      set(value) {
        this.$store.commit('item/UPDATE_ITEM_BODY', value)
      }
    }
  },
  watch: {
    'itemEdited.body'(val, oldVal) {
      this.oldBody = oldVal
    }
  },
  mounted() {
    this.oldBody = this.itemEdited.body
  },
  methods: {
    newLine(event) {
      // もともと enter で発生していたイベント
      event.returnValue = true
    },
    updateIfNotComposing() {
      // composing フラグで変換中か確認してから update する
      if (!this.composing) {
        // v-markdown-editor の仕様上、keyイベントがどうしても改行後になってしまうため、改行前の値をセットし直す
        this.$store.commit('item/UPDATE_ITEM_BODY', this.oldBody)
        // TODO: 文の途中でenterが押された場合、enterが押された場所までをそのbodyとする
        this.updateIfChanged()
        // this.$store.dispatch('item/update', { item: this.itemEdited })
        // 次のitemを作成する
        this.$store.dispatch('item/setItemEdited', {})
        // this.$store.dispatch('item/create')
        // TODO: note.item_ids を更新する
        // TODO: 追加したitemを編集状態にする
      }
    },
    deleteIfBodyIsNull() {
      if (this.itemEdited.body === '' && this.oldBody === '') {
        // itemを削除する
        this.$store.dispatch('item/delete', { item: this.itemEdited })
        // TODO: note.item_ids を更新する
        // TODO: 前のitemを編集状態にする
        this.$store.dispatch('item/setItemEdited', {})
      } else {
        this.oldBody = ''
      }
    },
    updateIfChanged() {
      const item = this.itemGetter(this.itemEdited.id)
      if (item.body !== this.itemEdited.body) {
        this.$store.dispatch('item/update', { item: this.itemEdited })
      }
    }
  }
}
</script>

<style>
.v-md-auto-resize .CodeMirror-scroll {
  overflow: auto;
  height: auto;
  overflow: visible;
  position: relative;
  outline: none;
  min-height: 30px !important;
}
.v-md-container {
  border: 0;
}
</style>
