<template>
    <resource-index
        title="Links"
        endpoint="account/links"
        :columns="columns"
        :hasActions="true"
        :hasFilters="false"
    >
        <template slot="header-buttons">
            <router-link
                href="#"
                :to="{
                    name: 'account.links.create',
                }"
                class="py-2 px-6 rounded-lg inline-flex justify-center items-center leading-5 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
            >Create</router-link>
        </template>

        <template v-slot:row="slotProps">
            <td class="rounded-l-lg bg-white py-4 px-6">{{ slotProps.entry.id }}</td>
            <td class="bg-white py-4 px-6 font-medium">{{ slotProps.entry.domain.name }}</td>
            <td class="bg-white py-4 px-6">
                <a
                    :href="slotProps.entry.url"
                    :title="slotProps.entry.url"
                    target="_blank"
                    class="font-medium text-blue-600 hover:text-blue-700"
                >{{ truncate(slotProps.entry.url, 32) }}</a>
            </td>
            <td class="bg-white py-4 px-6">
                <div v-if="slotProps.entry.expires_at">
                    <span
                        v-if="slotProps.entry.is_expired"
                        class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-red-200 text-red-600"
                    >{{ localTime(slotProps.entry.expires_at) }}</span>
                    <span
                        v-else
                        class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-green-200 text-green-600"
                    >{{ localTime(slotProps.entry.expires_at) }}</span>
                </div>
            </td>

            <td class="bg-white py-4 px-6">
                <span
                    v-if="slotProps.entry.is_protected"
                    class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-indigo-200 text-indigo-600"
                >Protected</span>
                <span
                    v-else
                    class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-blue-200 text-blue-600"
                >Unprotected</span>
            </td>
            <td class="bg-white py-4 px-6">
                <span
                    class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-gray-200 text-gray-600"
                >{{ slotProps.entry.clicks_count }}</span>
            </td>

            <td class="rounded-r-lg bg-white py-4 px-6 text-right space-x-2 whitespace-no-wrap">
                <router-link
                    :to="{
                        name: 'account.links.analytics',
                        params: {
                            id: slotProps.entry.id
                        }
                    }"
                    class="uppercase text-xs font-semibold text-blue-700 hover:text-blue-600"
                >Analytics</router-link>

                <router-link
                    :to="{
                        name: 'account.links.edit',
                        params: {
                            id: slotProps.entry.id
                        }
                    }"
                    class="uppercase text-xs font-semibold text-gray-600 hover:text-gray-500"
                >Open</router-link>
            </td>
        </template>
    </resource-index>
</template>

<script>
import ResourceIndex from "@/components/Resource/ResourceIndex";

export default {
    components: {
        ResourceIndex
    },

    data() {
        return {
            columns: [
                {
                    title: "ID",
                    sort: "id"
                },
                {
                    title: "Domain",
                    sort: "domain_id"
                },
                {
                    title: "URL",
                    sort: "url"
                },
                {
                    title: "Expiration",
                    sort: "expires_at"
                },
                {
                    title: "Protection",
                    sort: "password"
                },
                {
                    title: "Clicks",
                    sort: "clicks_count"
                }
            ]
        };
    }
};
</script>