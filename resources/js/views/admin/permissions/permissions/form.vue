<template>
    <div v-if="resource.ready">
        <div class="py-6">
            <div>
                <div class="text-xs font-medium mb-2">
                    <router-link
                        :to="{ name: 'admin.permissions.index' }"
                        class="text-blue-700 hover:text-blue-800"
                    >Permissions</router-link>
                    <span v-once v-if="editing" class="text-gray-400">• {{ entry.name }}</span>
                </div>
                <h2
                    v-if="editing"
                    class="text-xl font-semibold text-gray-700 leading-none"
                >Edit Permission</h2>
                <h2
                    v-else
                    class="text-xl font-semibold text-gray-700 leading-none"
                >Create Permission</h2>
            </div>
        </div>

        <div class="px-6 py-5 bg-white shadow rounded-xl">
            <form @submit.prevent="submit">
                <text-field
                    title="Permission Name"
                    v-model="entry.name"
                    :errors="errors.name"
                    required
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
                name: "admin.permissions",
                endpoint: "admin/permissions"
            }
        };
    },

    methods: {}
};
</script>