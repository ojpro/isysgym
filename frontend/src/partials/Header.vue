<template>
  <nav
      class="bg-white shadow-sm border-b border-gray-50/80 max-h-full border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-800">

    <div class="container flex flex-wrap justify-start items-center mx-auto">

      <button data-collapse-toggle="mobile-menu-2" type="button"
              class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 mx-4"
              aria-controls="mobile-menu-2" aria-expanded="false" @click="sidebarToggleClicked">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
        </svg>
        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
      </button>

      <a href="https://flowbite.com" class="flex items-center">
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Dashboard</span>
      </a>
      <div class="flex items-center md:order-2 relative ml-auto">
        <button type="button"
                class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 overflow-hidden"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown"
                @click="toggleUserDropdown()">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" src="@/assets/images/avatar.svg" alt="user photo">
        </button>

        <div v-show="openUserDropdown"
             class="absolute right-0 top-5 transition z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
             id="dropdown" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
          <div class="py-3 px-4">
            <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
            <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
          </div>
          <ul class="py-1" aria-labelledby="dropdown">
            <li>
              <a href="#"
                 class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
            </li>
            <li>
              <a href="#"
                 class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
            </li>
            <li>
              <a href="#"
                 class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
            </li>
            <li>
              <a href="#"
                 class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      openUserDropdown: false,
    }
  },
  methods: {
    toggleUserDropdown() {
      this.openUserDropdown = !this.openUserDropdown
    },
    sidebarToggleClicked() {
      this.$store.dispatch('toggleSidebar')
    }
  },
}
</script>

<style scoped>

</style>
