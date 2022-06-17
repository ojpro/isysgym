<template>
  <dashboard-layout>
    <div class="shadow-sm p-4 rounded bg-white">
      This is the dashboard page
    </div>
  </dashboard-layout>
</template>

<script>
import DashboardLayout from "@/layouts/DashboardLayout.vue";

export default {
  name: "Dashboard",
  components:{
    //TODO: start using PascalCase for Components name
    'dashboard-layout':DashboardLayout
  }
}
</script>

<style scoped>

</style>