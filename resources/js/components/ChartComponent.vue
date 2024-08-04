<template>
  <div>
    <ApexCharts
      :type="chartType"
      :options="chartOptions"
      :series="chartData"
    ></ApexCharts>
  </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import ApexCharts from 'vue3-apexcharts';

const props = defineProps({
  chartType: {
    type: String,
    default: 'pie'
  },
  chartData: {
    type: Array,
    default: () => []
  },
  labels: {
    type: Array,
    default: () => []
  },
  title: {
    type: String,
    default: ''
  },
  endingShape: {
    type: String,
    default: 'rounded'
  }
});

const chartOptions = computed(() => {
  const baseOptions = {
    chart: {
      type: props.chartType,
      height: 350
    },
    responsive: [
      {
        breakpoint: 480,
        options: {
          chart: {
            width: '100%'  // Adjusts to container width
          },
          legend: {
            position: 'bottom'
          }
        }
      }
    ]
  };

  if (props.chartType === 'pie') {
    return {
      ...baseOptions,
      labels: props.labels,
      title: {
        text: props.title
      }
    };
  } else if (props.chartType === 'bar') {
    return {
      ...baseOptions,
      plotOptions: {
        bar: {
          horizontal: false,
          endingShape: props.endingShape
        }
      },
      xaxis: {
        categories: props.labels
      },
      yaxis: {
        title: {
          text: props.title || 'Total Amount'
        }
      },
      dataLabels: {
        enabled: false
      }
    };
  } else if (props.chartType === 'line') {
    return {
      ...baseOptions,
      xaxis: {
        categories: props.labels
      },
      yaxis: {
        title: {
          text: props.title || 'Values'
        }
      },
      dataLabels: {
        enabled: true
      }
    };
  } else if (props.chartType === 'area') {
    return {
      ...baseOptions,
      xaxis: {
        categories: props.labels
      },
      yaxis: {
        title: {
          text: props.title || 'Values'
        }
      },
      fill: {
        opacity: 0.3
      },
      dataLabels: {
        enabled: true
      }
    };
  } else if (props.chartType === 'radar') {
    return {
      ...baseOptions,
      xaxis: {
        categories: props.labels
      },
      yaxis: {
        title: {
          text: props.title || 'Values'
        }
      }
    };
  }

  // Default options for unknown chart types
  return baseOptions;
});
</script>
