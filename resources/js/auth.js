import bearer from "@websanova/vue-auth/drivers/auth/bearer";
import authAxios from "@websanova/vue-auth/drivers/http/axios.1.x";
import router from "@websanova/vue-auth/drivers/router/vue-router.2.x";

const config = {
    auth: bearer,
    http: authAxios,
    router: router,
    tokenDefaultName: 'access_token',
    tokenStore: ['localStorage', 'cookie'],
    rolesKey: 'access',
    authRedirect: {
        path: '/login'
    },
    registerData: {
        url: '/auth/register',
        method: 'POST',
        redirect: '/login'
    },
    loginData: {
        url: '/auth/login',
        method: 'POST',
        redirect: '/dashboard',
        fetchUser: true
    },
    logoutData: {
        url: '/auth/logout',
        method: 'POST',
        redirect: '/login',
        makeRequest: true
    },
    fetchData: {
        url: '/auth/me',
        method: 'GET',
        enabled: true,
        success(response) {
            //
        }
    },
    forbiddenRedirect: { path: '/403' },
    notFoundRedirect: transition => {
        if (transition.meta.auth === false) {
            return {
                name: 'account.dashboard',
            };
        }
    },
    refreshData: { url: '/auth/refresh', method: 'GET', enabled: false, interval: 30 },
    parseUserData(data) {
        return data.data || {}
    }
};

export default config