<template>
    <default-field :errors="errors" :title="title" :wrap="wrap">
        <template v-slot:field="slotProps">
            <div class="w-full">
                <flat-pickr
                    :config="config"
                    class="appearance-none mt-1 block w-full bg-gray-100 border-gray-100 border rounded-lg py-4 px-4 text-lg text-gray-600 font-normal leading-normal focus:outline-none focus:shadow-outline-gray"
                    :class="{ 'border-red-400 focus:shadow-outline-red' : slotProps.hasErrors }"
                    v-bind="$attrs"
                    v-on:input="setValue"
                />
            </div>
        </template>
    </default-field>
</template>

<script>
import DefaultField from "./DefaultField";
import flatPickr from "vue-flatpickr-component";

export default {
    components: {
        DefaultField,
        flatPickr
    },

    inheritAttrs: false,

    data() {
        return {
            config: {
                altFormat: this.displayFormat,
                altInput: true,
                dateFormat: this.format,
                enableTime: this.time,
                time_24hr: this.time24hr,
                noCalendar: !this.calendar,
                mode: this.mode,
                locale: {
                    rangeSeparator: " - "
                },
                static: true,
                minuteIncrement: 1
            }
        };
    },

    props: {
        errors: {
            type: Array,
            default: () => []
        },
        format: {
            type: String,
            default: "Y-m-d"
        },
        displayFormat: {
            type: String,
            default: "d.m.Y"
        },
        wrap: {
            type: Boolean,
            default: true
        },
        wrapField: {
            type: Boolean,
            default: false
        },
        time: {
            type: Boolean,
            default: true
        },
        calendar: {
            type: Boolean,
            default: true
        },
        time24hr: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: null
        },
        mode: {
            type: String,
            default: "single"
        }
    },

    methods: {
        setValue(value) {
            this.$emit("input", value);
        }
    }
};
</script>