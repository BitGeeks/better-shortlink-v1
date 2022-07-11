<template>
    <div class="bg-white relative z-10 flex-shrink-0 flex py-4">
        <div class="max-w-6xl w-full mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex-1 flex items-center justify-between">
                <!-- mobile navbar -->
                <navbar />

                <!-- left part -->
                <div class="sm:flex hidden flex-1 items-center">
                    <div class="text-lg font-black text-gray-600">shorty</div>

                    <div class="w-full flex items-center justify-between ml-4 space-x-4">
                        <!-- user-area -->
                        <div class="space-x-4">
                            <router-link
                                :to="{ name: 'account.dashboard' }"
                                v-slot="{ href, navigate, isActive }"
                            >
                                <a
                                    @click="navigate"
                                    :href="href"
                                    :class="[isActive && 'bg-green-400 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
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
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
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
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
                                >My Domains</a>
                            </router-link>
                        </div>

                        <!-- admin-area -->
                        <div class="space-x-4">
                            <router-link
                                v-if="$auth.check('access-admin-dashboard')"
                                :to="{ name: 'admin.dashboard' }"
                                v-slot="{ href, navigate, isActive }"
                            >
                                <a
                                    @click="navigate"
                                    :href="href"
                                    :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
                                >Analytics</a>
                            </router-link>

                            <router-link
                                v-if="$auth.check('manage-all-links')"
                                :to="{ name: 'admin.links.index' }"
                                v-slot="{ href, navigate, isActive }"
                            >
                                <a
                                    @click="navigate"
                                    :href="href"
                                    :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
                                >Links</a>
                            </router-link>

                            <router-link
                                v-if="$auth.check('manage-public-domains')"
                                :to="{ name: 'admin.domains.index' }"
                                v-slot="{ href, navigate, isActive }"
                            >
                                <a
                                    @click="navigate"
                                    :href="href"
                                    :class="[isActive && 'bg-gray-700 text-white', !isActive && 'hover:bg-gray-100 gray-600']"
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
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
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
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
                                    class="px-4 py-1.5 rounded-lg font-medium text-sm"
                                >Roles</a>
                            </router-link>
                        </div>
                    </div>
                </div>

                <!-- right part -->
                <div class="ml-4 md:ml-6 flex items-center space-x-4">
                    <!-- profile dropdown -->
                    <profile />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Profile from "./profile";
import Navbar from "./navbar";

export default {
    components: { Profile, Navbar }
};
</script>