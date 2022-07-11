<template>
    <div v-if="resource.ready">
        <div class="py-6">
            <div>
                <div class="text-xs font-medium mb-2">
                    <router-link
                        :to="{ name: 'admin.users.index' }"
                        class="text-blue-700 hover:text-blue-800"
                    >Users</router-link>
                    <span v-once v-if="editing" class="text-gray-400">• {{ entry.name }}</span>
                </div>
                <h2
                    v-if="editing"
                    class="text-xl font-semibold text-gray-700 leading-none"
                >Edit User</h2>
                <h2 v-else class="text-xl font-semibold text-gray-700 leading-none">Create User</h2>
            </div>
        </div>

        <div class="px-6 py-5 bg-white shadow rounded-xl">
            <form @submit.prevent="submit">
                <text-field title="Name" v-model="entry.name" :errors="errors.name" required />
                <text-field
                    title="Email"
                    v-model="entry.email"
                    :errors="errors.email"
                    type="email"
                    required
                />
                <text-field
                    title="Password"
                    v-model="entry.password"
                    :errors="errors.password"
                    autocomplete="new-password"
                    type="password"
                    :required="!editing"
                />
                <text-field
                    v-if="!editing"
                    title="Confirm password"
                    v-model="entry.password_confirmation"
                    type="password"
                    required
                />

                <select-field
                    v-if="entry.id != $auth.user().id"
                    title="Role"
                    endpoint="admin/roles"
                    label="title"
                    valueName="id"
                    v-model="entry.role_id"
                    :errors="errors.role_id"
                    :clearable="false"
                />

                <div class="flex items-center space-x-3">
                    <button
                        :disabled="saving"
                        class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                    >Save</button>

                    <button
                        v-if="editing && entry.id != $auth.user().id"
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
                name: "admin.users",
                endpoint: "admin/users"
            },

            entry: {
                role: null
            }
        };
    }
};
</script>