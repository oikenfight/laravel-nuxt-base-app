<template>
  <v-row class="pa-0">
    <!-- if:Edit Text-Field -->
    <v-col
      v-if="isEditing(rack)"
      @compositionstart="composing = true"
      @compositionend="composing = false"
      @keydown.enter.exact.prevent
      @keydown.enter.exact="update"
    >
      <v-text-field
        v-model="rackEdited.name"
        outlined
        dense
        hide-details
      ></v-text-field>
    </v-col>
    <v-col v-else cols="12" class="text-truncate pa-0 ma-0">
      <span
        class="subtitle-1"
        style="display: inline-block; padding: 4px 0 0 15px;"
      >
        {{ rack.name }}
      </span>
      <span style="float: right;">
        <!-- Rack アクションメニュー -->
        <ActionMenuRack :rack="rack" @edit="edit"></ActionMenuRack>
      </span>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ActionMenuRack from '@/components/MyPage/NavigationDrawer/MyLogs/ActionMenuRack.vue'

export default {
  name: 'ListItemRack',
  components: { ActionMenuRack },
  props: {
    rack: Object
  },
  data() {
    return {
      rackEdited: {},
      composing: false // 変換中true
    }
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    isEditing(rack) {
      return this.rackEdited && this.rackEdited.id === rack.id
    },
    edit({ rack }) {
      this.rackEdited = Object.assign({}, rack)
    },
    update() {
      if (!this.composing) {
        this.$store.dispatch('rack/update', {
          rack: this.rackEdited
        })
        this.rackEdited = {}
      }
    }
  }
}
</script>

<style scoped></style>
