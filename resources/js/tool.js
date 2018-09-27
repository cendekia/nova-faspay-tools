import 'prismjs'
import 'prismjs/themes/prism-okaidia.css'

Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'faspay.recurring.check',
            path: '/faspay/recuring-check',
            component: require('./components/Tool'),
        },
    ])
})
