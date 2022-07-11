<template>
    <div>
        <template v-if="false">
            <!-- purgecss colors -->
            <div class="bg-blue-400 text-blue-700"></div>
            <div class="bg-orange-400 text-orange-700"></div>
            <div class="bg-yellow-400 text-yellow-700"></div>
            <div class="bg-green-400 text-green-700"></div>
        </template>

        <slot name="heading" />

        <div
            v-if="!ready"
            class="bg-gray-100 opacity-25 rounded-lg h-96 flex flex-col items-center justify-center"
        >
            <svg
                version="1.1"
                id="L4"
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px"
                y="0px"
                viewBox="0 0 26 100"
                enable-background="new 0 0 0 0"
                xml:space="preserve"
            >
                <circle fill="#64748b" stroke="none" cx="6" cy="50" r="2">
                    <animate
                        attributeName="opacity"
                        dur="1s"
                        values="0;1;0"
                        repeatCount="indefinite"
                        begin="0.1"
                    />
                </circle>
                <circle fill="#64748b" stroke="none" cx="14" cy="50" r="2">
                    <animate
                        attributeName="opacity"
                        dur="1s"
                        values="0;1;0"
                        repeatCount="indefinite"
                        begin="0.2"
                    />
                </circle>
                <circle fill="#64748b" stroke="none" cx="22" cy="50" r="2">
                    <animate
                        attributeName="opacity"
                        dur="1s"
                        values="0;1;0"
                        repeatCount="indefinite"
                        begin="0.3"
                    />
                </circle>
            </svg>
        </div>

        <div
            v-else-if="!data.clicks.datasets[0].data.length"
            class="border-4 border-dashed border-cool-gray-200 rounded-lg h-96 flex flex-col items-center justify-center"
        >
            <h2 class="text-2xl font-medium text-cool-gray-600">It's too quiet</h2>
            <h2 class="text-lg font-normal text-cool-gray-500">You don't have any clicks so far.</h2>
        </div>

        <div v-else>
            <div class="mb-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="px-4 pt-3">
                    <div class="text font-bold uppercase tracking-wide text-gray-600">Clicks</div>

                    <div
                        class="mb-1 text-xs font-semibold text-gray-400 tracking-wide uppercase leading-6"
                    >Total clicks by period</div>
                </div>

                <line-chart :height="80" :chart-data="data.clicks" />
            </div>

            <div class="flex flex-wrap -mx-3">
                <div
                    v-for="(stat, index) in stats"
                    :key="index"
                    class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-6"
                >
                    <div class="bg-white rounded-lg shadow overflow-auto px-4 py-3">
                        <div class="mb-3">
                            <div
                                class="text font-bold uppercase tracking-wide text-gray-600"
                            >{{ stat.name }}</div>
                            <div
                                class="mb-1 text-xs font-semibold text-gray-400 tracking-wide uppercase leading-6"
                            >Top {{ stat.name}}</div>
                        </div>

                        <div class="space-y-3">
                            <div v-for="entry in data[stat.name]" :key="entry.id">
                                <div class="text-gray-500 font-medium text-sm">{{ entry.name }}</div>

                                <div class="h-8 bg-gray-200 rounded">
                                    <div
                                        :class="`bg-${stat.color}-400 text-${stat.color}-700`"
                                        class="py-2 h-full rounded text-center text-xs font-semibold"
                                        :style="`width: ${entry.clicks_rate}%`"
                                    >{{ entry.clicks_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LineChart from "@/components/Chart/LineChart";

export default {
    components: { LineChart },

    props: {
        link: Object,
        endpoint: String
    },

    data() {
        return {
            ready: false,
            period: null,
            data: {},
            stats: [
                {
                    name: "browsers",
                    color: "green"
                },
                {
                    name: "devices",
                    color: "yellow"
                },
                {
                    name: "platforms",
                    color: "orange"
                },
                {
                    name: "countries",
                    color: "blue"
                }
            ]
        };
    },

    methods: {
        fetch() {
            axios.get(this.endpoint).then(({ data }) => {
                this.data = data;
                this.ready = true;
            });
        }
    },

    mounted() {
        this.fetch();
    }
};
</script>