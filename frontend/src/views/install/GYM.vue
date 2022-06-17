<template>
  <install-layout>
    <card
        :current-step="card.step.current"
        :next-btn-name="card.btn.next.name"
        :submit-clicked="redirectToCreateAdmin"
        :title="card.title"
        :total-steps="card.step.total">
      <!--   GYM Name   -->
      <div class="mb-2">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="gym_name">GYM Name</label>
        <input id="gym_name" v-model="fields.name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g GYMStar" required type="text">
      </div>

    </card>
  </install-layout>
</template>

<script>
import InstallCard from "@/components/InstallCard.vue";
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import {axios} from "@/services/axios/config";

export default {
  name: "GYM",
  data() {
    return {
      card: {
        title: 'Set GYM Application\'s Name.',
        step: {
          current: 2,
          total: 3,
        },
        btn: {
          next: {
            name: 'Next'
          },
        }
      },
      fields: {
        name: ''
      }
    }
  },
  components: {
    'install-layout': InstallationLayout,
    'card': InstallCard
  },
  methods: {
    //TODO: add animation for loading
    redirectToCreateAdmin() {
      this.createGym();
    },
    createGym() {
      axios.post('/gym', {
        'name': this.fields.name
      }).then(({data}) => {

        this.$store.dispatch('setGymId', data.id);

        this.$router.push('/install/admin')

      }).catch(error => {
        console.log(error)
      })
    }
  },
}
</script>

<style scoped>

</style>