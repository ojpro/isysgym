<template>
  <install-layout>
    <card
        :next-btn-name="card.btn.next.name"
        :title="card.title"
        :current-step="card.step.current"
        :total-steps="card.step.total"
        :submit-clicked="redirectToCreateAdmin">
      <!--   GYM Name   -->
      <div class="mb-2">
        <label for="gym_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">GYM Name</label>
        <input type="text" id="gym_name"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
               placeholder="e.g GYMStar" required v-model="fields.name">
      </div>

    </card>
  </install-layout>
</template>

<script>
import InstallationLayout from "@/layouts/InstallationLayout.vue";
import InstallCard from "@/components/InstallCard.vue";
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