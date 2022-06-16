<template>
  <install-layout>
    <card
        :next-btn-name="card.btn.next.name"
        :title="card.title"
        :current-step="card.step.current"
        :total-steps="card.step.total"
        :submit-clicked="redirectToCreateGym">

      <!--   Database Credentials   -->
      <div class="mb-6">
        <label for="db_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Database
          Name</label>
        <input type="text" id="db_name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g gym_db" required v-model="fields.db_name">
      </div>

      <div class="grid md:grid-cols-2 md:gap-6">
        <div class="mb-6">
          <label for="db_host" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Host</label>
          <input type="text" id="db_host"
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 placeholder="localhost" required v-model="fields.db_host">
        </div>
        <div class="mb-6">
          <label for="port" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Port</label>
          <input type="number" min="1024" max="65535" id="port"
                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 placeholder="3306" v-model="fields.db_port">
        </div>
      </div>
      <div class="mb-6">
        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
        <input type="text" id="username"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g root" required v-model="fields.db_user">
      </div>
      <div class="mb-2">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
        <input type="password" id="password"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="" min="8" required v-model="fields.db_pass">
      </div>
    </card>
  </install-layout>
</template>

<script>
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import InstallCard from "@/components/InstallCard.vue";
import {axios} from "@/services/axios/config";

export default {
  name: "Database",
  data() {
    return {
      card: {
        title: 'Setup Database Connection.',
        step: {
          current: 1,
          total: 3,
        },
        btn: {
          next: {
            name: 'Next'
          }
        }
      },
      fields: {
        db_name: '',
        db_host: '',
        db_port: 3306,
        db_user: '',
        db_pass: ''
      }
    }
  },
  components: {
    'install-layout': InstallationLayout,
    'card': InstallCard
  },
  methods: {
    redirectToCreateGym() {
      this.postDatabaseConfigs()
    },
    postDatabaseConfigs() {

      // define request body
      let configs = {
        'DB_DATABASE': this.fields.db_name,
        'DB_HOST': this.fields.db_host || 'localhost',
        'DB_PORT': this.fields.db_port || 3306,
        'DB_USERNAME': this.fields.db_user || 'root',
        'DB_PASSWORD': this.fields.db_pass || ''
      }

      // post request to the api
      axios.post('/install/database', configs)
          .then(data => {
            this.$router.push('/install/gym')
          })
          .catch(error => {
            console.log(error.response)
          })
    }

  },
}
</script>

<style scoped>

</style>