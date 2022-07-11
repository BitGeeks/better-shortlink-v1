<template>
    <div
        class="appearance-none mt-1 flex flex-wrap items-center w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 focus:shadow-outline-gray"
    >
        <div class="-mb-2 flex flex-wrap items-center w-full">
            <a
                @click.prevent="removeTag(tag)"
                href="#"
                v-for="tag in value"
                :key="tag.value"
                class="mb-2 mr-3 inline-flex items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-blue-200 hover:bg-blue-300 text-blue-600"
            >
                {{ tag.value }}
                <button
                    type="button"
                    class="flex-shrink-0 ml-1.5 inline-flex focus:outline-none"
                >
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                    </svg>
                </button>
            </a>

            <input
                @keydown.enter.stop.prevent="addTag"
                @keydown.188.stop.prevent="addTag"
                ref="input"
                v-model="newTag"
                class="mb-2 flex-1 text-lg text-gray-600 font-normal leading-normal bg-transparent focus:outline-none"
                type="text"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: ["value"],
    data() {
        return {
            newTag: ""
        };
    },
    methods: {
        removeTag(tag) {
            this.$emit(
                "input",
                this.value.filter(t => t !== tag)
            );
        },

        addTag() {
            if (
                this.newTag.trim().length === 0 ||
                this.value.find(
                    tag =>
                        tag.value.toLowerCase() ==
                        this.newTag.trim().toLowerCase()
                )
            ) {
                this.newTag = "";
                return;
            }

            this.$emit("input", [
                ...this.value,
                {
                    value: this.newTag.trim().toLowerCase()
                }
            ]);

            this.newTag = "";
        }
    }
};
</script>