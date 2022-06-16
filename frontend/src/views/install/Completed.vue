<template>
  <install-layout>
    <card
        :next-btn-name="card.btn.next.name"
        :title="card.title"
        :description="card.description"
        :next-clicked="redirectToDashboard"></card>

  </install-layout>
</template>

<script>
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import InstallCard from "@/components/InstallCard.vue";

export default {
  name: "Completed",
  data() {
    return {
      card: {
        title: 'Application created successfully.',
        description: 'Your GYM management is ready to use now.',
        btn: {
          next: {
            name: 'Go to the dashboard'
          },
        }
      }
    }
  },
  components: {
    'install-layout': InstallationLayout,
    'card': InstallCard
  },
  methods: {
    redirectToDashboard() {
      this.$router.push('/dashboard')
    }
  },
}
</script>

<style scoped>

</style>