<template>
    <div v-if="resource.ready">
        <div class="py-6">
            <div>
                <div class="text-xs font-medium mb-2">
                    <span class="text-gray-400">Settings</span>
                </div>
                <h2 class="text-xl font-semibold text-gray-700 leading-none">Profile</h2>
            </div>
        </div>

        <div class="px-6 py-5 bg-white shadow rounded-xl">
            <form @submit.prevent="submit">
                <text-field title="Name" v-model="entry.name" :errors="errors.name" required />
                <text-field
                    title="Email"
                    v-model="entry.email"
                    :errors="errors.email"
                    type="email"
                    required
                />
                <text-field
                    title="Password"
                    v-model="entry.password"
                    :errors="errors.password"
                    autocomplete="new-password"
                    type="password"
                />
                <text-field
                    v-if="entry.password"
                    title="Confirm password"
                    v-model="entry.password_confirmation"
                    type="password"
                    required
                />

                <div class="mb-5">
                    <label class="font-bold text-lg">Avatar</label>
                    <div class="mt-3 flex items-center">
                        <span class="h-16 w-16 rounded-full overflow-hidden bg-gray-100">
                            <img class="w-full h-full" :src="entry.image_url" />
                        </span>
                        <span class="ml-5 rounded-md shadow-sm">
                            <button
                                @click="chooseImage"
                                type="button"
                                class="py-2 px-6 border border-gray-300 rounded-md text-base leading-6 font-semibold text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                            >Change</button>
                        </span>
                    </div>
                </div>

                <input ref="fileInput" class="hidden" type="file" @change="uploadImage" />

                <div class="flex items-center space-x-3">
                    <button
                        :disabled="saving"
                        class="py-3 px-8 rounded-lg inline-flex justify-center items-center font-semibold text-base leading-6 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                    >Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import ResourceForm from "@/components/Resource/ResourceForm";

export default {
    extends: ResourceForm,

    data() {
        return {
            resource: {
                routes: {
                    show: "account/profile",
                    update: "account/profile"
                }
            },

            entry: {
                image_url: null
            }
        };
    },

    methods: {
        chooseImage() {
            this.$refs.fileInput.click();
        },

        uploadImage(event) {
            this.file = event.target.files[0];

            const data = new FormData();
            data.append("file", this.file);

            axios.post("/account/profile/image", data).then(({ data }) => {
                this.entry.image_url = data.url;
                this.entry.image = data.path;
            });
        },

        onUpdate() {
            this.$toast.success("Profile updated");
            this.$auth.user().image_url = this.entry.image_url;
        }
    }
};
</script>