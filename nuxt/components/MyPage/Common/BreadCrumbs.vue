<template>
  <v-row>
    <v-col cols="12">
      <v-breadcrumbs :items="breadcrumbsItems">
        <template v-slot:divider>
          <v-icon>mdi-chevron-right</v-icon>
        </template>
      </v-breadcrumbs>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'BreadCrumbs',
  props: {
    breadcrumbsItems: Array
  },
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

<style scoped></style>
