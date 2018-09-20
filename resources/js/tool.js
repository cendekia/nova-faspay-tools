Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'faspay-tools',
            path: '/faspay-tools',
            component: require('./components/Tool'),
        },
    ])
})
