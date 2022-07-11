<template>
<nav>
<div class="menu-container">
        <div class="pull-left left">
            <a href="https://maxmines.com" aria-current="page" class="logo"></a>
            <a class="site" href="">Status</a>
        </div>
        <div class="pull-right right">
            <ul>
                <li>
                    <a href="https://maxmines.com/contact">Trợ giúp</a>
                </li>
                <li>
                    <a href="https://maxmines.com" class="back-home"><i class="fa fa-level-up-alt fa-rotate-270"></i> <span class="hidden-md-down">maxmines.com</span></a>
                </li>
                <li>
                    <router-link
                        :to="{ name: 'auth.login' }"
                        v-slot="{ href, navigate }"
                    >
                    <a @click="navigate"
                        :href="href"
                        class="bl pl24">
                        ĐĂNG NHẬP
                    </a>
                    </router-link>
                </li>
            </ul>
            <router-link
                :to="{ name: 'auth.register' }"
                v-slot="{ href, navigate, isActive }"
            >
                <a @click="navigate"
                    :href="href"
                    :class="[isActive && 'router-link-active']"
                    class="router-link-exact-active">
                    <button class="get-started btn primary normal">ĐĂNG KÝ</button>
                </a>
            </router-link>
        </div>
    </div>
</nav>
</template>

<script>
export default {};
</script>