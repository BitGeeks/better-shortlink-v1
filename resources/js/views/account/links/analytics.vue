<template>
    <analytics v-if="ready" :endpoint="`account/links/${link.id}/analytics`">
        <template v-slot:heading>
            <div class="py-6">
                <div>
                    <div class="text-xs font-medium mb-2">
                        <router-link
                            :to="{ name: 'account.links.index' }"
                            class="text-blue-700 hover:text-blue-800"
                        >Links</router-link>
                        <span>•</span>
                        <router-link
                            :to="{ name: 'account.links.edit', params: { id: link.id } }"
                            class="text-blue-700 hover:text-blue-800"
                        >{{ truncate(link.url, 32) }}</router-link>
                        <span>•</span>
                        <span class="text-gray-400">Analytics</span>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-700 leading-none">Analytics</h2>
                </div>
            </div>
        </template>
    </analytics>
</template>

<script>
import Analytics from "@/views/common/analytics";

export default {
    components: { Analytics },

    data() {
        return {
            link: {},
            ready: false
        };
    },

    methods: {
        fetch() {
            axios
                .get(`account/links/${this.$route.params.id}`)
                .then(({ data }) => {
                    this.link = data.data;
                    this.ready = true;
                });
        }
    },

    mounted() {
        this.fetch();
    }
};
</script>