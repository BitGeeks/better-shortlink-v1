export default [
    {
        path: 'links',
        name: 'account.links.index',
        component: require('@/views/account/links/index').default,
        meta: {}
    },
    {
        path: 'links/create',
        name: 'account.links.create',
        component: require('@/views/account/links/form').default,
        meta: {
            mode: 'create'
        }
    },
    {
        path: 'links/:id',
        name: 'account.links.edit',
        component: require('@/views/account/links/form').default,
        meta: {
            mode: 'edit'
        }
    },
    {
        path: 'links/:id/analytics',
        name: 'account.links.analytics',
        component: require('@/views/account/links/analytics').default,
    },
]