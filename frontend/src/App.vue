<template>
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  mounted() {
    // fetch the installation state
    this.$store.dispatch('fetchInstallState');
  }
}

</script>