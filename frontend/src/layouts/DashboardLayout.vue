<template>
  <div class="flex justify-start">
    <Sidebar/>

    <div class="w-full bg-gray-100 min-h-screen">
      <Header/>
      <div class="p-4">
        <!--    Dashboard Content    -->
        <slot/>

      </div>
    </div>
  </div>
</template>

<script>
import Header from "@/partials/Header.vue";
import Sidebar from "@/partials/Sidebar.vue";

export default {
  name: "DashboardLayout",
  components: {
    'Sidebar': Sidebar,
    'Header': Header
  },
}
</script>

<style scoped>

</style>