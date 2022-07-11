<template>
    <div class="relative">
        <button class="hidden sm:flex sm:items-center focus:outline-none" @click="toggle">
            <slot name="toggle">
                <span class="hidden lg:inline ml-4 mr-2 text-sm font-medium text-white">{{ label }}</span>
            </slot>
            <svg
                v-if="showArrow"
                viewBox="0 0 24 24"
                class="ml-2 h-6 w-6 fill-current text-white lg:ml-auto"
            >
                <path
                    d="M7.293 9.293a1 1 0 011.414 0L12 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                />
            </svg>
        </button>

        <div v-if="opened" @click="close" class="fixed inset-0" tabindex="-1"></div>

        <transition
            enter-class="opacity-0 scale-90"
            enter-active-class="ease-out transition-fastest"
            enter-to-class="opacity-100 scale-100"
            leave-class="opacity-100 scale-100"
            leave-active-class="ease-in transition-fastest"
            leave-to-class="opacity-0 scale-90"
        >
            <div v-show="opened" class="mt-3 absolute right-0 origin-top-right z-50">
                <div :class="`w-` + width" class="text-left bg-white rounded-lg shadow-lg border">
                    <slot name="actions">
                        <template v-for="(action,index) in actions">
                            <div class="py-1 border-b-2 border-gray-200" :key="index">
                                <router-link
                                    @click.native="close"
                                    :to="action.route"
                                    class="block px-4 py-2 leading-tight hover:bg-gray-200"
                                >{{ action.label }}</router-link>
                            </div>
                        </template>
                    </slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        label: String,
        actions: {
            type: Array,
            default: () => {
                [];
            }
        },
        showArrow: {
            type: Boolean,
            default: true
        },
        width: {
            type: Number,
            default: 48
        },
        hasActions: {
            type: Boolean,
            default: true
        }
    },

    computed: {
        canOpen() {
            return this.hasActions || (this.actions && this.actions.length > 0);
        }
    },

    data() {
        return {
            opened: false
        };
    },

    methods: {
        toggle() {
            if (this.canOpen) {
                this.opened = !this.opened;
            }
        },

        close() {
            this.opened = false;
        }
    }
};
</script>
