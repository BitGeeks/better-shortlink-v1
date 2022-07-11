<template>
    <div>
        <h1 class="text-4xl font-bold text-gray-700">Welcome to Shorty</h1>
        <div class="text-base font-semibold text-gray-400">
            Already have an account?
            <router-link
                :to="{ name: 'auth.login' }"
                class="text-blue-500 hover:text-blue-600"
            >Sign In</router-link>
        </div>

        <form @submit.prevent="submit" class="mt-8">
            <div class="mb-5">
                <label for="name" class="font-bold text-lg">Name</label>
                <input
                    v-model="data.name"
                    id="name"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    requied
                />
                <div
                    class="mt-2 text-xs leading-4 text-red-500"
                    v-if="errors.name"
                    v-html="errors.name[0]"
                ></div>
            </div>

            <div class="mb-5">
                <label for="email" class="font-bold text-lg">Email</label>
                <input
                    v-model="data.email"
                    id="email"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    requied
                />
                <div
                    class="mt-2 text-xs leading-4 text-red-500"
                    v-if="errors.email"
                    v-html="errors.email[0]"
                ></div>
            </div>

            <div class="mb-5">
                <div class="flex justify-between">
                    <label for="password" class="font-bold text-lg">Password</label>
                </div>
                <input
                    v-model="data.password"
                    id="password"
                    type="password"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    required
                />
                <div
                    class="mt-2 text-xs leading-4 text-red-500"
                    v-if="errors.password"
                    v-html="errors.password[0]"
                ></div>
            </div>

            <div class="mb-5">
                <div class="flex justify-between">
                    <label for="password_confirmation" class="font-bold text-lg">Confirm password</label>
                </div>
                <input
                    v-model="data.password_confirmation"
                    id="password_confirmation"
                    type="password"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    required
                />
            </div>

            <div class="flex items-center space-x-3">
                <button
                    class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                >Sign Up</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: {},
            data: {}
        };
    },

    methods: {
        submit() {
            this.errors = {};

            this.$auth
                .register({
                    data: this.data,
                    autoLogin: true,
                    rememberMe: true,
                    redirect: {
                        name: "account.dashboard"
                    }
                })
                .then(
                    () => {
                        // success
                    },
                    ({ response }) => {
                        this.errors = response.data.errors;
                    }
                );
        }
    }
};
</script>