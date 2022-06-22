<template>
  <dashboard-layout>
    <div class="shadow-sm p-4 rounded bg-white">
      This is the dashboard page
    </div>
    <div>
      <PieChart
          :chart-data="chartData"
          css-classes="relative w-1/2 !max-h-[300px] m-2"
      />
    </div>
  </dashboard-layout>
</template>

<script>
import PieChart from "@/components/global/Charts/PieChart.vue";
import DashboardLayout from "@/layouts/DashboardLayout.vue";
// import PieChart from "@/components/global/Charts/PieChart.vue";
export default {
  name: "Dashboard",
  components:{
    //TODO: start using PascalCase for Components name
    'dashboard-layout':DashboardLayout,
    PieChart

  },
  data() {
    return {
      chartData: {
        labels: [ 'January', 'February', 'April'],
        datasets:[
          {
            label:'Data One',
            data:[60,24,12]
          }
        ]
      }
    }
  },
}
</script>

<style scoped>

</style>