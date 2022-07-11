<template>
    <div class="h-screen bg-gradient-gray flex items-center">
        <div class="mx-auto text-center">
            <h1 class="text-6xl font-bold text-gray-700">404</h1>
            <div class="font-medium text-gray-700">The requested page was not found</div>

            <router-link
                :to="{ name: 'home' }"
                class="mt-5 px-6 py-2 rounded-lg inline-flex text-gray-700 hover:text-gray-800 border-gray-700 hover:border-gray-800 border-2 leading-5"
            >Get back</router-link>
        </div>
    </div>
</template>