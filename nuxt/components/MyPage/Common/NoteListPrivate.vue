<template>
  <v-row justify="center">
    <v-col v-for="note in notes" :key="note.id" cols="auto" class="pa-5">
      <v-card height="300" width="200" @click="select(note)">
        <v-img src="" class="white--text align-end" height="125px"></v-img>
        <v-card-title
          class="pa-2 card-text-truncate"
          style="max-height: 90px; text-align: left;"
          v-text="note.name"
        ></v-card-title>
        <v-card-text
          class="pa-2 text--primary card-text-truncate"
          style="max-height: 63px;"
        >
          Whitehaven Beach hogehoge hogehoge hogehoge hogeh hogehoge unko ho ho
          hoge hogehoge hoge hogehoge
        </v-card-text>
        <v-card-actions class="pa-1 card-action-bottom" style="height: 30px;">
          <v-btn color="orange" text>
            Share
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'NoteList',
  props: {
    notes: Array
  },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({})
  },
  methods: {
    ...mapActions({}),
    select(note) {
      this.$router.push('/mypage/folder/' + this.folder.id + '/note/' + note.id)
    }
  }
}
</script>

<style scoped>
.card-text-truncate {
  overflow: hidden;
  width: 100%;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-height: 1.3;
}

.card-action-bottom {
  position: absolute;
  bottom: 0;
}
</style>
