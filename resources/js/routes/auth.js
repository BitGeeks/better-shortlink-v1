export default [
    {
        path: '',
        component: require('@/layouts/auth').default,
        children: [
            {
                path: '/login',
                name: 'auth.login',
                component: require('@/views/auth/login').default,
                meta: {
                    auth: false,
                },
            },
            {
                path: '/register',
                name: 'auth.register',
                component: require('@/views/auth/register').default,
                meta: {
                    auth: false,
                },
            }
        ]
    }
];