import Vue from 'vue';
import Base from './mixins';
import axios from 'axios';
import Routes from './routes/routes';
import VueRouter from 'vue-router';
import moment from 'moment-timezone';
import VueSweetalert2 from 'vue-sweetalert2';

window._ = require('lodash');
Vue.set(Vue.prototype, '_', _);

/** Event bus */
window.Bus = new Vue();

/** Axios parameters */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = '/api/';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}

window.axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (403 === error.response.status) {
        // window.location = '/403';
        console.log('asd');
    } else {
        return Promise.reject(error);
    }
});

Vue.axios = axios;

/** Sweetalert */
Vue.use(VueSweetalert2);

/** Default timezone */
window.moment = moment;

/** Toast notifications */
import VueToast from 'vue-toast-notification';
Vue.use(VueToast, {
    position: 'top-right',
    duration: 2000,
});

/** Router */
Vue.use(VueRouter);
const router = new VueRouter({
    routes: Routes,
    mode: 'history',
    base: '/',
});

router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0);

    next();
})

Vue.router = router;

/** Clipboard */
import VueClipboard from 'vue-clipboard2'

VueClipboard.config.autoSetContainer = true
Vue.use(VueClipboard)

/** Authentication */
import VueAuth from '@websanova/vue-auth';
import Auth from './auth';
Vue.use(VueAuth, Auth);

Vue.auth.permissions = function (permission) {
    return this.options.check.call(this, permission, 'access');
};

/** Global components */
import './components';

/** Mixins */
Vue.mixin(Base);

/**
 * Create vue instance
 */
import App from './components/App';

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
