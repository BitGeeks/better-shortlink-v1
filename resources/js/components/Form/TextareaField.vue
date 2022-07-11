<template>
    <default-field :errors="errors" :title="title" :wrap="wrap">
        <template v-slot:field="slotProps">
            <textarea
                class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                :class="{ 'border-red-400 focus:shadow-outline-red' : slotProps.hasErrors }"
                v-bind="$attrs"
                v-on:input="$emit('input', $event.target.value)"
            ></textarea>
        </template>
    </default-field>
</template>

<script>
import DefaultField from "./DefaultField";

export default {
    components: {
        DefaultField
    },

    inheritAttrs: false,

    props: {
        errors: {
            type: Array,
            default: () => []
        },
        title: {
            type: String,
            default: null
        },
        wrap: {
            type: Boolean,
            default: true
        }
    }
};
</script>