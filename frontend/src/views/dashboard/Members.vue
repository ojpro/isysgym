<template>

  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2 items-center">
        <h1 class="font-normal">Members List</h1>
        <div class="relative w-1/3">

          <label class="sr-only" for="simple-search">Search</label>
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
              <path clip-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    fill-rule="evenodd"></path>
            </svg>
          </div>
          <input id="simple-search" v-model="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                 placeholder="Search"
                 required type="search" @input="searchMembers">

        </div>
        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="addMember">
            <div class="flex wrap gap-4 justify-evenly">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="first_name">
                  First Name
                </label>
                <input id="first_name" v-model="modalData.first_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       name="first_name"
                       placeholder="Member's Name"
                       required="" type="text">
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="last_name">
                  Last Name
                </label>
                <input id="last_name" v-model="modalData.last_name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                       name="last_name"
                       placeholder="Member' Family Name"
                       required="" type="text">
              </div>
            </div>


            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                     for="membership">Membership</label>
              <select id="membership"
                      v-model="modalData.membership_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      name="membership" required>
                <option v-for="membership in memberships" :key="membership.id" :value="membership.id">
                  {{ membership.title }}
                </option>
              </select>
            </div>


            <div>
              <button id="dropdownNavbarLink"
                      class="flex items-center justify-between w-full py-2 pl-3 pr-4 font-medium text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"
                      data-dropdown-toggle="dropdownNavbar">
                Add more information (optional)
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path clip-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        fill-rule="evenodd"></path>
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div id="dropdownNavbar"
                   class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul aria-labelledby="dropdownLargeButton" class="py-1 text-sm text-gray-700 dark:text-gray-400">
                  <li>
                    <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" href="#">Dashboard</a>
                  </li>
                  <li>
                    <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" href="#">Settings</a>
                  </li>
                  <li>
                    <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" href="#">Earnings</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"
                     href="#">Sign
                    out</a>
                </div>
              </div>
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
              Started In
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Attendances
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Membership
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Actions
              <span class="sr-only">Edit</span>
            </th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="member in members" :key="member.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              {{ member.first_name + ' ' + member.last_name }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ new Date(member.created_at).toDateString() }}
            </td>
            <td class="px-6 py-4 text-center">
              x/2
            </td>
            <td class="px-6 py-4 text-center">
              {{ member.membership_title }}
            </td>
            <td class="px-6 py-4 text-center">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#">Edit</a>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>

    <SuccessToast v-show="toasts.success" class="fixed bottom-4 right-4" message="Member added successfully."
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
  name: "Members",
  data() {
    return {
      toasts: {
        success: false
      },
      modal: {
        title: 'New Member',
        show: false
      },
      modalData: {
        first_name: '',
        last_name: '',
        membership_id: null,
      },
      memberships: {},
      members: {},
      search: ''
    }
  },
  components: {
    'DashboardLayout': DashboardLayout,
    'SuccessToast': Success,
    'Modal': Modal
  },
  methods: {
    searchMembers() {
      axios.get('member/?search=' + this.search).then(({data}) => {
        this.members = data
      }).catch(error => {
        console.log(error)
      })
    },
    toggleModal(val) {
      this.modal.show = val
    },
    fetchMemberships() {
      axios.get('membership').then(({data}) => {
        this.memberships = data;
      }).catch(error => {
        console.log(error)
      })
    },
    addMember() {

      let memberData = {
        first_name: this.modalData.first_name,
        last_name: this.modalData.last_name,
        gym_id: this.$store.state.gym_id
      }


      axios.post('/member', memberData).then(({data}) => {

        // create registration subscription
        this.createSubscription(data.id, this.modalData.membership_id);

        // Hide modal
        this.toggleModal(false)

        this.members.unshift(data)

        // Show success message
        this.toasts.success = true
        setTimeout(_ => {
          this.toasts.success = false
        }, 3000)


      }).catch(error => {
        console.log(error)
      })
    },
    createSubscription(member_id, membership_id) {
      let subscription = {
        member_id: member_id,
        membership_id: membership_id
      }
      axios.post('/subscription', subscription).then(({data}) => {

        this.modalData = {
          first_name: '',
          last_name: '',
          membership_id: null,
        }

      }).catch(error => {
        console.log(error)
      })
    },
    fetchMembers() {
      axios.get('member').then(({data}) => {
        this.members = data;
      }).catch(error => {
        console.log(error)
      })
    }

  },
  mounted() {
    this.fetchMembers()
    this.fetchMemberships()
  }
}
</script>

<style scoped>

</style>