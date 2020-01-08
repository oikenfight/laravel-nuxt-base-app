<template>
  <v-container fluid class="grey lighten-4" style="height: 100%;">
    <v-row v-if="note">
      <v-col cols="12">
        <v-row align="start" justify="center">
          <v-col cols="11">
            <v-text-field v-model="newTitle" label="title" />
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row
          v-for="itemId in note.itemIds"
          :key="itemId"
          align="start"
          justify="center"
        >
          <v-col cols="11">
            <div v-html="$md.render(item(itemId))"></div>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row v-else>
      open note !!
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  layout: 'defualt',
  components: {},
  data() {
    return {
      input: '# hello World!'
    }
  },
  computed: {
    ...mapGetters({
      note: 'notes/note',
      item: 'notes/item'
    }),
    newTitle() {
      return this.note ? this.note.title : ''
    }
  },
  method: {
    ...mapActions({})
  }
}
</script>
