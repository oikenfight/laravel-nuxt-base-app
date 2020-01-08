<template>
  <v-container fluid class="grey lighten-4" style="height: 100%;">
    <v-row v-if="!note">
      open note !!
    </v-row>
    <v-row v-else>
      <v-col cols="12">
        <v-row align="start" justify="center">
          <v-col cols="11">
            <v-text-field :value="title" label="title" @change="inputTitle" />
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12">
        <v-row align="start" justify="center">
          <v-col cols="11">
            <div v-html="$md.render(input)"></div>
          </v-col>
        </v-row>
      </v-col>
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
      note: 'notes/note'
    }),
    title() {
      return this.note.title
    }
  },
  method: {
    ...mapActions({
      inputTitle: ''
    })
  }
}
</script>
