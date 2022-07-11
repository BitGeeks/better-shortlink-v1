<script>
import VueCharts from "vue-chartjs";
import { Bar, Line, mixins } from "vue-chartjs";

const { reactiveProp } = mixins;

export default {
    extends: Bar,
    props: {
        data: Object,
        options: {
            type: Object,
            default: () => {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: false
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    callback: function(value, index, values) {
                                        if (Math.floor(value) === value) {
                                            return value;
                                        }
                                    },
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                };
            }
        }
    },
    mixins: [reactiveProp],
    methods: {
        refresh() {
            this.renderChart(this.chartData, this.options);
        }
    },
    mounted() {
        this.refresh();
    }
};
</script>