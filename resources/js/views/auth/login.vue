<template>
    <div>
        <h1 class="text-4xl font-bold text-gray-700">Welcome to Shorty</h1>
        <div class="text-base font-semibold text-gray-400">
            Don't have an account?
            <router-link
                :to="{ name: 'auth.register' }"
                class="text-blue-500 hover:text-blue-600"
            >Sign Up</router-link>
        </div>

        <form @submit.prevent="submit" class="mt-8">
            <div class="mb-5">
                <label for="email" class="font-bold text-lg">Email</label>
                <input
                    v-model="data.email"
                    id="email"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                />
                <div
                    class="mt-2 text-xs leading-4 text-red-500"
                    v-if="error"
                >These credentials do not match our records</div>
            </div>

            <div class="mb-5">
                <div class="flex justify-between">
                    <label for="password" class="font-bold text-lg">Password</label>
                    <a
                        href="#"
                        v-if="false"
                        class="font-semibold text-gray-500 hover:text-gray-600"
                    >Forgot password?</a>
                </div>
                <input
                    v-model="data.password"
                    id="password"
                    type="password"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                />
            </div>

            <div class="flex items-center space-x-3">
                <button
                    class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                >Sign In</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data: () => {
        return {
            error: false,
            data: {
                email:
                    process.env.MIX_ENV_MODE === "demo"
                        ? "admin@test.com"
                        : null,
                password: process.env.MIX_ENV_MODE === "demo" ? "secret" : null
            }
        };
    },
    methods: {
        submit() {
            this.$auth
                .login({
                    data: this.data,
                    staySignedIn: true,
                    fetch: true,
                    redirect: {
                        name: "account.dashboard"
                    }
                })
                .then(
                    () => {
                        // success
                    },
                    () => {
                        this.error = true;
                    }
                );
        }
    }
};
</script>