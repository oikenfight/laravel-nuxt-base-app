<template>
  <v-container>
    <v-row align="start" justify="center">
      <v-col cols="11">
        <!-- note title-->
        <noteTitle></noteTitle>

        <v-divider></v-divider>

        <!-- note body -->
        <v-row v-for="itemId in note.itemIds" :key="itemId">
          <v-col
            cols="12"
            :class="{ itemSelected: itemIdActive === itemId }"
            @mouseenter="itemIdActive = itemId"
            @mouseleave="itemIdActive = null"
          >
            <!-- アイテム編集コンポーネント -->
            <itemEdit
              v-if="itemIdEdited === itemId"
              :itemId="itemIdEdited"
              @update="updatedItem"
            ></itemEdit>

            <!-- アイテム表示コンポーネント -->
            <itemShow
              v-else
              :item="item(itemId)"
              :isActive="itemIdActive === itemId"
              @edit="editItem"
            ></itemShow>
          </v-col>
        </v-row>
        <v-divider />
        <!-- new item -->
        <v-row justify="center" style="height: 20px; position: relative">
          <v-fab-transition>
            <v-btn color="" dark right absolute bottom fab @click="addItem">
              <v-icon>mdi-plus</v-icon>
            </v-btn>
          </v-fab-transition>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import noteTitle from '@/components/note/title.vue'
import itemEdit from '@/components/note/itemEdit.vue'
import itemShow from '@/components/note/itemShow.vue'

export default {
  name: 'Note',
  layout: 'default',
  middleware: 'auth',
  components: {
    noteTitle,
    itemEdit,
    itemShow
  },
  data() {
    return {
      note: {},
      itemIdActive: null, // item の mouseover/mouseout でセット
      itemIdEdited: null // 編集中 Item
    }
  },
  computed: {
    ...mapGetters({
      user: 'user', // ログインユーザ
      noteVuex: 'note/note',
      item: 'item/item' // itemId を引数に、Item オブジェクトを取得
    })
  },
  mounted() {
    this.note = this.noteVuex(this.$route.params.note)
  },
  methods: {
    ...mapActions({}),
    addItem() {
      this.$store.dispatch('notes/addItem')
      // 新規追加された item の ID を取得
      const newItemId = this.noteEdited.itemIds.slice(-1)[0]
      this.initItemEdited(newItemId)
    },
    editItem({ item }) {
      this.itemIdEdited = item.id
    },
    updatedItem() {
      this.itemIdEdited = null
    }
  }
}
</script>

<style scoped>
.itemSelected {
  background-color: #808080;
}
</style>
