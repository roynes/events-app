export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: require('./containers/Home').default
        },
        {
            path: '/events',
            component: require('./containers/Event').default
        }
    ]
};
