<template>
    <div v-if="resource.ready">
        <div class="py-6">
            <div>
                <div class="text-xs font-medium mb-2">
                    <router-link
                        :to="{ name: 'admin.roles.index' }"
                        class="text-blue-700 hover:text-blue-800"
                    >Roles</router-link>
                    <span v-once v-if="editing" class="text-gray-400">• {{ entry.name }}</span>
                </div>
                <h2
                    v-if="editing"
                    class="text-xl font-semibold text-gray-700 leading-none"
                >Edit Role</h2>
                <h2 v-else class="text-xl font-semibold text-gray-700 leading-none">Create Role</h2>
            </div>
        </div>

        <div class="px-6 py-5 bg-white shadow rounded-xl">
            <form @submit.prevent="submit">
                <text-field title="Role Name" v-model="entry.name" :errors="errors.name" required />

                <div class="mb-5">
                    <label class="font-bold text-lg">Permissions</label>

                    <div class="mt-3 space-y-3">
                        <div
                            v-for="permission in permissions"
                            :key="permission.id"
                            class="flex items-center"
                        >
                            <input
                                v-model="entry.permissions"
                                :value="permission.id"
                                :id="`permission-${permission.id}`"
                                type="checkbox"
                                class="form-checkbox h-5 w-5 text-green-500"
                            />
                            <label :for="`permission-${permission.id}`" class="ml-3">
                                <span
                                    class="block text-sm leading-5 font-medium text-gray-700"
                                >{{ permission.title }}</span>
                            </label>
                        </div>
                    </div>
                </div>

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
                name: "admin.roles",
                endpoint: "admin/roles"
            },

            entry: {
                permissions: []
            },

            permissions: []
        };
    },

    methods: {
        getPermissions() {
            axios.get("admin/permissions").then(({ data }) => {
                this.permissions = data.data;
            });
        },

        onMount() {
            this.getPermissions();
        }
    }
};
</script>