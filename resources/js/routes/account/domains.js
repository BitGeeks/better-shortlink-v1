export default [
    {
        path: 'domains',
        name: 'account.domains.index',
        component: require('@/views/account/domains/index').default,
        meta: {}
    },
    {
        path: 'domains/create',
        name: 'account.domains.create',
        component: require('@/views/account/domains/form').default,
        meta: {
            mode: 'create'
        }
    },
    {
        path: 'domains/:id',
        name: 'account.domains.edit',
        component: require('@/views/account/domains/form').default,
        meta: {
            mode: 'edit'
        }
    },
]