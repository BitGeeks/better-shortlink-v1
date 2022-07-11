export default [
    {
        path: 'permissions',
        name: 'admin.permissions.index',
        component: require('@/views/admin/permissions/permissions/index').default,
        meta: {
            auth: {
                roles: 'manage-roles'
            }
        }
    },
    {
        path: 'permissions/create',
        name: 'admin.permissions.create',
        component: require('@/views/admin/permissions/permissions/form').default,
        meta: {
            mode: 'create',
            auth: {
                roles: 'manage-roles'
            }
        }
    },
    {
        path: 'permissions/:id',
        name: 'admin.permissions.edit',
        component: require('@/views/admin/permissions/permissions/form').default,
        meta: {
            mode: 'edit',
            auth: {
                roles: 'manage-roles'
            }
        }
    },

    {
        path: 'roles',
        name: 'admin.roles.index',
        component: require('@/views/admin/permissions/roles/index').default,
        meta: {
            auth: {
                roles: 'manage-roles'
            }
        }
    },
    {
        path: 'roles/create',
        name: 'admin.roles.create',
        component: require('@/views/admin/permissions/roles/form').default,
        meta: {
            mode: 'create',
            auth: {
                roles: 'manage-roles'
            }
        }
    },
    {
        path: 'roles/:id',
        name: 'admin.roles.edit',
        component: require('@/views/admin/permissions/roles/form').default,
        meta: {
            mode: 'edit',
            auth: {
                roles: 'manage-roles'
            }
        }
    },
]