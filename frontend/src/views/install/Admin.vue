<template>
  <install-layout>
    <card
        :current-step="card.step.current"
        :next-btn-name="card.btn.next.name"
        :submit-clicked="redirectToCompleted"
        :title="card.title"
        :total-steps="card.step.total">
      <!--   Admin Account   -->
      <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="full_name">Full Name</label>
        <input id="full_name" v-model="field.full_name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="Oussama ELJABBARI" required type="text">
      </div>
      <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="email">Email</label>
        <input id="email" v-model="field.email"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g admin@gymstar.com" required type="email">
      </div>
      <div class="mb-2">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="password">Password</label>
        <input id="password" v-model="field.password"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               min="8" placeholder="********" required type="password">
      </div>

    </card>
  </install-layout>
</template>

<script>
import InstallCard from "@/components/InstallCard.vue";
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import {axios} from "@/services/axios/config";

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
      },
      field: {
        full_name: '',
        email: '',
        password: ''
      }
    }
  },
  components: {
    'install-layout': InstallationLayout,
    'card': InstallCard
  },
  methods: {
    redirectToCompleted() {
      this.createAdminRole()
    },
    createAdminRole() {
      let role = {
        name: 'admin',
        description: 'Administrator role with full permissions'
      }
      // TODO: create only if not exists
      axios.post('/role', role).then(response => {
        let role_id = response.data.id

        this.createAdminAccount(role_id)

      }).catch(error => {
        console.log(error)
      })
    },
    createAdminAccount(role_id) {
      let credentials = {
        full_name: this.field.full_name,
        email: this.field.email,
        password: this.field.password
      }
      axios.post('/user', credentials).then(({data}) => {

        this.$store.dispatch('setUserID', data.id);

        let admin_id = data.id

        this.setAdminRole(role_id, admin_id)

      }).catch(error => {
        console.log(error)
      })
    },
    setAdminRole(role, user) {
      let user_role = {
        role_id: role,
        user_id: user
      }

      axios.post('/user-role', user_role).then(_ => {
        this.postInstall()
      }).catch(error => {
        console.log(error)
      })
    },
    //TODO: needs explanation
    postInstall() {
      axios.post('/install').then(() => {
        this.setInstallState()
      })
    },
    setInstallState() {
      this.$store.commit('setInstallState', true)

      this.$router.push('/install/completed')
    }
  },
}
</script>

<style scoped>

</style>