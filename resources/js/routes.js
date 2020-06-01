import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);

export default new Router({
    routes: [{
            path: '/',
            name: 'inicio',
            props:true,
            components: require('./views/Home')
        },
        {
            path: '/nuevo_registro',
            name: 'nuevo_registro',
            props:true,
            components: require('./views/reportes/create.vue')
        },
        {
            path: '/cajeros',
            name: 'cajeros',
            props:true,
            components: require('./views/cajeros/index'),
        },
        {
            path: '/reportes',
            name: 'reportes',
            props:true,
            components: require('./views/reportes/index.vue')
        },
        {
            path: '/cajeros/nuevo',
            name: 'nuevo_cajero',
            props:true,
            components: require('./views/cajeros/create')
        },
        {
            path: '/cajeros/editar/:cajero_id',
            name: 'editar_cajero',
            props:true,
            components: require('./views/cajeros/update')
        },
        {
            path: '/reportes/show/:reporte_id',
            components: require('./views/reportes/show'),
            props:true,
        },
        // {
        //     path: '*',
        //     name: 'error',
        //     redirect: '/',
        //     components: require('./views/404')
        // },
    ],
    mode: 'history'
});