<template>
  <!-- edit -->
  <v-row>
    <v-col
      cols="12"
      class="px-3"
      @keydown.enter.exact.prevent
      @keyup.enter.exact="update"
      @keydown.enter.shift.exact="newLine($event)"
    >
      <client-only>
        <markdown-editor
          v-model="item.body"
          height="auto"
          toolbar=""
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
      this.$store.dispatch('item/update', { item: this.item })
      this.$emit('updatedItem')
      this.$emit('moveNextItem')
      this.item = {}
    },
    newLine(event) {
      // もともと enter で発生していたイベント
      event.returnValue = true
    }
  }
}
</script>

<style scoped>
.v-md-auto-resize .CodeMirror-scroll {
  overflow: auto;
  height: auto;
  overflow: visible;
  position: relative;
  outline: none;
  min-height: 30px !important;
}
</style>
