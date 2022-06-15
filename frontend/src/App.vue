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
    //TODO: check before enter any route either on url changed manually
    this.$router.beforeEach((to, from, next) => {
      if (!to.matched.some(record => record.meta.install)) {
        if (this.$store.state.installed) {
          next()
          return
        }
        next('/install')
      } else {
        if (!this.$store.state.installed) {
          next()
          return
        }
        next('/')
      }
    })
  },
}

</script>