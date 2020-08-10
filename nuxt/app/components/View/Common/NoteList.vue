<template>
  <v-row justify="center">
    <v-col v-for="note in notes" :key="note.id" cols="auto" class="pa-5">
      <v-card width="600" @click="select(note)">
        <v-img
          :src="require('@/assets/img/noimage.png')"
          class="white--text align-end"
          height="250px"
        ></v-img>
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
          {{ note.head_body }}
        </v-card-text>

        <v-divider class="mx-4"></v-divider>

        <v-card-actions>
          <v-list-item class="grow">
            <v-list-item-avatar color="grey lighten-3">
              <!--  <v-img-->
              <!--    class="elevation-6"-->
              <!--    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"-->
              <!--  ></v-img>-->
              <v-icon>mdi-account</v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>{{ note.username }}</v-list-item-title>
            </v-list-item-content>

            <v-row align="center" justify="end">
              <v-icon class="mr-1">mdi-heart</v-icon>
              <span class="subheading mr-2">{{ heartNum }}</span>
              <span class="mr-1"> </span>
              <v-icon class="mr-1">mdi-share-variant</v-icon>
              <span class="subheading">{{ shareNum }}</span>
            </v-row>
          </v-list-item>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'NoteList',
  props: {
    notes: Array,
    select: Function
  },
  data() {
    return {
      heartNum: 0,
      shareNum: 0
    }
  },
  methods: {}
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
