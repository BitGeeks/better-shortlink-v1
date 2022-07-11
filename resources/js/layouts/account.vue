<template>
    <div class="h-screen flex overflow-hidden bg-gray-100 text-gray-600 text-sm">
        <main class="flex-1 relative z-0 overflow-y-auto">
            <heading />

            <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-8 pb-16">
                <router-view :key="$route.name"></router-view>
            </div>
        </main>
    </div>
</template>

<script>
import Heading from "./partials/heading";

export default {
    components: {
        Heading
    }
};
</script>