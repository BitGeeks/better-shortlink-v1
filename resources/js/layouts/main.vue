<template>
        <div>
            <div>
                <Header />
            </div>
            <div class="page">
                <router-view :key="$route.name"></router-view>
            </div>

            <div class="pt-4 pb-8 space-x-3">
                <router-link
                    :to="{ name: 'auth.login' }"
                    class="text-base font-semibold text-gray-500 hover:text-gray-600"
                >Sign In</router-link>

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
</template>

<script>
import Header from "./homeTemplate/header";

export default {
    components: { Header }
};
</script>
