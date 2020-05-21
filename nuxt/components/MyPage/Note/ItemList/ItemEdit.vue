<template>
  <!-- edit -->
  <v-row>
    <!-- ここにkeyイベントを仕込むのは気持ち悪いけど、v-markdown-editorの仕様上仕方ない -->
    <v-col
      cols="12"
      class="px-3"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent="updateIf"
      @keydown.enter.shift.exact="newLine($event)"
      @keydown.delete="deleteIf"
    >
      <client-only>
        <markdown-editor
          v-model="body"
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
      // itemEdited: 'item/itemEdited',
      itemEmpty: 'item/itemEmpty',
      editedItemBody: 'item/editedItemBody'
    }),
    body: {
      get() {
        return this.editedItemBody
      },
      set(value) {
        this.$store.commit('item/UPDATE_EDITED_ITEM_BODY', { value })
      }
    }
  },
  watch: {
    body(val, oldVal) {
      this.oldBody = oldVal
    }
    // 'itemEdited.body'(val, oldVal) {
    //   this.oldBody = oldVal
    // }
  },
  mounted() {
    // this.oldBody = this.itemEdited.body
    this.oldBody = this.editedItemBody
  },
  methods: {
    newLine(event) {
      // もともと enter で発生していたイベント
      event.returnValue = true
    },
    updateIf() {
      // composing フラグで変換中か確認してから update する
      if (!this.composing) {
        // v-markdown-editor の仕様上、keyイベントがどうしても改行後になってしまうため、改行前の値をセットし直す
        // TODO: 文の途中でenterが押された場合、enterが押された場所までをそのbodyとする
        this.$store.commit('item/UPDATE_EDITED_ITEM_BODY', {
          value: this.oldBody
        })
        this.$emit('updated', { item: this.itemEdited })
      }
    },
    deleteIf() {
      // bodyが空でdeleteキーが押された場合、編集中のitemを削除する
      if (this.editedItemBody === '' && this.oldBody === '') {
        this.$emit('remove')
      } else if (this.editedItemBody === '') {
        this.oldBody = ''
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
