import domains from './domains';
import links from './links';

export default [
    {
        path: '/account',
        component: require('@/layouts/account').default,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                redirect: to => {
                    return {
                        name: 'account.dashboard'
                    }
                }
            },
            {
                name: 'account.dashboard',
                path: 'dashboard',
                component: require('@/views/account/dashboard/show').default,
            },
            {
                name: 'account.profile',
                path: 'profile',
                component: require('@/views/account/profile/form').default,
            },
            ...domains,
            ...links
        ]
    }
]