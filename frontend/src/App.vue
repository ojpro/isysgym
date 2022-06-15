<template>
  <router-view></router-view>
</template>

<script>

export default {
  name: 'App',
  data() {
    return {
      route: this.$router
    }
  },
  computed: {
    watchRouter() {
      this.checkIfInstalled()
    }
  },
  mounted() {
    // fetch the installation state
    //TODO: solve CORS problem
    // this.$store.dispatch('fetchInstallState');
    if (this.$store.state.installed === false) {
      this.$store.dispatch('fetchInstallState');
    }

    this.checkIfInstalled()
  },
  methods: {
    checkIfInstalled() {
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
    }
  },
}

</script>