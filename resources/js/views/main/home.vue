<template>
    <div>
        <h1 class="text-4xl font-bold text-gray-700">Shorten your link</h1>

        <form @submit.prevent="submit" class="mt-8">
            <div class="mb-5">
                <label for="url" class="font-bold text-lg">URL</label>
                <div class="flex">
                    <input
                        v-model="link.url"
                        name="url"
                        id="url"
                        type="text"
                        placeholder="Enter your url"
                        required
                        class="appearance-none block w-full bg-gray-100 border-gray-100 border rounded-l-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    />

                    <div class="flex flex-shrink-0">
                        <button
                            @click.prevent="setProtection"
                            :class="link.is_protected ? 'bg-gray-500 hover:bg-gray-600' : 'bg-gray-200 hover:bg-gray-300 text-gray-600'"
                            class="py-3 px-6 inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide focus:outline-none"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    v-if="link.is_protected"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                                <path
                                    v-else
                                    d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z"
                                />
                            </svg>
                        </button>
                        <button
                            class="py-3 px-8 rounded-r-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                        >Shorten</button>
                    </div>
                </div>

                <div
                    class="mt-2 text-xs leading-4 text-red-500"
                    v-if="errors.url"
                    v-html="errors.url[0]"
                ></div>
            </div>

            <div class="flex flex-wrap -mx-3">
                <select-field
                    v-model="link.domain_id"
                    :options.sync="domains"
                    :clearable="false"
                    endpoint="domains"
                    valueName="id"
                    label="name"
                    title="Domain"
                    class="w-full lg:w-1/2 px-3"
                />

                <text-field
                    title="Password"
                    type="password"
                    autocomplete="new-password"
                    v-model="link.password"
                    :required="link.is_protected"
                    class="w-full lg:w-1/2 px-3"
                    :class="!link.is_protected && 'opacity-50'"
                    :disabled="!link.is_protected"
                />
            </div>

            <div
                :class="link.full_url ? 'visible' : 'invisible'"
                class="w-full rounded-lg py-4 px-4 bg-green-400 text-sm text-white"
            >
                <div class="flex items-center justify-between">
                    <div>
                        The
                        <a :href="link.full_url" class="underline">link</a> has been shortened.
                    </div>

                    <a
                        v-clipboard:copy="link.full_url"
                        v-clipboard:success="onCopy"
                        :class="isCopied ? 'bg-green-200 hover:bg-green-300 text-green-600' : 'bg-white hover:bg-green-100 text-green-500 hover:text-green-600'"
                        class="inline-flex items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg"
                        href="#"
                    >{{ isCopied ? 'Copied' : 'Copy' }}</a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            link: {
                url: null,
                password: null,
                is_protected: false,
                domain_id: null,
                full_url: null
            },
            isCopied: false,
            errors: {},
            domains: []
        };
    },

    methods: {
        setProtection() {
            this.link.is_protected = !this.link.is_protected;
            if (!this.link.is_protected) {
                this.link.password = null;
            }
        },

        submit() {
            this.errors = {};
            this.isCopied = false;
            this.link.full_url = null;

            axios
                .post("links", this.link)
                .then(({ data }) => {
                    this.link.is_protected = false;
                    this.link.full_url = data.data.full_url;
                })
                .catch(({ response }) => {
                    this.errors = response.data.errors;
                });
        },

        onCopy() {
            this.isCopied = true;
        }
    },

    watch: {
        domains: function(value) {
            if (value.length) {
                this.link.domain_id = value[0].id;
            }
        }
    }
};
</script>