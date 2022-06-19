<template>
  <DashboardLayout>

    <div class="container">
      <div class="flex justify-between m-2">
        <h1 class="font-normal">Subscriptions List</h1>

        <!--    Add new Membership    -->

        <button
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            data-modal-toggle="authentication-modal" type="button" @click="modal.show = !modal.show">
          {{ modal.title }}
        </button>

        <Modal :show-modal="modal.show" :title="modal.title" @modalToggled="toggleModal">

          <form action="#" class="space-y-6" @submit.prevent="AddSubscription">
            <div>

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400" for="member">Select
                Member</label>
              <select id="member"
                      v-model="modalData.member_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      required>
                <option v-for="member in members" :key="member.id" :value="member.id">
                  {{ member.first_name + '' + member.last_name }}
                </option>
              </select>

            </div>
            <div>

              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400" for="membership">Select
                Membership</label>
              <select id="membership"
                      v-model="modalData.membership_id"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      required>
                <option v-for="membership in memberships" :key="membership.id" :value="membership.id">
                  {{ membership.title }}
                </option>
              </select>

            </div>
            <div>
              <label id="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                Select Start & <span id="expire_date" class="cursor-pointer">Expire Date</span> <span
                  class="text-gray-700 text-xs">(optional)</span>

              </label>
                <div class="flex wrap gap-1">
                  <litepie-datepicker
                      v-model="started_at"
                      :formatter="datepicker.format"
                      as-single
                      placeholder="Start date"
                      required
                      trigger="start_date"
                  ></litepie-datepicker>
                  <!--   TODO: use ref       -->
                  <litepie-datepicker
                      v-model="expire_at"
                      :formatter="datepicker.format"
                      as-single
                      placeholder="Expire date"
                      required
                      trigger="expire_date"
                  ></litepie-datepicker>
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
              Member
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Membership
            </th>
            <th class="px-6 py-3 text-center" scope="col">
              Started At
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

          <tr v-for="subscription in subscriptions" :key="subscription.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap" scope="row">
              {{ subscription.member.first_name + ' ' + subscription.member.last_name }}
            </th>
            <td class="px-6 py-4 text-center">
              {{ subscription.membership.title }}
            </td>
            <td class="px-6 py-4 text-center">
              <!--      TODO: format date        -->
              {{ subscription.started_at }}
            </td>
            <td class="px-6 py-4 text-center">
              {{ subscription.expire_at }}
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
import dayjs from 'dayjs'
import LitepieDatepicker from 'litepie-datepicker';
import {ref} from 'vue';

export default {
  name: "Subscriptions",
  data() {
    return {
      datepicker: {
        format: ref({
          date: 'DD MMM YYYY',
          month: 'MMM'
        })
      },
      modal: {
        title: 'New Subscription',
        show: false
      },
      modalData: {
        member_id: null,
        membership_id: null,
      },
      toasts: {
        success: false
      },
      members: {},
      memberships: {},
      subscriptions: {}
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
    //TODO: get current time also
    const started_at = ref(dayjs().format('YYYY-MM-DD HH:mm:ss'))
    const expire_at = ref(dayjs().add(1, 'month').format('YYYY-MM-DD HH:mm:ss'))
    return {
      started_at,
      expire_at
    };
  },
  watch: {
    started_at: {
      handler: function (val, oldVal) {
        //TODO: auto select the next month
        // let nextMonth = ref(dayjs(val).add(1, 'month').format('DD MMM YYYY'))
      },
      deep: true
    }
  },
  methods: {
    AddSubscription() {
      let subscription = {
        member_id: this.modalData.member_id,
        membership_id: this.modalData.membership_id,
        //TODO: DRY
        started_at: dayjs(this.started_at).format('YYYY-MM-DD HH:mm:ss'),
        expire_at: dayjs(this.expire_at).format('YYYY-MM-DD HH:mm:ss'),

      }

      axios.post('subscription', subscription).then(({data}) => {
        // Hide modal
        this.toggleModal(false)
        //TODO: fix started_at not returned
        this.subscriptions.unshift(data)

        // Show success message
        this.toasts.success = true
        setTimeout(_ => {
          this.toasts.success = false
        }, 3000)

        this.clearModalData()

      })
    },
    clearModalData() {
      this.modalData = {
        member_id: null,
        membership_id: null,
        started_at: ref(''),
        expire_at: ref('')
      }
    },
    fetchMembers() {
      axios.get('member').then(({data}) => {
        this.members = data
      }).catch(error => {
        console.log(error)
      })
    },
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
    fetchSubscription() {
      axios.get('subscription').then(({data}) => {
        this.subscriptions = data
      }).catch(error => {
        console.log(error)
      })
    }
  },
  mounted() {
    this.fetchSubscription()
    this.fetchMembers()
    this.fetchMemberships()
  }
}
</script>

<style scoped>

</style>