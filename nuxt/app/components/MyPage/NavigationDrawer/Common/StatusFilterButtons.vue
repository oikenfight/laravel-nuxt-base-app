<template>
  <v-row justify="center">
    <v-btn-toggle v-model="currentStatus" value="" mandatory dense>
      <v-btn :value="noteStatuses.nonReleased">
        <v-icon small>mdi-lock</v-icon>
      </v-btn>
      <v-btn class="body-2" :value="noteStatuses.all">all</v-btn>
      <v-btn :value="noteStatuses.released">
        <v-icon small>mdi-lock-open-outline</v-icon>
      </v-btn>
    </v-btn-toggle>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'StatusFilterButtons',
  props: {},
  data() {
    return {
      noteStatuses: this.$constants.noteStatuses
    }
  },
  computed: {
    ...mapGetters({
      currentNoteStatus: 'currentNoteStatus'
    }),
    currentStatus: {
      get() {
        return this.currentNoteStatus
      },
      set(value) {
        this.$store.commit('setCurrentNoteStatus', { noteStatus: value })
      }
    }
  },
  mounted() {},
  methods: {
    ...mapActions({})
  }
}
</script>

<style scoped></style>
