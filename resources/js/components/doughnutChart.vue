<template>
   
    <canvas></canvas>
   
</template>
<script>
import Chart from "chart.js";

export default {
    props: {
        labels: {},
        values: {},
    },

    mounted() {
        const chartColors = {
          red: 'rgb(255, 99, 132)',
          orange: 'rgb(255, 159, 64)',
          yellow: 'rgb(255, 205, 86)',
          
        };
        const config = {
            type: "doughnut",
            data: {
                datasets: [
                    {
                        data: this.values,
                        backgroundColor: [
                            chartColors.red,
                            chartColors.orange,
                            chartColors.yellow,
                        ],
                        label: "Dataset 1"
                    }
                ],
                labels: this.labels
            },
            options: {
                responsive: true,
            }
        };
        new Chart(this.$el.getContext("2d"), config);
    }
};
</script>