<template>
  <div>
    Index
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'defualt',
  components: {},
  computed: {
    ...mapGetters({
      file: 'tree/note'
    })
  },
  mounted() {}
}
</script>
