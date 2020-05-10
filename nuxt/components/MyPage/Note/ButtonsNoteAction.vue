<template>
  <v-row class="d-flex justify-space-between" style="margin-right: 30px;">
    <!--  left content  -->
    <v-col cols="7" class="py-0 pl-5">
      <v-row>
        <v-col cols="5" class="pa-0 py-0">
          <v-row>
            <v-col cols="5" class="pa-0 d-flex justify-end">
              <v-subheader class="">Category:</v-subheader>
            </v-col>
            <v-col cols="7" class="pa-0">
              <v-select
                v-model="input.category"
                :items="categoriesSelectable"
                item-text="name"
                label=""
                dense
                return-object
                @change="updateNoteCategory"
              ></v-select>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="7" class="pa-0 py-0">
          <v-row>
            <v-col cols="3" class="pa-0 d-flex justify-end">
              <v-subheader class="">Tags:</v-subheader>
            </v-col>
            <v-col cols="8" class="pa-0">
              <v-select :items="tagsAll" label="" dense></v-select>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-col>

    <!-- center content -->
    <div class="display-1"></div>

    <v-col>
      <v-row justify="end">
        <v-switch
          v-model="input.status"
          :true-value="statusValues.true"
          :false-value="statusValues.false"
          :label="statusMessage"
          style="margin: 0 20px 0 0"
          @change="updateNoteStatus"
        >
        </v-switch>

        <!-- action buttons -->
        <v-item-group>
          <v-btn small color="red" dark @click="deleteNote">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
          <!-- TODO: HTML にエクスポートできるようにする -->
          <v-btn disabled small @click="exportHtml">
            <v-icon>mdi-language-html5</v-icon>
          </v-btn>
          <!-- TODO: Markdown にエクスポートできるようにする -->
          <v-btn disabled small @click="exportMarkdown">
            <v-icon>mdi-markdown</v-icon>
          </v-btn>
        </v-item-group>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'ButtonsNoteAction',
  props: {
    noteEdited: Object
  },
  data() {
    return {
      note: {},
      input: {
        category: {},
        status: null
      },
      statusValues: {
        true: 1,
        false: 0
      },
      statusMessages: {
        true: '公開中',
        false: '下書き'
      },
      categoriesSelectable: [{ id: null, name: '' }],
      tagsAll: ['tag1', 'tag2', 'tag3', 'tag4']
    }
  },
  computed: {
    ...mapGetters({
      categoriesAll: 'category/categoriesAll',
      category: 'category/category'
    }),
    statusMessage() {
      return this.note.status === 1
        ? this.statusMessages.true
        : this.statusMessages.false
    }
  },
  watch: {
    noteEdited(val, oldVal) {
      this.note = Object.assign({}, this.noteEdited)
      this.input.status = this.note.status
      this.input.category = this.note.category_id
        ? this.category(this.note.category_id)
        : null
    },
    categoriesAll(val, old) {
      this.categoriesSelectable = this.categoriesSelectable.concat(
        this.categoriesAll
      )
    }
  },
  mounted() {
    this.note = Object.assign({}, this.noteEdited)
    // 選択可能なカテゴリをセット
    this.categoriesSelectable = this.categoriesSelectable.concat(
      this.categoriesAll
    )
    // カテゴリの初期値をセット
    this.input.category = this.note.category_id
      ? this.category(this.note.category_id)
      : null
    // ステータスの初期値をセット
    this.input.status = this.note.status
  },
  methods: {
    ...mapActions({}),
    deleteNote() {
      this.$store.dispatch('note/delete', { note: this.noteEdited })
      this.$router.push('/folder/' + this.$route.params.folder)
    },
    updateNoteCategory() {
      console.log('updateNoteCategory method')
      this.note.category_id = this.input.category.id
      this.$store.dispatch('note/update', { note: this.note })
    },
    updateNoteStatus() {
      console.log('updateNoteStatus method')
      this.note.status = this.input.status
      this.$store.dispatch('note/update', { note: this.note })
    },
    exportHtml() {
      console.log('export HTML')
    },
    exportMarkdown() {
      console.log('export Markdown')
    }
  }
}
</script>

<style>
.v-text-field {
  padding-top: 4px;
  margin-top: 4px;
}
</style>
