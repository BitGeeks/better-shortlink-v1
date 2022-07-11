<template>
    <div v-click-outside="() => { show = false }">
        <!-- mobile toggle -->
        <button
            @click="show = !show"
            class="md:hidden mr-4 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600"
        >
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h7"
                />
            </svg>
        </button>

        <div v-show="show" class="absolute inset-x-0 origin-top">
            <div class="bg-white w-full px-4 py-4 rounded-lg shadow-lg">
                <div class="space-y-3 flex flex-col">
                    <router-link
                        :to="{ name: 'account.dashboard' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-green-400 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Dashboard</a>
                    </router-link>

                    <router-link
                        :to="{ name: 'account.links.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-green-400 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >My Links</a>
                    </router-link>

                    <router-link
                        :to="{ name: 'account.domains.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-green-400 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >My Domains</a>
                    </router-link>

                    <!-- admin area -->

                    <router-link
                        :to="{ name: 'admin.dashboard' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Analytics</a>
                    </router-link>

                    <router-link
                        :to="{ name: 'admin.links.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Links</a>
                    </router-link>

                    <router-link
                        v-if="$auth.check('manage-domains')"
                        :to="{ name: 'admin.domains.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Domains</a>
                    </router-link>

                    <router-link
                        v-if="$auth.check('manage-users')"
                        :to="{ name: 'admin.users.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Users</a>
                    </router-link>

                    <router-link
                        v-if="$auth.check('manage-roles')"
                        :to="{ name: 'admin.roles.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Roles</a>
                    </router-link>

                    <router-link
                        v-if="$auth.check('manage-roles')"
                        :to="{ name: 'admin.permissions.index' }"
                        v-slot="{ href, navigate, isActive }"
                    >
                        <a
                            @click="navigate"
                            :href="href"
                            :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                            class="px-4 py-2 rounded-lg font-medium text-sm"
                        >Permissions</a>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from "v-click-outside";

export default {
    directives: {
        clickOutside: vClickOutside.directive
    },

    data() {
        return {
            show: false
        };
    },

    watch: {
        $route(to, from) {
            this.show = false;
        }
    }
};
</script>