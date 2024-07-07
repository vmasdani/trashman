<script setup lang="ts">
const props = defineProps({ text: String, percentage: Number, color: String });
</script>

<template>
  <apexchart
    width="175"
    type="radialBar"
    :colors="['red']"
    :options="{
      chart: {
        id: 'vuechart-example',
      },
      plotOptions: {
        radialBar: {
          hollow: {
            margin: 0,
            size: '65%',
            // background: '#293450',
          },
          dataLabels: {
            showOn: 'always',
            name: {
              // offsetY: -10,
              show: true,
              color: '#888',
              fontSize: '13px',
            },
            value: {
              offsetY: 5,
              color: '#111',
              fontSize: '15px',
              show: true,
            },
          },
        },
      },
      stroke: {
        lineCap: 'round',
      },
      fill: { colors: [props.color] },
      labels: [props.text],
    }"
    :series="[props.percentage]"
  ></apexchart>
</template>
