<template>
    <div v-if="resource.ready">
        <div class="py-6">
            <div>
                <div class="text-xs font-medium mb-2">
                    <router-link
                        :to="{ name: 'admin.links.index' }"
                        class="text-blue-700 hover:text-blue-800"
                    >Links</router-link>
                    <span
                        v-once
                        v-if="editing"
                        class="text-gray-400"
                    >• {{ truncate(entry.url, 64) }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <h2
                        v-if="editing"
                        class="text-xl font-semibold text-gray-700 leading-none"
                    >Edit Link</h2>
                    <h2 v-else class="text-xl font-semibold text-gray-700 leading-none">Create Link</h2>

                    <a
                        class="uppercase text-xs font-semibold text-gray-600 hover:text-gray-500"
                        :href="entry.full_url"
                        v-if="editing"
                        target="_blank"
                    >Open</a>
                </div>
            </div>
        </div>

        <div class="px-6 py-5 bg-white shadow rounded-xl">
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mx-3">
                    <text-field
                        class="px-3 w-full lg:w-2/3"
                        title="URL"
                        v-model="entry.url"
                        :errors="errors.url"
                        required
                    />

                    <select-field
                        class="px-3 w-full lg:w-1/3"
                        title="Domain"
                        endpoint="admin/domains/list"
                        :options.sync="domains"
                        label="name"
                        valueName="id"
                        v-model="entry.domain_id"
                        :errors="errors.domain_id"
                        :clearable="false"
                    />
                </div>

                <div class="flex flex-wrap -mx-3">
                    <text-field
                        class="px-3 w-full lg:w-1/2"
                        title="Password*"
                        type="password"
                        v-model="entry.password"
                        autocomplete="new-password"
                        :errors="errors.password"
                    />

                    <date-field
                        class="px-3 w-full lg:w-1/2"
                        title="Expiration*"
                        v-model="entry.expires_at"
                        format="Y-m-d H:i:S"
                        displayFormat="m/d/Y H:i"
                        :errors="errors.expires_at"
                    />
                </div>

                <div class="mb-5">
                    <label class="font-bold text-lg">Tags</label>
                    <tag-field v-model="entry.tags" />
                </div>

                <hr class="my-3 border-gray-200" />

                <text-field title="Title" v-model="entry.title" :errors="errors.title" />

                <textarea-field
                    title="Description"
                    v-model="entry.description"
                    :errors="errors.description"
                    rows="4"
                />

                <div class="flex items-center space-x-3">
                    <button
                        :disabled="saving"
                        class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                    >Save</button>

                    <button
                        v-if="editing"
                        @click.prevent="destroy"
                        class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-red-500 hover:bg-red-600 focus:outline-none focus:shadow-outline-red"
                    >Delete</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import ResourceForm from "@/components/Resource/ResourceForm";

export default {
    extends: ResourceForm,

    data() {
        return {
            resource: {
                name: "admin.links",
                endpoint: "admin/links"
            },
            entry: {
                tags: []
            },
            domains: []
        };
    },

    watch: {
        domains: function(value) {
            if (value.length && !this.entry.domain_id) {
                this.entry.domain_id = value[0].id;
            }
        }
    }
};
</script>