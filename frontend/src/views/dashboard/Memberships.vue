<template>
  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2">
        <h1 class="font-normal">Memberships List</h1>

        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="addAttendance">
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="text">Title</label>
              <input id="text" v-model="modalData.title"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                     name="title"
                     placeholder="Membership title" required="" type="text">
            </div>
            <div class="flex wrap gap-4 justify-evenly">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="price">
                  Price
                </label>
                <input id="price" v-model="modalData.price"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       name="price"
                       placeholder="Subscription Price"
                       required="" type="number">
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="number">
                  Attendances / week
                </label>
                <input id="number" v-model="modalData.number_of_attendances"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       name="max_attendances"
                       placeholder="Max attendances"
                       required="" type="number">
              </div>
            </div>
            <div>

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload
                file</label>
              <input
                  id="file_input"
                  aria-describedby="file_input_help"
                  class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                  type="file"
                  @change="imageSelected">
              <p id="file_input_help" class="mt-1 text-sm text-gray-500 dark:text-gray-300">SVG, PNG, JPG or GIF.</p>

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
              Name
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Price
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Attendances
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Members
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Subscriptions
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Actions
              <span class="sr-only">Edit</span>
            </th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="membership in memberships" :key="membership.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              {{ membership.title }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ membership.price }} DH
            </td>
            <td class="px-6 py-4 text-center">
              {{ membership.number_of_attendances }}
            </td>
            <td class="px-6 py-4 text-center">
              {{ membership.members_count }}
            </td>
            <td class="px-6 py-4 text-center">
              {{ membership.subscriptions_count }}
            </td>
            <td class="px-6 py-4 text-center">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#">Edit</a>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>

    <SuccessToast v-show="toasts.success" class="fixed bottom-4 right-4" message="Membership added successfully."
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
  name: "Memberships",
  data() {
    return {
      memberships: {},
      modal: {
        title: 'New Membership',
        show: false
      },
      modalData: {
        title: '',
        gym_id: this.$store.state.gym_id,
        price: null,
        number_of_attendances: null,
        icon: ''
      },
      toasts: {
        success: false
      }
    }
  },
  components: {
    'DashboardLayout': DashboardLayout,
    'Modal': Modal,
    'SuccessToast': Success
  },
  methods: {
    fetchMemberships() {
      axios.get('membership').then(({data}) => {
        this.memberships = data;
      }).catch(error => {
        console.log(error)
      })
    },
    toggleModal(val) {
      this.modal.show = val
    },
    imageSelected(e) {
      this.modalData.icon = e.target.files[0]
    },
    clearModalData() {
      this.modalData = {
        title: '',
        gym_id: 1,
        price: null,
        number_of_attendances: null,
        icon: ''
      }
    },
    addAttendance() {
      let formData = new FormData();
      formData.append('icon', this.modalData.icon)

      let data = {
        title: this.modalData.title,
        gym_id: this.modalData.gym_id,
        price: this.modalData.price,
        number_of_attendances: this.modalData.number_of_attendances,
        //TODO: upload icon
        // icon: formData
      }

      axios.post('/membership', data).then(({data}) => {
        // Hide modal
        this.toggleModal(false)

        this.memberships.unshift(data)

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
  },
  mounted() {
    this.fetchMemberships()
  }
}
</script>

<style scoped>

</style>