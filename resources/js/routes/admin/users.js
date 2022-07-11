export default [
    {
        path: 'users',
        name: 'admin.users.index',
        component: require('@/views/admin/users/index').default,
        meta: {
            auth: {
                roles: 'manage-users'
            }
        }
    },
    {
        path: 'users/create',
        name: 'admin.users.create',
        component: require('@/views/admin/users/form').default,
        meta: {
            mode: 'create',
            auth: {
                roles: 'manage-users'
            }
        }
    },
    {
        path: 'users/:id',
        name: 'admin.users.edit',
        component: require('@/views/admin/users/form').default,
        meta: {
            mode: 'edit',
            auth: {
                roles: 'manage-users'
            }
        }
    },
]