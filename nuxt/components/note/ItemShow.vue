<template>
  <!-- display -->
  <v-row>
    <v-col cols="12" class="px-2 py-0">
      <!--  markdown show  -->
      <div v-if="item" v-html="$md.render(item.body)" style="margin: 0"></div>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ItemShow',
  props: ['item'],
  data() {
    return {}
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped>
.v-application p {
  margin-bottom: 0 !important;
}
</style>
