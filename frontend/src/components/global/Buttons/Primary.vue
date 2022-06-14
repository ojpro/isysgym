<template>
  <button class="bg-blue-500 hover:bg-blue-500/90 text-white px-3 py-1.5 rounded shadow-sm hover:shadow-md"
          :type="type">
    {{ name }}
  </button>
</template>

<script>
export default {
  props: ['type','name'],
  name: "Primary"
}
</script>

<style scoped>

</style>