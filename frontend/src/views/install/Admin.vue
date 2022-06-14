<template>
  <install-layout>
    <card
        :next-btn-name="card.btn.next.name"
        :title="card.title"
        :current-step="card.step.current"
        :total-steps="card.step.total"
        :submit-clicked="redirectToCompleted">
      <!--   Admin Account   -->
      <div class="mb-6">
        <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
        <input type="text" id="full_name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="Oussama ELJABBARI" required>
      </div>
      <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
        <input type="email" id="email"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g admin@gymstar.com" required>
      </div>
      <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
        <input type="password" id="password"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="********" min="8" required>
      </div>

    </card>
  </install-layout>
</template>

<script>
import InstallationLayout from "../../layouts/InstallationLayout.vue";
import InstallCard from "../../components/InstallCard.vue";

export default {
  name: "Admin",
  data() {
    return {
      card: {
        title: 'Create Admin Account.',
        step: {
          current: 3,
          total: 3,
        },
        btn: {
          next: {
            name: 'Finish'
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
    redirectToCompleted() {
      //TODO*: think of using router.replace()
      this.$router.push('/install/completed')
    }
  },
}
</script>

<style scoped>

</style>