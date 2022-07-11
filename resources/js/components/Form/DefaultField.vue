<template>
    <div :class="{'mb-5': wrap}">
        <label v-if="title" class="font-bold text-lg">{{ title }}</label>

        <slot name="field" :hasErrors="hasErrors"></slot>

        <div class="mt-2 text-xs leading-4 text-red-500" v-if="hasErrors" v-html="firstError"></div>
    </div>
</template>

<script>
export default {
    props: {
        errors: Array,

        title: {
            type: String,
            default: null
        },

        wrap: {
            type: Boolean,
            default: true
        },

        onMount: {
            type: Function,
            default: function() {}
        }
    },

    computed: {
        hasErrors() {
            return !!this.errors.length;
        },

        firstError() {
            return this.errors[0];
        }
    },

    mounted() {
        this.onMount();
    }
};
</script>