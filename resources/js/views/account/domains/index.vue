<template>
    <resource-index
        title="Domains"
        endpoint="account/domains"
        :columns="columns"
        :hasActions="true"
        :hasFilters="false"
    >
        <template slot="header-buttons">
            <router-link
                href="#"
                :to="{
                    name: 'account.domains.create',
                }"
                class="py-2 px-6 rounded-lg inline-flex justify-center items-center leading-5 text-white tracking-wide bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
            >Create</router-link>
        </template>

        <template v-slot:row="slotProps">
            <td class="rounded-l-lg bg-white py-4 px-6">{{ slotProps.entry.id }}</td>
            <td class="bg-white py-4 px-6">{{ slotProps.entry.name }}</td>
            <td class="bg-white py-4 px-6">
                <span
                    class="inline-flex whitespace-no-wrap items-center px-2 py-1 leading-4 text-xs font-medium rounded-lg bg-gray-200 text-gray-600"
                >{{ slotProps.entry.links_count }}</span>
            </td>

            <td class="rounded-r-lg bg-white py-4 px-6 text-right">
                <router-link
                    :to="{
                        name: 'account.domains.edit',
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
                    title: "Name",
                    sort: "name"
                },
                {
                    title: "Links",
                    sort: "links_count"
                }
            ]
        };
    }
};
</script>