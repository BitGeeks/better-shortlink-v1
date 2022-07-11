<template>
    <analytics endpoint="admin/dashboard">
        <template v-slot:heading>
            <div class="py-8">
                <h2 class="text-xl font-semibold text-gray-700 leading-none">Dashboard</h2>
            </div>
        </template>
    </analytics>
</template>

<script>
import Analytics from "@/views/common/analytics";

export default {
    components: { Analytics }
};
</script>