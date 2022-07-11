export default [
    {
        path: 'domains',
        name: 'admin.domains.index',
        component: require('@/views/admin/domains/index').default,
        meta: {
            auth: {
                roles: 'manage-public-domains'
            }
        }
    },
    {
        path: 'domains/create',
        name: 'admin.domains.create',
        component: require('@/views/admin/domains/form').default,
        meta: {
            mode: 'create',
            auth: {
                roles: 'manage-public-domains'
            }
        }
    },
    {
        path: 'domains/:id',
        name: 'admin.domains.edit',
        component: require('@/views/admin/domains/form').default,
        meta: {
            mode: 'edit',
            auth: {
                roles: 'manage-public-domains'
            }
        }
    },
]