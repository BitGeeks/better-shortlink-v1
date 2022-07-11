<template>
    <div
        v-click-outside="()=>{ show = false }"
        class="p-1 text-gray-400 rounded-full hover:bg-gray-200 hover:text-gray-500 focus:outline-none focus:shadow-outline focus:text-gray-500 relative"
    >
        <button
            @click="show = !show"
            class="flex items-center rounded-full focus:outline-none focus:shadow-outline"
        >
            <img class="h-7 w-7 rounded-full" :src="$auth.user().image_url" />
        </button>

        <transition
            enter-class="transition ease-out duration-300"
            enter-active-class="transform opacity-0 scale-0"
            enter-to-class="transform opacity-100 scale-100"
            leave-class="transition ease-in duration-300"
            leave-active-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-0"
        >
            <div
                v-show="show"
                class="mt-1 origin-top-right absolute right-0 w-48 rounded-lg border border-gray-100 shadow-lg z-10"
            >
                <div class="rounded-lg bg-white">
                    <div class="p-2">
                        <router-link
                            :to="{ name: 'account.profile' }"
                            class="inline-flex items-center w-full rounded-lg px-2 py-2 leading-5 text-xs font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-600"
                        >Settings</router-link>
                        <a
                            href="#"
                            @click.prevent="$auth.logout()"
                            class="inline-flex items-center w-full rounded-lg px-2 py-2 leading-5 text-xs font-semibold text-gray-500 hover:bg-gray-100 hover:text-gray-600"
                        >Logout</a>
                    </div>
                </div>
            </div>
        </transition>
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
    }
};
</script>