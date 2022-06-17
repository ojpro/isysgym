<template>
  <div
      class="w-11/12 sm:w-1/2 lg:w-1/3 overflow-hidden absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white shadow-sm rounded">
<!-- TODO:Loading   -->
    <form method="POST" @submit.prevent="submitClicked">
      <h1 class="text-center text-lg font-medium m-2">{{ title }}</h1>
      <div class="container p-4 my-4">
        <p class="text-center text-gray-900" v-show="description">{{ description }}</p>
        <slot></slot>
      </div>
      <div class="flex items-center mt-4 px-3 py-2 bg-gray-50/50 border-t border-gray-50"
           :class="totalSteps ? 'justify-between' : 'justify-evenly'">
        <!--    Progress    -->
        <span class="text-sm text-gray-800" v-show="currentStep && totalSteps">{{ currentStep }}<b>/{{ totalSteps }}</b></span>
        <!--    Next Button    -->
        <primary-btn :name="nextBtnName" :type="totalSteps ? 'submit':'button'" @click="nextClicked"></primary-btn>
      </div>
    </form>
  </div>
</template>

<script>
import Primary from "./global/Buttons/Primary.vue";

export default {
  props: [
    'title', 'description',
    'currentStep', 'totalSteps',
    'nextBtnName', 'nextClicked',
    'submitClicked'
  ],
  name: "InstallCard",
  components: {
    'primary-btn': Primary,
  },
}
</script>

<style scoped>

</style>