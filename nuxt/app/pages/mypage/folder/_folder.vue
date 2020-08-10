<template>
  <v-layout fill-height>
    <v-row justify="center">
      <v-col ref="titleHeader" cols="10" class="pb-0">
        <Header></Header>
      </v-col>

      <v-col ref="titleDivider" cols="10">
        <v-divider></v-divider>
      </v-col>

      <v-col cols="10" :style="childStyle">
        <nuxt-child></nuxt-child>
      </v-col>
    </v-row>
  </v-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import Header from '@/components/MyPage/Common/Header'
// import NotesSelectable from '@/components/note/NotesSelectable.vue'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: { Header },
  data() {
    return {
      folder: {},
      refs: {
        headerHeight: 0,
        dividerHeight: 0,
        footerHeight: 36
      }
    }
  },
  computed: {
    ...mapGetters({
      folderVuex: 'folder/folder'
    }),
    excludeHeight() {
      return (
        this.refs.headerHeight +
        this.refs.dividerHeight +
        this.refs.footerHeight
      )
    },
    childStyle() {
      return {
        width: '100%',
        height: 'calc(100vh - ' + this.excludeHeight + 'px)'
      }
    }
  },
  mounted() {
    this.folder = this.folderVuex(this.$route.params.folder)
    this.refs.headerHeight = this.$refs.titleHeader.clientHeight
    this.refs.dividerHeight = this.$refs.titleDivider.clientHeight
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
