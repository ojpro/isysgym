<template>
  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2">
        <h1 class="font-normal">Roles List</h1>

        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="addRole">
            <div class="flex flex-col wrap gap-4 justify-evenly">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="first_name">
                  First Name
                </label>
                <input id="first_name" v-model="modalData.name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       name="first_name"
                       placeholder="Member's Name"
                       required="" type="text">
              </div>
              <div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                       for="message">Description</label>
                <textarea id="message"
                          v-model="modalData.description"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Your message..."
                          rows="4"></textarea>
              </div>
            </div>

            <button
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="submit">
              Add
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
              Role Name
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Description
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              N Users
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Actions
              <span class="sr-only">Actions</span>
            </th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="role in roles" :key="role.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              {{ role.name }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ role.description }}
            </td>
            <td class="px-6 py-4 text-center">
              {{ role.users_count }}
            </td>
            <td class="px-6 py-4 text-center">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#">Edit</a>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>

    <SuccessToast v-show="toasts.success" class="fixed bottom-4 right-4" message="Role added successfully."
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
  name: "Roles",
  data() {
    return {
      modal: {
        show: false,
        title: 'Add Role'
      },
      toasts: {
        success: false
      },
      modalData: {
        name: '',
        description: ''
      },
      roles: {}
    }
  },
  components: {
    'DashboardLayout': DashboardLayout,
    'SuccessToast': Success,
    'Modal': Modal
  },
  methods: {
    toggleModal(val) {
      this.modal.show = val
    },
    addRole() {
      let role = {
        name: this.modalData.name,
        description: this.modalData.description
      }

      axios.post('role', role).then(({data}) => {
        // Hide modal
        this.toggleModal(false)

        this.roles.unshift(data)

        // Show success message
        this.toasts.success = true
        setTimeout(_ => {
          this.toasts.success = false
        }, 3000)

        this.clearModalData()

      }).catch(error => {
        console.log(error)
      })
    },
    fetchRoles() {
      axios.get('/role').then(({data}) => {
        this.roles = data
      }).catch(error => {
        console.log(error)
      })
    },
    clearModalData() {
      this.modalData = {
        name: '',
        description: ''
      }
    }
  },
  mounted() {
    this.fetchRoles();
  }
}
</script>

<style scoped>

</style>