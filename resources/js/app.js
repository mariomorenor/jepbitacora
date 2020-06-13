
import Vuex from 'vuex'

require('./bootstrap');
window.Vue = require('vue');
window.Swal = require('sweetalert2');

window.bootstrapTable = require('bootstrap-table');
require('bootstrap-table/src/locale/bootstrap-table-es-ES');

// require('tableexport.jquery.plugin/tableExport')
// window.jsPDF = require('tableexport.jquery.plugin/libs/jsPDF/jspdf')
// require('tb/libs/jsPDF-AutoTable/jspdf.plugin.autotable')
// require('bootstrap-table/dist/extensions/export/bootstrap-table-export')

window.moment = require('moment');
require('moment/locale/es');

Vue.use(Vuex)
require('@fortawesome/fontawesome-free/js/all')

Vue.component('sidebar', require('./components/sidebarComponent.vue').default);
Vue.component('main-app', require('./components/App.vue').default);

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

