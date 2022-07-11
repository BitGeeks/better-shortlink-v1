export default [
    {
        path: 'links',
        name: 'admin.links.index',
        component: require('@/views/admin/links/index').default,
        meta: {}
    },
    {
        path: 'links/create',
        name: 'admin.links.create',
        component: require('@/views/admin/links/form').default,
        meta: {
            mode: 'create'
        }
    },
    {
        path: 'links/:id',
        name: 'admin.links.edit',
        component: require('@/views/admin/links/form').default,
        meta: {
            mode: 'edit'
        }
    },
    {
        path: 'links/:id/analytics',
        name: 'admin.links.analytics',
        component: require('@/views/admin/links/analytics').default,
    },
]