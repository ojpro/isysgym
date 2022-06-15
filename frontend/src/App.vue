<template>
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  mounted() {
    // fetch the installation state
    // TODO: dispatch only if the installed is false
    //TODO: solve CORS problem
    // this.$store.dispatch('fetchInstallState');
    if (this.$store.state.installed === false) {
      this.$store.dispatch('fetchInstallState');
    }

    //TODO: use guard for install routes
  }
}

</script>