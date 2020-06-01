
import Vuex from 'vuex'

require('./bootstrap');
window.Vue = require('vue');
window.Swal = require('sweetalert2');

// require('bootstrap-table/dist/extensions')


window.bootstrapTable = require('bootstrap-table');
require('bootstrap-table/src/locale/bootstrap-table-es-ES');



window.moment = require('moment');
require('moment/locale/es')
Vue.use(Vuex)
require('@fortawesome/fontawesome-free/js/all')
Vue.component('sidebar', require('./components/sidebarComponent.vue').default);
Vue.component('main-app', require('./components/App.vue').default);

// window.freezeHeader = require('freeze/headerFreeze')
import router from './routes';

const store = new Vuex.Store({
    state: {

    },
    mutations: {
    
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,
    

});

