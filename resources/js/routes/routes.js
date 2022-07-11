import auth from './auth';
import account from './account/routes';
import admin from './admin/routes';

export default [
    {
        path: '',
        component: require('@/layouts/main').default,
        children: [
            {
                path: '',
                name: 'home',
                component: require('@/views/main/home').default,
            },
            {
                path: 'links/:hash',
                name: 'links.protection',
                component: require('@/views/main/protection').default,
            }
        ]
    },

    ...auth,
    ...account,
    ...admin,

    {
        path: '/404',
        name: '404',
        component: require('@/views/errors/404').default
    },

    {
        path: '/403',
        name: '403',
        component: require('@/views/errors/403').default
    },

    { path: "*", redirect: '404' }
];
