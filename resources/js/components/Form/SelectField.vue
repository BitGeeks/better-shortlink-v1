<template>
    <default-field :errors="errors" :onMount="onMount" :title="title" :wrap="wrap">
        <template v-slot:field="slotProps">
            <v-select
                :components="{ OpenIndicator, Deselect }"
                @search="search"
                class="select-input"
                :class="[slotProps.hasErrors ? invalidClass : '', className]"
                v-bind="$attrs"
                v-on:input="setValue"
                :reduce="item => item[valueName]"
                :multiple="multiple"
                :options="hasEmpty ? [emptyItem, ...entries] : entries"
                :label="label"
                autocomplete="nope"
                :filterable="false"
            />
        </template>
    </default-field>
</template>

<script>
import qs from "qs";
import vSelect from "vue-select";
import DefaultField from "./DefaultField";
import OpenIndicator from "./Select/OpenIndicator";
import Deselect from "./Select/Deselect";

export default {
    components: {
        DefaultField,
        vSelect
    },

    inheritAttrs: false,

    props: {
        hasEmpty: {
            type: Boolean,
            default: false
        },
        emptyLabel: {
            type: String,
            default: "Добавить"
        },
        emptyValue: {
            type: [String, Number],
            default: -1
        },
        className: {
            type: String,
            default: ""
        },
        invalidClass: {
            type: String,
            default: "is-invalid"
        },
        errors: {
            type: Array,
            default: () => []
        },
        valueName: {
            type: String,
            default: "value"
        },
        options: {
            type: Array,
            default: () => []
        },
        title: {
            type: String,
            default: null
        },
        multiple: {
            type: Boolean,
            default: false
        },
        wrap: {
            type: Boolean,
            default: true
        },
        endpoint: {
            type: String
        },
        params: {
            type: Object,
            default: () => {
                return {};
            }
        },
        searchField: {
            type: String,
            default: "search"
        },
        initOption: {
            type: Object
        },
        label: {
            type: String,
            default: "name"
        }
    },

    data() {
        return {
            OpenIndicator: OpenIndicator,
            Deselect: Deselect,
            queryParams: this.params,
            entries: this.options,
            firstRequest: true
        };
    },

    computed: {
        emptyItem() {
            if (!this.hasEmpty) {
                return {};
            }

            let emptyItem = {};
            emptyItem[this.valueName] = this.emptyValue;
            emptyItem[this.label] = this.emptyLabel;

            return emptyItem;
        }
    },

    methods: {
        search: _.debounce(function(query, loading) {
            if (!this.endpoint) {
                return;
            }

            if (!this.queryParams.filter) {
                this.queryParams.filter = {};
            }

            this.queryParams.filter[this.searchField] = query;

            loading(true);
            this.fetch();
            loading(false);
        }, 500),

        async fetch() {
            await axios
                .get(this.endpoint, {
                    params: this.queryParams,
                    paramsSerializer: params => {
                        return qs.stringify(params);
                    }
                })
                .then(response => response.data.data)
                .then(entries => {
                    this.entries = entries;
                });

            if (this.firstRequest && this.initOption) {
                this.appendInitOption();
                this.firstRequest = false;
            } else {
                if (this.$attrs.value) {
                    this.$emit("input", this.$attrs.value);
                }
            }

            this.$emit("update:options", this.entries);
        },

        appendInitOption() {
            let optionExists = !!this.entries.find(
                entry =>
                    entry[this.valueName] === this.initOption[this.valueName]
            );

            if (optionExists || !this.initOption) {
                return;
            }

            this.entries.push(this.initOption);
        },

        setValue(value) {
            this.$emit("input", value);
        },

        onMount() {
            if (this.endpoint) {
                this.fetch();
            }
        }
    },

    watch: {
        options(value) {
            if (!this.endpoint) {
                this.entries = this.options;
            }
        }
    }
};
</script>