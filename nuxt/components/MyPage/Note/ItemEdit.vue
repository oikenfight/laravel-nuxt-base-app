<template>
  <!-- edit -->
  <v-row>
    <!-- ここにkeyイベントを仕込むのは気持ち悪いけど、v-markdown-editorの仕様上仕方ない -->
    <v-col
      cols="12"
      class="px-3"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent
      @keydown.enter.exact="update"
      @keydown.enter.shift.exact="newLine($event)"
    >
      <client-only>
        <markdown-editor
          v-model="item.body"
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
  props: ['itemEdited'],
  data() {
    return {
      item: {},
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
    ...mapGetters({})
  },
  mounted() {
    this.item = Object.assign({}, this.itemEdited)
  },
  methods: {
    update() {
      // keyupイベントだと変換中かどうか判定できないので、keydownイベントで実行してる
      // composing フラグで変換中か確認してから update する
      if (!this.composing) {
        this.$store.dispatch('item/update', { item: this.item })
        this.$emit('updatedItem')
        this.$emit('moveNextItem')
        this.item = {}
      }
    },
    newLine(event) {
      // もともと enter で発生していたイベント
      event.returnValue = true
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
