<template>
    <div>
        <div v-if="$auth.ready()">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    }
};
</script>