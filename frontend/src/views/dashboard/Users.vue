<template>
  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2">
        <h1 class="font-normal">Users List</h1>

        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="addUser">

            <div class="mb-6">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="full_name">Full
                Name</label>
              <input id="full_name"
                     v-model="modalData.full_name"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="User name" required
                     type="text">
            </div>
            <div class="mb-6">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="email">Email</label>
              <input id="email"
                     v-model="modalData.email"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="e.g contact@example.com" required
                     type="email">
            </div>
            <div class="mb-6">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                     for="password">Password</label>
              <input id="password"
                     v-model="modalData.password"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     required
                     type="password">
            </div>

            <div>


              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400" for="countries">User
                Role</label>
              <select id="countries"
                      v-model="modalData.role_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <!--      TODO: select Default option           -->
                <option v-for="role in roles" :key="role.id" :value="role.id">{{
                    role.name
                  }}
                </option>
              </select>


            </div>
            <button
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">
              Save
            </button>
          </form>

        </Modal>

      </div>

      <!--   Memberships list   -->

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-6 py-3" scope="col">
              Full Name
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Email
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Role
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Actions
              <span class="sr-only">Actions</span>
            </th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="user in users" :key="user.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              {{ user.full_name }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ user.email }}
            </td>
            <td class="px-6 py-4 text-center">
              {{ user.role[0].name }}
            </td>
            <td class="px-6 py-4 text-center">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#">Edit</a>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>

    <SuccessToast v-show="toasts.success" class="fixed bottom-4 right-4" message="User added successfully."
                  @closeToast="toasts.success = false">

    </SuccessToast>
  </DashboardLayout>
</template>

<script>
import Modal from "@/components/global/Modal.vue";
import Success from "@/components/global/Toasts/Success.vue";
import DashboardLayout from "@/layouts/DashboardLayout.vue";
import {axios} from "@/services/axios/config.js";

export default {
  name: "Users",
  data() {
    return {
      modal: {
        show: false,
        title: 'Add new User'
      },
      toasts: {
        success: false
      },
      modalData: {
        full_name: '',
        email: '',
        password: '',
        role_id: null
      },
      users: {},
      roles: {}
    }
  },
  components: {
    'DashboardLayout': DashboardLayout,
    'Modal': Modal,
    'SuccessToast': Success
  },
  methods: {
    fetchUsers() {
      axios.get('user').then(({data}) => {
        this.users = data
      }).catch(error => {
        console.log(error)
      })
    },
    toggleModal(val) {
      this.modal.show = val
    },
    addUser() {
      let user = {
        full_name: this.modalData.full_name,
        email: this.modalData.email,
        password: this.modalData.password,
        gym_id: this.$store.state.gym_id
      }

      axios.post('user', user).then(({data}) => {

        this.users.unshift(data)

        this.setUserRole(data.id, this.modalData.role_id)
      })
    },
    setUserRole(user_id, role_id) {
      let data = {
        user_id: user_id,
        role_id: role_id
      }

      axios.post('user-role', data).then(_ => {
        // Hide modal
        this.toggleModal(false)

        // Show success message
        this.toasts.success = true
        setTimeout(_ => {
          this.toasts.success = false
        }, 3000)

      }).catch(error => {
        console.log(error)
      })
    },
    fetchRoles() {
      axios.get('role').then(({data}) => {
        this.roles = data
      }).catch(error => {
        console.log(error)
      })
    }
  },
  mounted() {
    this.fetchUsers()
    this.fetchRoles()
  }
}
</script>

<style scoped>

</style>