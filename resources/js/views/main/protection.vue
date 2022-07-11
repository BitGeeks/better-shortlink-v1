<template>
    <div v-if="ready">
        <div v-if="is_expired">
            <h1 class="text-4xl font-bold text-gray-700">The link is expired</h1>
        </div>
        <div v-else>
            <h1 class="text-4xl font-bold text-gray-700">The link is protected</h1>

            <form @submit.prevent="submit" class="mt-8">
                <text-field
                    v-model="link.password"
                    title="Password"
                    type="password"
                    :errors="errors.password"
                />
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            link: {
                password: null,
                hash: this.$route.params.hash
            },

            errors: {},
            ready: false,
            is_expired: false
        };
    },

    methods: {
        submit() {
            axios
                .post(`links/${this.link.hash}`, this.link)
                .then(({ data }) => {
                    window.location.href = data.data.url;
                })
                .catch(({ response }) => {
                    this.errors = response.data.errors;
                });
        }
    },

    mounted() {
        this.is_expired = !!window.is_expired;
        this.ready = true;
    }
};
</script>