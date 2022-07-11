<template>
    <div>
        <div class="py-6 mb-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-700 leading-none">{{ title }}</h1>

                <div class="flex space-x-3" v-if="hasSearch || !! this.$slots.header">
                    <div v-if="hasSearch" class="relative rounded-md">
                        <input
                            v-model="filter.search"
                            placeholder="Search"
                            class="appearance-none block w-full bg-gray-200 border-transparent focus:border-transparent border rounded-lg py-2 px-3 text-sm text-gray-600 font-normal leading-5 focus:outline-none focus:shadow-outline-gray"
                        />
                        <div
                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                        >
                            <svg
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                class="h-5 w-5 text-gray-400"
                            >
                                <path
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </div>
                    </div>

                    <slot name="header-buttons"></slot>
                </div>
            </div>
        </div>

        <div class="-mx-1 overflow-auto">
            <table class="px-1 table min-w-full text-sm border-separate border-spacing">
                <thead>
                    <tr
                        class="text-left leading-4 font-bold text-gray-500 uppercase tracking-wider"
                    >
                        <template v-if="columns">
                            <th
                                @click="toggleSort(column)"
                                class="py-2 px-6 whitespace-no-wrap"
                                :class="{ 'hover:text-gray-600 cursor-pointer': column.sort }"
                                v-for="(column, index) in columns"
                                :key="index"
                            >
                                <div class="flex items-center">
                                    {{ column.title }}
                                    <svg
                                        :class="{ 'rotate-180': sort.direction === 'asc' }"
                                        class="w-4 h-4 transform"
                                        v-show="sort.field === column.sort"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                            fill-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                            </th>
                        </template>

                        <th
                            class="text-right leading-4 font-bold text-gray-500 uppercase tracking-wider"
                            scope="col"
                            v-if="hasActions"
                        >&nbsp;</th>
                    </tr>

                    <slot name="table-header" />
                </thead>

                <tbody class="text-gray-600">
                    <tr
                        class="p-4 rounded-lg shadow-sm hover:shadow-md overflow-hidden"
                        v-for="entry in entries"
                        :key="entry.id"
                    >
                        <slot name="row" :entry="entry"></slot>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3 flex justify-between">
            <paginate
                v-if="pagination && totalPages > 1"
                v-model="page"
                :pageCount="totalPages"
                :clickHandler="fetch"
                :prevText="'&#8249;'"
                :nextText="'&#8250;'"
                containerClass="pagination"
                pageClass="page-link"
                pageLinkClass="outline-none"
                prevClass="page-link"
                prevLinkClass="outline-none"
                nextClass="page-link"
                nextLinkClass="outline-none"
                activeClass="active"
                disabledClass="disabled"
            />
        </div>
    </div>
</template>

<script>
import qs from "qs";
import Paginate from "vuejs-paginate";

export default {
    components: {
        Paginate
    },

    props: {
        defaultSort: {
            type: String
        },
        hasActions: {
            type: Boolean,
            default: false
        },
        hasSearch: {
            type: Boolean,
            default: true
        },
        columns: {
            type: Array
        },
        endpoint: {
            type: String
        },
        deleteEndpoint: {
            type: String
        },
        title: {
            type: String
        },
        pagination: {
            type: Boolean,
            default: true
        },
        query: {
            type: Object,
            default: () => {
                {
                }
            }
        }
    },

    data() {
        return {
            totalPages: 0,
            entries: [],
            page: 1,
            filter: {
                search: undefined
            },
            ready: false,
            sort: {
                direction: "desc",
                field: this.defaultSort ? this.defaultSort : ""
            }
        };
    },

    mounted() {
        this.refresh();
    },

    methods: {
        toggleSort(column) {
            if (!column.sort) {
                return false;
            }

            if (this.sort.field === column.sort) {
                this.sort.direction =
                    this.sort.direction === "desc" ? "asc" : "desc";
            } else {
                this.sort.field = column.sort;
                this.sort.direction = "desc";
            }

            this.refresh();
        },

        addEntry(entry) {
            this.entries = [entry, ...this.entries];
        },

        removeEntry(entry) {
            this.entries.splice(this.entries.indexOf(entry), 1);
        },

        updateEntry(updatedEntry) {
            let entry = this.entries.find(
                entry => entry.id === updatedEntry.id
            );

            for (let key in updatedEntry) {
                if (entry[key] && typeof entry[key] === updatedEntry[key]) {
                    entry[key] = updatedEntry[key];
                }
            }
        },

        refresh() {
            this.page = 1;
            this.fetch();
        },

        fetch() {
            this.selected = [];
            this.selectedAll = false;
            this.ready = false;

            axios
                .get(this.endpoint, {
                    params: {
                        page: this.page,
                        filter: this.filter,
                        sort: this.sort.field
                            ? (this.sort.direction === "desc" ? "-" : "") +
                              this.sort.field
                            : undefined
                    },
                    paramsSerializer: params => {
                        return qs.stringify(params);
                    }
                })
                .then(response => {
                    if (this.pagination) {
                        this.totalPages = response.data.meta.last_page;
                    }
                    this.entries = [];
                    this.entries = response.data.data;
                    this.ready = true;
                });
        },

        search() {
            this.debouncer(() => {
                this.refresh();
            });
        }
    },

    watch: {
        filter: {
            handler(value, oldValue) {
                this.search();
            },
            deep: true
        }
    }
};
</script>