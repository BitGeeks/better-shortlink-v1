import domains from './domains';
import links from './links';
import permissions from './permissions';
import users from './users';

export default [
    {
        path: '/admin',
        component: require('@/layouts/account').default,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                redirect: to => {
                    return {
                        name: 'admin.dashboard'
                    }
                }
            },
            {
                name: 'admin.dashboard',
                path: 'dashboard',
                component: require('@/views/admin/dashboard/show').default,
            },
            ...domains,
            ...links,
            ...permissions,
            ...users
        ]
    }
]