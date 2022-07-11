<script>
import VueCharts from "vue-chartjs";
import { Bar, Line, mixins } from "vue-chartjs";

const { reactiveProp } = mixins;

export default {
    extends: Line,
    props: {
        data: Object,
        options: {
            type: Object,
            default: () => {
                return {
                    title: {
                        display: false
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [
                            {
                                display: false,
                                ticks: {
                                    display: false,
                                    autoSkip: true,
                                    maxTicksLimit: 10,
                                    maxRotation: 0
                                },
                                gridLines: {
                                    display: true
                                }
                            }
                        ],
                        yAxes: [
                            {
                                display: false,
                                ticks: {
                                    display: false,
                                    beginAtZero: true
                                },
                                gridLines: {
                                    display: false
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