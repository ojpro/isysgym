<template>
  <install-layout>
    <card
        :next-btn-name="card.btn.next.name"
        :title="card.title"
        :description="card.description"
        :next-clicked="redirectToInstallDatabase"></card>

  </install-layout>
</template>

<script>
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import InstallCard from "@/components/InstallCard.vue";

export default {
  name: "Index",
  data() {
    return {
      card: {
        title: 'Let\'s Start building your system.',
        description: 'Easily setup your gym management system with few steps.',
        btn: {
          next: {
            name: 'Start'
          }
        }
      }
    }
  },
  components: {
    'install-layout': InstallationLayout,
    'card': InstallCard
  },
  methods: {
    redirectToInstallDatabase() {
      this.$router.push('/install/database')
    }
  },
}
</script>

<style scoped>

</style>