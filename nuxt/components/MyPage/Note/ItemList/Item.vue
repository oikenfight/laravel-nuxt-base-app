<template>
  <v-row>
    <!-- ButtonItemMenu -->
    <v-col cols="1" class="pa-0">
      <ButtonItemMenu v-if="shouldShowItemMenu" :item="item"></ButtonItemMenu>
    </v-col>
    <!-- ItemEdit if this is selected -->
    <v-col v-if="isEditing(item)" cols="10" class="pa-0">
      <ItemEdit
        :note="note"
        @updated="updated"
        @deleted="deleted"
        @moveNext="moveNext"
        @movePrevious="movePrevious"
      ></ItemEdit>
    </v-col>
    <!-- ItemShow if this is not selected-->
    <v-col v-else cols="10" class="pa-0">
      <ItemShow :item="item" style="min-height: 48px"></ItemShow>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ButtonItemMenu from '@/components/MyPage/Note/ItemList/ButtonItemMenu'
import ItemEdit from '@/components/MyPage/Note/ItemList/ItemEdit.vue'
import ItemShow from '@/components/MyPage/Note/ItemList/ItemShow.vue'

export default {
  name: 'Item',
  components: { ButtonItemMenu, ItemEdit, ItemShow },
  props: {
    item: Object,
    note: Object
  },
  data() {
    return {}
  },
  computed: {
    ...mapGetters({
      itemEdited: 'item/itemEdited'
    }),
    shouldShowItemMenu() {
      return this.isEditing() && this.item.body === ''
    }
  },
  methods: {
    ...mapActions({}),
    isEditing() {
      return this.itemEdited ? this.itemEdited.id === this.item.id : false
    },
    updated({ item }) {
      this.$store.dispatch('item/setItemEdited', { item })
      console.log('updated method')
    },
    deleted({ item }) {
      console.log('deleted method')
    },
    moveNext({ item }) {
      console.log('moveNext method')
    },
    movePrevious({ item }) {
      console.log('movePrevious method')
    }
  }
}
</script>

<style scoped></style>
