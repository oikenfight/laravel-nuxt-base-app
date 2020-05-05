<template>
  <!-- display -->
  <v-row
    align="center"
    :class="{ 'grey lighten-5': isActive }"
    @mouseenter="toggleActive"
    @mouseleave="toggleActive"
  >
    <v-col cols="12" class="pa-3">
      <!--  markdown show  -->
      <div v-if="item" style="margin: 0" v-html="$md.render(item.body)"></div>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ItemShow',
  props: ['item'],
  data() {
    return {
      isActive: false
    }
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    toggleActive() {
      this.isActive = !this.isActive
    }
  }
}
</script>

<style scoped>
.item-active {
  background-color: #808080;
}
</style>

<style>
.v-application p {
  margin-bottom: 0 !important;
}
</style>
