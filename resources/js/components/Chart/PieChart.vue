<script>
import VueCharts from "vue-chartjs";
import { Doughnut, mixins } from "vue-chartjs";

const { reactiveProp } = mixins;

export default {
    extends: Doughnut,
    props: {
        data: Object,
        options: {
            type: Object,
            default: () => {
                return {
                    responsive: true,
                    maintainAspectRatio: true,
                    title: {
                        display: false
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                    tooltips: { enabled: false },
                    hover: { mode: null }
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