<template>
  <v-row justify="center">
    <v-col cols="9" class="pr-0">
      <div>
        <span class="subtitle white--text">
          {{ currentMenu.headerText }}
        </span>
      </div>
    </v-col>
    <v-col cols="3" class="pl-0 pt-2">
      <v-btn color="white" text dark small @click="headerAction">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'ContentHeader',
  props: {
    currentMenu: Object,
    headerAction: Function
  },
  data() {
    return {}
  },
  methods: {}
}
</script>

<style scoped></style>
