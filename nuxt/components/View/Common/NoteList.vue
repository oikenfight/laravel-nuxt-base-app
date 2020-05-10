<template>
  <v-row justify="center">
    <v-col
      v-for="note in notes"
      :key="note.id"
      cols="auto"
      class="pa-5"
      @click="select(note)"
    >
      <v-card width="600" @click="select(note)">
        <v-img src="" class="white--text align-end" height="250px"></v-img>
        <v-card-title
          class="pa-2 card-title-truncate title cardTitle justify-start"
          style="max-height: 70px; margin-left: 15px;"
          v-text="note.name"
        >
        </v-card-title>

        <v-card-text
          class="pa-2 text--secondary card-text-truncate body-1 font-weight-light"
          style="max-height: 100px;"
        >
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-actions class="pa-1">
          <v-btn color="orange" text>
            Share hoge
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'NoteList',
  props: {
    notes: Array
  },
  data() {
    return {}
  },
  methods: {
    select(note) {
      this.$router.push('/' + note.id)
    }
  }
}
</script>

<style scoped>
.card-title-truncate {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  width: 100%;
  letter-spacing: 1.5px !important;
  line-height: 1.4;
}

.card-text-truncate {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 4;
  overflow: hidden;
  width: 100%;
  letter-spacing: 1.5px !important;
  line-height: 1.4;
}

.card-action-bottom {
  position: absolute;
  bottom: 0;
}
.v-card__title {
  -webkit-box-align: start;
}
</style>
