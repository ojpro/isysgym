<template>
  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2">
        <h1 class="font-normal">Latest Attendances</h1>

        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="addAttendance">
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                     for="member">Select Member</label>
              <select id="member"
                      v-model="modalData.member_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      name="member" required>
                <option v-for="member in members" :key="member.id" :value="member.id">
                  {{ member.first_name + ' ' + member.last_name }}
                </option>
              </select>
            </div>

            <div>

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                     for="member">Select Attendance Date</label>

              <litepie-datepicker
                  v-model="attendance"
                  :formatter="datepicker.format"
                  as-single
                  placeholder="Attendance date"
                  required
              ></litepie-datepicker>
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
              Member
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Date
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Attendances
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Expire In
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Actions
              <span class="sr-only">Edit</span>
            </th>
          </tr>
          </thead>
          <tbody>

          <tr v-for="attendance in attendances" :key="attendance.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              <!--      TODO: link to member profile        -->
              {{ attendance.member.first_name + ' ' + attendance.member.last_name }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ attendance.attended_at }}
            </td>
            <td class="px-6 py-4 text-center">
              1/3
            </td>
            <td class="px-6 py-4 text-center">
              2002-2-20
            </td>
            <td class="px-6 py-4 text-center">
              <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="#">Edit</a>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>

    <SuccessToast v-show="toasts.success" class="fixed bottom-4 right-4" message="Attendance added successfully."
                  @closeToast="toasts.success = false">

    </SuccessToast>
  </DashboardLayout>
</template>

<script>
import Modal from "@/components/global/Modal.vue";
import Success from "@/components/global/Toasts/Success.vue";
import DashboardLayout from "@/layouts/DashboardLayout.vue";
import {axios} from "@/services/axios/config.js";
import dayjs from "dayjs";
import LitepieDatepicker from "litepie-datepicker";
import {ref} from "vue";

export default {
  name: "Attendances",
  data() {
    return {
      datepicker: {
        format: ref({
          date: 'DD MMM YYYY',
          month: 'MMM'
        })
      },
      toasts: {
        success: false
      },
      modal: {
        title: 'New Attendance',
        show: false
      },
      modalData: {
        member_id: null
      },
      members: {},
      attendances: {}
    }
  },
  components: {
    DashboardLayout,
    'SuccessToast': Success,
    Modal,
    LitepieDatepicker
  },
  setup() {
    //TODO: check date if they are valid
    const attendance = ref(dayjs().format('DD MMM YYYY'))
    return {
      attendance
    };
  },
  methods: {
    fetchAttendances() {
      axios.get('attendance').then(({data}) => {
        this.attendances = data
      }).catch(error => {
        console.log(error)
      })
    },
    //TODO: DRY
    fetchMembers() {
      axios.get('member').then(({data}) => {
        this.members = data
      }).catch(error => {
        console.log(error)
      })
    },
    addAttendance() {
      let attendance = {
        attended_at: dayjs(this.attended_at).format('YYYY-MM-DD HH:mm:ss'),
        member_id: this.modalData.member_id
      }
      // TODO: DRY
      axios.post('attendance', attendance).then(({data}) => {
        // Hide modal
        this.toggleModal(false)
        //TODO: fix started_at not returned
        this.attendances.unshift(data)

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
    toggleModal(val) {
      this.modal.show = val
    },
    clearModalData() {
      this.modalData = {
        member_id: null
      }

    },
  },
  mounted() {
    this.fetchAttendances()
    this.fetchMembers()
  }
}
</script>

<style scoped>

</style>