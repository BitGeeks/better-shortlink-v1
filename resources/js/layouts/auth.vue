<template>
    <div class="h-screen">
        <div class="min-h-full mx-auto max-w-sm sm:max-w-md md:max-w-lg w-full flex flex-col">
            <div class="mt-8 flex-1 h-full flex items-center bg-white">
                <div class="w-full">
                    <router-view :key="$route.name"></router-view>
                </div>
            </div>

            <div class="pt-4 pb-8 space-x-3">
                <a
                    href="#"
                    class="text-base font-semibold text-gray-500 hover:text-gray-600"
                >Terms and Conditions</a>
                <a
                    href="#"
                    class="text-base font-semibold text-gray-500 hover:text-gray-600"
                >Contact Us</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
