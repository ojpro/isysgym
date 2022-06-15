<template>
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  mounted() {
    // fetch the installation state
    // TODO: dispatch only if the installed is false
    this.$store.dispatch('fetchInstallState');

    //TODO: use guard for install routes
  }
}

</script>