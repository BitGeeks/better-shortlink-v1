<template>
    <div class="h-screen bg-gradient-yellow flex items-center">
        <div class="mx-auto text-center">
            <h1 class="text-6xl font-bold text-yellow-700">403</h1>
            <div class="font-medium text-yellow-700">You don't have permission to access this page</div>

            <router-link
                :to="{ name: 'home' }"
                class="mt-5 px-6 py-2 rounded-lg inline-flex text-yellow-700 hover:text-yellow-800 border-yellow-700 hover:border-yellow-800 border-2 leading-5"
            >Get back</router-link>
        </div>
    </div>
</template>