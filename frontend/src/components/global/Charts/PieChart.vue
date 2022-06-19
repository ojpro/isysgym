<template>
  <Pie
      :chart-data="chartData"
      :chart-id="chartId"
      :chart-options="chartOptions"
      :css-classes="cssClasses"
      :height="height"
      :plugins="plugins"
      :styles="styles"
      :width="width"
  />
</template>

<script>
import {ArcElement, CategoryScale, Chart as ChartJS, Legend, Title, Tooltip} from 'chart.js'
import {Pie} from 'vue-chartjs'

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)

export default {
  name: "PieChart",

  components: {
    Pie
  },
  props: {
    chartId: {
      type: String,
      default: 'pie-chart'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {
      }
    },
    plugins: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      chartData: {
        labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
        datasets: [
          {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
            data: [40, 20, 80, 10]
          }
        ]
      },

      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },

}
</script>

<style scoped>

</style>